<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use App\Models\Pharmacy;
use App\Models\Gard;
use Carbon\Carbon;

use App\Http\Controllers\scraperController;


class scrapeClass extends Controller
{
    public function __construct(scraperController $scrapeCasa){
        $this->scrapeCasa = $scrapeCasa;
    }

    public $pharmacyFails = 0;
    public $pharmacyCount = 0;
    public $pharmacyUpdated = 0;
    public $gardCount = 0;
    
    public function scrape($url, $cityName, $cityID) {
        $client = new Client(); $mainPage = $client->request('GET', $url);

        $urls = $mainPage->filter('article p > a')
        ->each(function($i) { return 'https://www.annuaire-gratuit.ma' . $i->attr('href'); });

        $results = array();
        $index = 0;
        for($i = 0; $i < count($urls); $i++){
            try {
                $page = $client->request('GET', $urls[$i]);
                $name = trim(mb_strtoupper(str_replace('Pharmacie', '', $page->filter('div.col-xs-12 h1')->text())));
                $address =  trim(preg_replace("/[-]?[\s]?$cityName/i", '', $page->filter('div.col-xs-12 div.row.column_in')->first()->filter('tr')->first()->filter('td > address')->text())) . ", {$cityName}";
                $city = trim($page->filter('div.col-xs-12 div.row.column_in')->first()->filter('tr')->eq(1)->filter('td:last-child')->text());
                $phone = trim(str_replace(' ', '', $page->filter('div.col-xs-12 div.row.column_in')->first()->filter('tr')->eq(3)->filter('td:last-child')->text()));
                $location = trim($page->filter('div.col-xs-12 div.row.column_in')->first()->filter('tr')->first()->filter('td > address > a')->attr('href'));
                $lat = trim(explode(',', explode('q=', $location)[1])[0]);
                $long = trim(explode(',', explode('q=', $location)[1])[1]);
                
                $sDate[$i]  = $page->filter('table.pharma_history tr:not(:first-child)')->each(function($item, $i) {
                    $date[$i] = $item->filter('td')->first()->text(); 
                    if(Carbon::parse($date[$i]) <= Carbon::now()) {
                        $res = $date[$i];
                    }
                    return $res;
                });

                $startDateMax = max(array_map('strtotime', $sDate[$i]));
                $startDateMax = date('Y-m-j', $startDateMax);
                $startDateMax = $startDateMax . ' 08:00:00';

                $endDate[$i]  = $page->filter('table.pharma_history tr:not(:first-child)')->each(function($item, $i) {
                    $date[$i] = $item->filter('td')->first()->text(); 
                    if(Carbon::parse($date[$i]) <= Carbon::now()) {
                        $res = $item->filter('td')->eq(1)->text();
                    }
                    return $res;
                });
                
                $endDateMax = max(array_map('strtotime', $endDate[$i]));
                $endDateMax = date('Y-m-j', $endDateMax);
                $endDateMax = $endDateMax . ' 23:59:00';

                $guard_type = trim(str_replace('Garde', '', $page->filter('table.pharma_history tr')->last()->filter('td')->eq(2)->text()));
                
                if(preg_match('/^[0-9]{10}$/', $phone)) {
                    $results[$index]['name'] = $name;
                    $results[$index]['address'] = $address;
                    $results[$index]['city'] = $city;
                    $results[$index]['phone'] = $phone;
                    $results[$index]['location'] = $location;
                    $results[$index]['lat'] = $lat;
                    $results[$index]['long'] = $long;
                    $results[$index]['startDate'] = $startDateMax;
                    $results[$index]['endDate'] = $endDateMax;
                    
                    if(preg_match('/^Jour et Nuit$/i', $guard_type)) { $results[$index]['guard-type'] = '24h'; }
                    elseif(preg_match('/^Jour$/i', $guard_type)) { $results[$index]['guard-type'] = 'jour'; }
                    elseif(preg_match('/^Nuit$/i', $guard_type)){ $results[$index]['guard-type'] = 'nuit'; }
                    else { $results[$index]['guard-type'] = '24h'; }

                    $index++;
                }
                
            } catch (\Exception $e) { $this->pharmacyFails++; continue; }
            
        }

        //reindex array
        $arrays = $results;
        $datas = array(); $i=0;
        foreach($arrays as $k => $item){  $datas[$i] = $item; unset($arrays[$k]); $i++; }
    
        /*insert to mysql*/
        for($i = 0; $i < count($datas); $i++) {
            $pharmacy = Pharmacy::query()->where('phone', '=', $datas[$i]['phone'])->first();

            if (!$pharmacy) {
                $resultpharma = Pharmacy::create([ 
                    'qualifier' => 0,
                    'name' =>  $datas[$i]['name'], 
                    'address' =>  $datas[$i]['address'],
                    'phone' =>  $datas[$i]['phone'], 
                    'location_url' =>  $datas[$i]['location'],
                    'lat' =>  $datas[$i]['lat'], 
                    'long' =>  $datas[$i]['long'],
                    'city_id' => $cityID 
                ]);

                $this->pharmacyCount ++;

                Gard::create([ 
                    'startDate' =>  $datas[$i]['startDate'], 
                    'endDate' =>  $datas[$i]['endDate'],
                    'guard_type' =>  $datas[$i]['guard-type'], 
                    'pharmacy_id' => $resultpharma->id 
                ]);
                
                $this->gardCount ++;

            } elseif( $pharmacy->qualifier === NULL ) {
                Pharmacy::where('id', '=', $pharmacy->id)
                ->update([
                    'name' => $datas[$i]['name'],
                    'address' => $datas[$i]['address'],
                    'qualifier' => 1
                ]);

                $this->pharmacyUpdated ++;

                Gard::create([
                    'startDate' =>  $datas[$i]['startDate'], 
                    'endDate' =>  $datas[$i]['endDate'], 
                    'guard_type' =>  $datas[$i]['guard-type'],
                    'pharmacy_id' => $pharmacy->id 
                ]);
                
                $this->gardCount ++;
            } else { 
                $gard = Gard::query()
                ->where("startDate", "=", $datas[$i]['startDate'])
                ->where("endDate", "=", $datas[$i]['endDate'])
                ->where('pharmacy_id', '=', $pharmacy->id)
                ->count();
                if(!$gard) {
                    Gard::create([ 
                        'startDate' =>  $datas[$i]['startDate'], 
                        'endDate' =>  $datas[$i]['endDate'], 
                        'guard_type' =>  $datas[$i]['guard-type'],
                        'pharmacy_id' => $pharmacy->id ]);
                    $this->gardCount ++;
                }
            }
        }
        
    }

