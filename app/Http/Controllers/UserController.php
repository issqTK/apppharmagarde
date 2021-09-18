<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\City;
use App\Models\Pharmacy;
use App\Models\Gard;
use App\Models\Admin;
use App\Models\config;

use Illuminate\Http\Request;

class UserController extends Controller
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

    public function login() {
        return view('admin.login');
    }
    
    public function register() {
        return view('admin.register');
    }

    public function check(Request $request) {
        //validate form
        $rules = [
            'username' => 'required|string|max:22',
            'password' => 'required|min:5',
        ];
    
        //Validation
        $request->validate($rules);
    
        $usr = Admin::where('username', '=', $request->username)->first();
    
        if( !$usr ){ return redirect()->route('login')->with('fail', 'We do not recognize you! (Admin Only)'); } 
    
        elseif( !Hash::check($request->password, $usr->password) ) { return redirect()->route('login')->with('fail', 'Incorrect Admin password');  } 
    
        elseif( $usr->authorisation != 1 ) { return redirect()->route('login')->with('fail', 'Admin authorisation fail!'); } 
    
        else {
             $request->session()->put('loggedAdmin', $usr);
             return redirect()->route('index');
        }
    
    
      }
    
      public function save(Request $req) {
        $req->validate([
          'username' => 'required|string|max:22',
          'password' => 'required|min:5|confirmed'
        ]);
    
        $admin = new Admin;
        $admin->username = $req->username;
        $admin->password = Hash::make($req->password);
    
        $save = $admin->save();
    
        if($save) {
            return back()->with('success', 'New user has been added successfuly to database');
        } else {
            return back()->with('fail', 'something went wrong, try againe later');
        }
      }
}
