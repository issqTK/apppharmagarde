<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\pharmacy;

class gespharmaController extends Controller
{
    public function index() {
        $cities = City::All();
        return view('admin.gestionpharmacies', ['cities' => $cities]);
    }

    public function filter(Request $request) {
       $city = $request->city;
       $phone = $request->phone;
       $gmaps = $request->gmaps;

       if(!empty($phone)) {
            $datas = Pharmacy::select('*')->where('phone', '=', $phone)->get();

            if(count($datas) <= 0){
                    return back()->with('fail','there is no record match this phone number');
            } else{
                    return back()->with(['datas' => $datas]);
            }
       }
       elseif(!empty($city)) {
           if($gmaps == 'on') {
                $datas = Pharmacy::select('*')
                ->where('city_id', '=', $city)
                ->whereRaw('gmaps_url IS NULL')
                ->get();

                return back()->with(['datas' => $datas]);
           } else {
                $datas = Pharmacy::select('*')
                ->where('city_id', '=', $city)
                ->get();

                return back()->with(['datas' => $datas]);
           }
       }
    }

    public function getPharmacy($id){
        $pharmacy = Pharmacy::where('id', '=', $id)->first();
        
        if(!$pharmacy) {
            return redirect()->route('getGesPharma');
        }

        return view('admin.edit-pharmacy', ['pharmacy' => $pharmacy]);

    }

    public function updatePharmacy(Request $req, $id) {
        $valid = $req->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'gmaps' => 'required|url',
            'lat' => 'required|numeric|between:-99.99999999,99.99999999',
            'long' => 'required|numeric|between:-99.99999999,99.99999999'
        ]);

        $name = $req->name;
        $address = $req->address;
        $gmaps = $req->gmaps;
        $lat = $req->lat;
        $long = $req->long;

        Pharmacy::where('id', '=', $id)
        ->update([
            'name' => $name,
            'address' => $address,
            'gmaps_url' => $gmaps,
            'lat' => $lat,
            'long' => $long
        ]);
        return redirect()->route('getGesPharma')->with(['success' => 'Pharmacy Updated successfuly']);
    }

}