    public function scrapeAll(){
        $casa = $this->scrapeCasa->scrapeLEMATIN();
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-rabat.html', 'Rabat', 2);
        $this->scrape("https://www.annuaire-gratuit.ma/pharmacie-garde-marrakech.html", 'Marrakech', 3);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-el-jadida.html', 'El Jadida', 4);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-oujda.html', 'Oujda', 5);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-meknes.html', 'Meknes', 6);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-agadir.html', 'Agadir', 7);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-sale.html', 'Sale', 8);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-safi.html', 'Safi', 9);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-fes.html', 'Fès', 10);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-kenitra.html', 'Kénitra', 11);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-mohammedia.html', 'Mohammedia', 12);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-tanger.html', 'Tanger', 13);
        $this->scrape('https://www.annuaire-gratuit.ma/pharmacie-garde-temara.html', 'Temara', 14);
        
        if(Session()->has('pharmacyCount') ) { Session()->pull('pharmacyCount'); }
        if(Session()->has('pharmacyUpdated')){ session()->pull('pharmacyUpdated'); }
        if(Session()->has('gardCount')){ Session()->pull('gardCount'); }
        if(Session()->has('pharmaFails')){ session()->pull('pharmaFails'); }

        $pharmacyCount = $this->pharmacyCount + $casa['pharmacyCount'];
        $pharmacyUpdated = $this->pharmacyUpdated + $casa['pharmacyUpdated'];
        $gardCount = $this->gardCount + $casa['gardCount'];
        
        session()->put(['pharmacyCount' => $pharmacyCount]);
        session()->put(['pharmacyUpdated' => $pharmacyUpdated]);
        session()->put(['gardCount' => $gardCount]);
        session()->put(['pharmaFails' => $this->pharmacyFails]);
    }
}
