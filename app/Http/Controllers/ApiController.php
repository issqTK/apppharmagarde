<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gard;
use App\Models\Pharmacy;
use App\Models\config;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/gards/position/{lat}/{long}",
     *      operationId="getGuardsCloser",
     *      tags={"guardscloser"},
     *      summary="Get json Guards Closer by Lat and Long",
     *      description="Get json Guards Closer by Lat and Long",
     *      @OA\Parameter(
     *          name="lat",
     *          description="Latitude",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number",
     *              format="double"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="long",
     *          description="longitude",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="number",
     *              format="double"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "oauth2_security_example": {"write:projects", "read:projects"}
     *         }
     *     },
     * )
     */

    /* public function guardsByCity($city) {
        $datas = Pharmacy::join('gards', 'gards.pharmacy_id', '=', 'pharmacies.id')
        ->join('configs', 'configs.city_id', 'pharmacies.city_id')
        ->select('pharmacies.*', 'gards.*', 'configs.*')
        ->where('pharmacies.city_id', $city)
        ->whereRaw(
            "gards.guard_type = configs.guard_type AND 
             NOW() BETWEEN gards.startDate AND gards.endDate AND 
             NOW() BETWEEN configs.startHoure AND configs.endHoure AND 
             gards.startDate IN 
             (SELECT max(gards.startDate) FROM gards INNER JOIN pharmacies WHERE gards.pharmacy_id = pharmacies.id AND pharmacies.city_id = {$city})"
            )
        ->get();
        
        $results = array();
        
        for($i = 0; $i<count($datas); $i++) {
            $results[$i]['name'] = $datas[$i]['name'];
            $results[$i]['address'] = $datas[$i]['address'];
            $results[$i]['phone'] = $datas[$i]['phone'];
            $results[$i]['location_url'] = $datas[$i]['location_url'];
            $results[$i]['startDate'] = $datas[$i]['startDate'];
            $results[$i]['endDate'] = $datas[$i]['endDate'];
            $results[$i]['startHoure'] = $datas[$i]['startHoure'];
            $results[$i]['endHoure'] = $datas[$i]['endHoure'];
            $results[$i]['guard_type'] = $datas[$i]['guard_type'];
            $results[$i]['city_id'] = $datas[$i]['city_id'];
        }

        $results = json_encode($results);
        return response()->json($results, 200);
    } */

    public function showcloser($lat, $long){
        /* $lat = 33.261183961616446;
        $long = -8.512451958175692; */

        $datas = Pharmacy::join('gards', 'gards.pharmacy_id', '=', 'pharmacies.id')
        ->join('configs', 'configs.city_id', 'pharmacies.city_id')
        ->select('pharmacies.*', 'gards.*', 'configs.*',
                                        DB::raw("6371 * acos(cos(radians(" . $lat . ")) 
                                        * cos(radians(pharmacies.lat)) 
                                        * cos(radians(pharmacies.long) - radians(" . $long . ")) 
                                        + sin(radians(" .$lat. ")) 
                                        * sin(radians(pharmacies.lat))) AS distance")
        )
        ->whereRaw( "gards.guard_type = configs.guard_type AND
                    NOW() BETWEEN configs.startHoure AND configs.endHoure AND
                    NOW() BETWEEN gards.startDate AND gards.endDate" )
        ->groupBy('pharmacies.id')
        ->orderBy('distance', 'ASC')
        ->get();

        $results = array();

        for($i = 0; $i < count($datas); $i++){
            $results[$i]['name'] =  $datas[$i]->name;
            $results[$i]['address'] =  $datas[$i]->address;
            $results[$i]['phone'] =  $datas[$i]->phone;
            $results[$i]['location_url'] =  $datas[$i]->location_url;
            $results[$i]['lat'] =  $datas[$i]->lat;
            $results[$i]['long'] =  $datas[$i]->long;
            $results[$i]['dis'] = $datas[$i]->distance;
        }
        $results = json_encode($results);
        return response()->json($results, 200);
    

    }
}
