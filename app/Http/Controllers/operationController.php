<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pharmaciesItineraire;

class operationController extends Controller
{
    private static function csvToArray($filename = '', $delimiter = ',')
    {
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
        for($i = 0; $i < count($data); $i++) {
            if(!empty($data[$i]['Phone']) && preg_match("/{$city}/i", $data[$i]['City']) ) {
               $results[$j]['phone'] = '0'.trim(str_replace(' ', '', str_replace('-', '', str_replace('+212', '', $data[$i]['Phone']))));
               $results[$j]['gmaps_url'] = $data[$i]['Gmaps_URL'];
               $results[$j]['lat'] = str_replace(',', '.', $data[$i]['Lat']);
               $results[$j]['long'] = str_replace(',', '.', $data[$i]['Lng']);
               $results[$j]['city_id'] = $city_id;
               $j++;
            }
        }

        return $results;
    }

    function addToPharmacie() {
        $casablanca = $this->filterCity('rabat', 2);
        $count = 0; 
        $fails = 0;

        for($i = 0; $i<count($casablanca); $i++) {
            $phone = pharmaciesItineraire::where('phone', '=', $casablanca[$i]['phone'])->first();
            if(!$phone){
                 $data = pharmaciesItineraire::create([
                    'phone' => $casablanca[$i]['phone'],
                    'gmaps_url' => $casablanca[$i]['gmaps_url'],
                    'lat' => $casablanca[$i]['lat'],
                    'long' => $casablanca[$i]['long'],
                    'city_id' => $casablanca[$i]['city_id'],
                ]); 

                $count++;
                
            } else {$fails++;}
           
        }
        echo 'add '. $count;
        echo 'fails '. $fails;
    }
}
