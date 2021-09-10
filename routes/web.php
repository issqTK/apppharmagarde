<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\gespharmaController;

use App\Http\Controllers\scraperController;
use App\Http\Controllers\schedule;

use App\Http\Controllers\operationController;

use App\Models\City;


Route::get('/', [userController::class, 'index'])->name('index');

//_Listing

Route::get("/pharmacie-de-garde-iframe", function(){ $cities = City::All(); return view('displayframe', ['cities' => $cities]); })->name('listergardeframe');

Route::get("/pharmacie-de-garde-{name}-iframe", [userController::class, 'displayframe'])->name('displayframe');

Route::get("/pharmacie-de-garde", function(){ if(Session()->has('pharmacies') ) { Session()->pull('pharmacies'); } $cities = City::All(); return view('pharmacygards', ['cities' => $cities]); })->name('listergarde');

Route::get("/pharmacie-de-garde-{name}", [userController::class, 'display'])->name('display');




//_CONNEX

Route::get('/login', [userController::class, 'login'])->name('login')->middleware('isnotLogged');

Route::get('/register', [userController::class, 'register'])->name('register')->middleware('isnotLogged');

Route::post('/admin/check', [userController::class, 'check'])->name('check');

Route::post('/admin/save', [userController::class, 'save'])->name('save');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout')->middleware('isLogged');

//_ADMIN

Route::get('/admin/scrapping', [AdminController::class, 'scrapping'])->name('scrapping')->middleware('isLogged');

Route::get('/admin/activite', [AdminController::class, 'updateInfos'])->name('updateInfos')->middleware('isLogged');


//GERER PHARMACY

Route::get('/admin/gestion-pharmacies', [gespharmaController::class, 'index'])->name('getGesPharma')->middleware('isLogged');

Route::post('/admin/gestion-pharmacies', [gespharmaController::class, 'filter'])->name('filter')->middleware('isLogged');

Route::get('/admin/edit-pharmacy/{id}', [gespharmaController::class, 'getPharmacy'])->name('getPharmacy')->middleware('isLogged');

Route::post('/admin/edit-pharmacy/{id}', [gespharmaController::class, 'updatePharmacy'])->name('updatePharmacy')->middleware('isLogged');

//ADD NEW PHARMACY

Route::get('/admin/ajouter-pharmacie', function() {
    $cities = City::All();
    return view('admin.ajouter-pharmacie', ['cities' => $cities]);
})->name('viewAddPharma')->middleware('isLogged');

Route::post('/admin/ajouter-pharmacie', [gespharmaController::class, 'addpharmacy'])->name('addpharmacy')->middleware('isLogged');

Route::get('/admin/ajouter-pharmacie-de-garde', function() {
    return view('admin.ajouter-garde');
})->name('viewAddGarde')->middleware('isLogged');

Route::post('/admin/ajouter-pharmacie-de-garde', [gespharmaController::class, 'lister'])->name('bringpharmacy')->middleware('isLogged');

Route::get('/admin/supprimer-pharmacie', function() {
    return view('admin.supprimer-pharmacy');
})->name('viewdeleteGarde')->middleware('isLogged');

Route::post('/admin/supprimer-pharmacie', [gespharmaController::class, 'lister'])->name('bringpharmacy2')->middleware('isLogged');

Route::post('/deleting', [gespharmaController::class, 'deletepharmacy'])->name('deletenow')->middleware('isLogged');


Route::post('/admin/ajouter-garde', [gespharmaController::class, 'addGuard'])->name('addguard')->middleware('isLogged');

//_OPERATIONS

Route::get('/operation', [operationController::class, 'exeTest']);

//_CRONS

Route::get('/schedule/run', [schedule::class, 'exec'])->name('scrapeALL')->middleware('isLogged');

Route::get('/schedule/run/cron', [schedule::class, 'cron']);

////////////
Route::get('/admin/scrapesafi', [scraperController::class, 'scrapeSafi'])->name('scrapesafi')->middleware('isLogged');
Route::get('/admin/scrapesale', [scraperController::class, 'scrapeSale'])->name('scrapesale')->middleware('isLogged');
Route::get('/admin/scrapeagadir', [scraperController::class, 'scrapeAgadir'])->name('scrapeagadir')->middleware('isLogged');
Route::get('/admin/scrapemeknes', [scraperController::class, 'scrapeMeknes'])->name('scrapemeknes')->middleware('isLogged');
Route::get('/admin/scrapeoujda', [scraperController::class, 'scrapeOujda'])->name('scrapeoujda')->middleware('isLogged');
Route::get('/admin/scrapeeljadida', [scraperController::class, 'scrapeEljadida'])->name('scrapeeljadida')->middleware('isLogged');
Route::get('/admin/scrapemarrakech', [scraperController::class, 'scrapeMarrakech'])->name('scrapemarrakech')->middleware('isLogged');
Route::get('/admin/scraperabat', [scraperController::class, 'scrapeRabat'])->name('scraperabat')->middleware('isLogged');
Route::get('/admin/scrapecasa', [scraperController::class, 'scrapeCasa'])->name('scrapecasa')->middleware('isLogged');
Route::get('/admin/scrapefes', [scraperController::class, 'scrapeFes'])->name('scrapefes')->middleware('isLogged');
Route::get('/admin/scrapekenitra', [scraperController::class, 'scrapeKenitra'])->name('scrapekenitra')->middleware('isLogged');
Route::get('/admin/scrapemohammedia', [scraperController::class, 'scrapeMohammedia'])->name('scrapemohammedia')->middleware('isLogged');
Route::get('/admin/scrapetanger', [scraperController::class, 'scrapeTanger'])->name('scrapetanger')->middleware('isLogged');
Route::get('/admin/scrapetemara', [scraperController::class, 'scrapeTemara'])->name('scrapetemara')->middleware('isLogged');
