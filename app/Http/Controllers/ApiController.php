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
            if($datas[$i]->gmaps_url){
                $results[$i]['name'] =  $datas[$i]->name;
                $results[$i]['address'] =  $datas[$i]->address;
                $results[$i]['phone'] =  $datas[$i]->phone;
                $results[$i]['startDate'] = $datas[$i]->startDate;
                $results[$i]['endDate'] = $datas[$i]->endDate;
                $results[$i]['startHoure'] = $datas[$i]->startHoure;
                $results[$i]['endHoure'] = $datas[$i]->endHoure;
                $results[$i]['gmaps_url'] =  $datas[$i]->gmaps_url;
                $results[$i]['lat'] =  $datas[$i]->lat;
                $results[$i]['long'] =  $datas[$i]->long;
                $results[$i]['dis'] = $datas[$i]->distance;

                $typeGard = explode(':', $datas[$i]->endHoure);
                if($typeGard[0] == '24'){
                    $results[$i]['garde_label'] = 'Garde ' . $typeGard[0] . '/' . $typeGard[0];
                } else {
                    $startHoure = explode(':', $datas[$i]->startHoure);
                    $startHoure = $startHoure[0] . ':' . $startHoure[1];
                    $endHoure = $typeGard[0] . ':' . $typeGard[1];
                    $results[$i]['garde_label'] = 'Ouvert de ' . $startHoure . ' à ' . $endHoure;
                }
            } 
        }
        
        $results = json_encode($results);
        return response()->json($results, 200);
    }
}
