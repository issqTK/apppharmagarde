<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Admin;
use App\Models\last_scrape_info;

class AdminController extends Controller
{
  public function index() {
    return view('admin/dashboard');
  }

  public function updateInfos() {
    $datas = last_scrape_info::select('*')
              ->orderBy('updated_at', 'DESC')
              ->limit(10)
              ->get();
    return view('admin/updateinfos')->with(['datas'=> $datas]);
  }

  public function login_index() {
    $cities = City::All();

    return view('admin.login', ['cities' => $cities]);
  }

  public function register_index() {
    $cities = City::All();

    return view('admin.register', ['cities' => $cities]);
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
         return redirect()->route('dashboard');
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

  public function logout() {
    if(session()->has('loggedAdmin')){
        session()->pull('loggedAdmin');
        return redirect('/');
    }
  }
}
