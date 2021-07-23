<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\City;
use App\Models\Pharmacy;
use App\Models\Gard;
use App\Models\Admin;
use App\Models\config;

class dashboard extends Controller
{
    public function index() {
      $cities = City::All();
      return view('index', ['cities' => $cities]);
    }

    public function guards($city) {
      if(session()->has('pharmacies')) { session()->pull('pharmacies');  }

      $ct = City::where('slug', '=', $city)->first();

      if(!$ct) { return redirect()->route('index'); }

      $pharmacies = Pharmacy::join('gards', 'gards.pharmacy_id', '=', 'pharmacies.id')
                    ->join('configs', 'configs.city_id', 'pharmacies.city_id')
                    ->select('pharmacies.*', 'gards.*', 'configs.*')
                    ->where('pharmacies.city_id', $ct->id)
                    ->whereRaw("gards.guard_type = configs.guard_type AND Now() BETWEEN gards.startDate AND gards.endDate AND NOW() BETWEEN configs.startHoure AND configs.endHoure AND gards.startDate IN (SELECT max(gards.startDate) FROM gards INNER JOIN pharmacies WHERE gards.pharmacy_id = pharmacies.id AND pharmacies.city_id = {$ct->id})")
                    ->get();

      session()->put('pharmacies', $pharmacies);
    }

    public function display($city) {
      
      $this->guards($city);
      $cities = City::All();
      return view('pharmacygards', ['cities' => $cities]);
    
    }

    public function displayframe($city) {
      $this->guards($city);
      return view('pharmacygardsframe');
    }
}
