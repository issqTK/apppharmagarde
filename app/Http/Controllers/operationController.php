<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pharmaciesItineraire;
use App\Models\Pharmacy;

class operationController extends Controller
{
    //Upload Csv to mySql
    private static function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
        
    }

    function filterCity($city, $city_id) {
        $data = $this->csvToArray('datas.csv');
        $results = array();
        
        $j = 0;
        $old_phone = '';
        for($i = 0; $i < count($data); $i++) {
            if(!empty($data[$i]['Phone']) && preg_match("/[a-z1-9 ]*{$city}[a-z1-9 ]*/i", $data[$i]['City']) ) {
                $phone = '0'.trim(str_replace(' ', '', str_replace('-', '', str_replace('+212', '', $data[$i]['Phone']))));
                $gmaps = $data[$i]['Gmaps_URL'];
                $lat = str_replace(',', '.', $data[$i]['Lat']);
                $long =  str_replace(',', '.', $data[$i]['Lng']);
                
                if($old_phone !== $phone){
                        $results[$j]['phone'] = $phone;
                        $results[$j]['gmaps_url'] = $gmaps;
                        $results[$j]['lat'] = $lat;
                        $results[$j]['long'] = $long;
                        $results[$j]['city_id'] = $city_id;

                        $old_phone = $phone;

                        $j++;
                }
               
            }
        }
        return $results;
       
    }

    function addToPharmacie($city, $city_id) {
        $results = $this->filterCity($city, $city_id);
       
        $count = 0; 
        $fails = 0;

        for($i = 0; $i<count($results); $i++) {
            $phone = Pharmacy::where('phone', '=', $results[$i]['phone'])->first();
            if(!$phone){
                $data = Pharmacy::create([
                    'phone' => $results[$i]['phone'],
                    'gmaps_url' => $results[$i]['gmaps_url'],
                    'lat' => $results[$i]['lat'],
                    'long' => $results[$i]['long'],
                    'city_id' => $results[$i]['city_id'],
                ]);

                $count++;
                
            } else { $fails++;   }

        }
        return 'Adding succesfuly : '. $count . '<br>Fails  : ' . $fails;

    }

    function exeCities(){
        //return $this->addToPharmacie('casablanca', 1);
        return $this->addToPharmacie('Témara', 14);
    }


}
