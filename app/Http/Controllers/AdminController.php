<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\City;
use App\Models\Admin;
use App\Models\last_scrape_info;

class AdminController extends Controller
{
  public function scrapping() {
    return view('admin/scrapping');
  }

  public function updateInfos() {
    $datas = last_scrape_info::select('*')
            ->orderBy('updated_at', 'DESC')
            ->limit(10)
            ->get();
    return view('admin/updateinfos')->with(['datas'=> $datas]);
  }

  public function logout() {
    if(session()->has('loggedAdmin')){
        session()->pull('loggedAdmin');
        return redirect()->route('login');
    }
  }
}
