<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use App\Models\City;
use App\Models\Pharmacy;
use App\Models\Gard;
use App\Models\Admin;
use App\Models\config;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\scraperController;



class UserController extends Controller
{
    public function __construct(scraperController $scraper){
        $this->scraper = $scraper;
    }

    public function index() {
        $cities = City::All();
        return view('index', ['cities' => $cities]);
    }

    public function guards($city) {
        if(session()->has('pharmacies')) { session()->pull('pharmacies');  }

        $ct = City::where('slug', '=', $city)->first();

        if(!$ct) { return redirect()->route('index'); }

        $req = Pharmacy::join('gards', 'gards.pharmacy_id', '=', 'pharmacies.id')->join('configs', 'configs.city_id', 'pharmacies.city_id')
                        ->select('pharmacies.*', 'gards.*', 'configs.*')
                        ->where('pharmacies.city_id', $ct->id)
                        ->whereRaw("gards.guard_type = configs.guard_type AND NOW() BETWEEN gards.startDate AND gards.endDate AND gards.startDate IN (SELECT max(gards.startDate) FROM gards INNER JOIN pharmacies WHERE gards.pharmacy_id = pharmacies.id AND pharmacies.city_id = {$ct->id})");

        if(!$req->exists()) {
            switch ($ct->id) {
                case 1:
                    $this->scraper->scrapeLEMATIN();
                    break;
                case 2:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-rabat.html', 'Rabat', 2);
                    break;
                case 3:
                    $this->scraper->scraper("https://www.annuaire-gratuit.ma/pharmacie-garde-marrakech.html", 'Marrakech', 3);
                    break;
                case 4:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-el-jadida.html', 'El Jadida', 4);
                    break;
                case 5:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-oujda.html', 'Oujda', 5);
                    break;
                case 6:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-meknes.html', 'Meknes', 6);
                    break;
                case 7:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-agadir.html', 'Agadir', 7);
                    break;
                case 8:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-sale.html', 'Sale', 8);
                    break;
                case 9:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-safi.html', 'Safi', 9);
                    break;
                case 10:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-fes.html', 'Fès', 10);
                    break;
                case 11:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-kenitra.html', 'Kénitra', 11);
                    break;
                case 12:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-mohammedia.html', 'Mohammedia', 12);
                    break;
                case 13:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-tanger.html', 'Tanger', 13);
                    break;
                case 14:
                    $this->scraper->scraper('https://www.annuaire-gratuit.ma/pharmacie-garde-temara.html', 'Temara', 14);
                    break;
                default:
                  return NULL;
              }
              return redirect('/pharmacie-de-garde-'. $ct->slug .'-frame"');

        } else{
            $datas = $req->get();

            $now = Carbon::now()->toTimeString();
            //$currentTime = Carbon::createFromFormat('H:i:s', $now);

            $currentTime = strtotime($now);

            $pharmacies = array();

            for($i = 0; $i < count($datas); $i++) {
                $startTime = strtotime($datas[$i]['startHoure']);
                $endTime = strtotime($datas[$i]['endHoure']);

                if( $currentTime >= $startTime && $currentTime <= $endTime ){
                $pharmacies[$i]['name'] = $datas[$i]['name'];
                $pharmacies[$i]['address'] = $datas[$i]['address'];
                $pharmacies[$i]['phone'] = $datas[$i]['phone'];
                $pharmacies[$i]['gmaps_url'] = $datas[$i]['gmaps_url'];
                $pharmacies[$i]['startDate'] = $datas[$i]['startDate'];
                $pharmacies[$i]['endDate'] = $datas[$i]['endDate'];
                $pharmacies[$i]['guard_type'] = $datas[$i]['guard_type'];
                $pharmacies[$i]['startHoure'] = $datas[$i]['startHoure'];
                $pharmacies[$i]['endHoure'] = $datas[$i]['endHoure'];
                }
                
            }
                
            session()->put('pharmacies', $pharmacies);
        }
        
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
