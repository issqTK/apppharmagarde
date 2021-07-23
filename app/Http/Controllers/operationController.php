<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    function addToPharmacie() {
        $data = $this->csvToArray('datas.csv');
        $results = array();
        for($i = 0; $i < count($data); $i++) {
            if(!empty($data[$i]['Phone']) ) {
                echo '<pre>';        
                print_r($data[$i]);
                echo '</pre>';
            }
        }

    }
}
