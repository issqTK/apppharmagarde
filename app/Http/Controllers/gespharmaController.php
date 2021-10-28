<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Pharmacy;
use App\Models\Gard;

use Carbon\Carbon;

class gespharmaController extends Controller
{
    public function index() {
        $cities = City::All();
        return view('admin.gestionpharmacies', ['cities' => $cities]);
    }

    public function filter(Request $request) {
        $phone = $request->phone;
        $city = $request->city;
        $qualifier = $request->qualifier;
       if(isset($phone)) {
            $datas = Pharmacy::select('*')->where('phone', '=', $phone)->get();

            if(count($datas) <= 0){
                    return back()->with('fail','there is no record match this phone number');
            } else{
                    return back()->with(['datas' => $datas]);
            }
       } elseif(isset($city)) {
           if(isset($qualifier)) {
                $datas = Pharmacy::select('*')
                ->where('city_id', '=', $city)
                ->where('qualifier', '=', $qualifier)
                ->get();

                return back()->with(['datas' => $datas]);
           } else {
                $datas = Pharmacy::select('*')
                ->where('city_id', '=', $city)
                ->whereRaw('name IS NOT NULL')
                ->get();

                return back()->with(['datas' => $datas]);
           }

       } elseif(isset($qualifier)) {
            $datas = Pharmacy::select('*')
            ->where('qualifier',  '=', $qualifier)
            ->get();

            return back()->with(['datas' => $datas]);
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
        $qualifier = $req->qualifiedTrue;
        
        if($qualifier == 'on') {
            Pharmacy::where('id', '=', $id)
            ->update([
                'qualifier' => 1,
                'name' => $name,
                'address' => $address,
                'gmaps_url' => $gmaps,
                'lat' => $lat,
                'long' => $long
            ]);
        } else {
            Pharmacy::where('id', '=', $id)
            ->update([
                'name' => $name,
                'address' => $address,
                'gmaps_url' => $gmaps,
                'lat' => $lat,
                'long' => $long
            ]);
        }
       
        return redirect()->route('getGesPharma')->with(['success' => 'Pharmacy Updated successfuly']);
    }

    public function addpharmacy(Request $r) {
            $valid = $r->validate([
                'phone' => ['required', 'string', 'size:10'],
                'name' => 'required|string',
                'address' => 'required|string',
                'gmaps' => 'required|url',
                'city' => 'required',
                'lat' => 'required|numeric|between:-99.99999999,99.99999999',
                'long' => 'required|numeric|between:-99.99999999,99.99999999'
            ]);
            
            $exist = Pharmacy::where('phone', $r->phone)->first();

            if($exist) {
                return back()->with('fails', 'Pharmacy\'s phone already exist !');
            } else {
                $pharmacy = new Pharmacy;

                $pharmacy->phone = $r->phone;
                $pharmacy->name = $r->name;
                $pharmacy->address = $r->address;
                $pharmacy->gmaps_url = $r->gmaps;
                $pharmacy->lat = $r->lat;
                $pharmacy->long = $r->long;
                $pharmacy->qualifier = 1;
                $pharmacy->city_id = $r->city;

                $pharmacy->save();
                
                return back()->with('success', 'Pharmacy added successfuly');
            }
    }

    public function lister(Request $req){
        if( session()->has('exist') ) {
            session()->pull('exist');
        } 

        $valid = $req->validate(['phone' => 'required|string|size:10']);

        $exist = Pharmacy::where('phone', $req->phone)->first();

        if(!$exist) {
            return back()->with('fails', 'Pharmacy\'s phone not found');
        } else {
            session()->put(['exist' => $exist]);
    
            return back();
        }
    }

    public function addGuard(Request $req) {
        $valid = $req->validate([
            'startDate' => ['required', 'date'],
            'endDate' => 'required|date',
            'guardType' => 'required',
        ]);

        $startDate = $req->startDate;
        $endDate = $req->endDate;
        $guardType = $req->guardType;
        $pharmaId = $req->pharmaId;

        if(Carbon::parse($endDate) <= Carbon::now()) {
            return back()->with('error_date', 'endDate must be greater than current date');

        } elseif(Carbon::parse($endDate) <= Carbon::parse($startDate)) {
            return back()->with('error_date', 'endDate must be greater than startDate');

        } else {
            $gard = new Gard;

            $gard->startDate = $startDate;
            $gard->endDate = $endDate;
            $gard->guard_type = $guardType;
            $gard->pharmacy_id = $pharmaId;
            $gard->created_at = Carbon::now();

            $gard->save();

            if( session()->has('exist') ) {
                session()->pull('exist');
            } 

            return back()->with('success', 'Garde Added Successfuly');

        }
    }

    public function deletepharmacy(Request $r){
        $gard = Gard::where('pharmacy_id', $r->pharmacyId)->get();
        
        if($gard) {
            Gard::where('pharmacy_id', $r->pharmacyId)->delete();
        }
        

        Pharmacy::where('id', $r->pharmacyId)->delete();

        if( session()->has('exist') ) {
            session()->pull('exist');
        } 

        return back()->with('success', 'Pharmacy Deleted Successfuly');
    }
}
