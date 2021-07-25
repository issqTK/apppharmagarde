<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\scraperController;
use App\Http\Controllers\createController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\schedule;
use App\Models\City;
use App\Http\Controllers\operationController;


//Public
Route::get('/', [dashboard::class, 'index'])->name('index');

Route::get("/pharmacie-de-garde-{name}-frame", [dashboard::class, 'displayframe'])->name('displayframe');
Route::get("/pharmacie-de-garde-{name}", [dashboard::class, 'display'])->name('display');



//Admin Connect area
Route::get('/admin/login', [AdminController::class, 'login_index'])->name('login');
Route::get('/admin/register', [AdminController::class, 'register_index'])->name('register');

Route::post('/admin/check', [AdminController::class, 'check'])->name('check');
Route::post('/admin/save', [AdminController::class, 'save'])->name('save');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('logout')->middleware('isLogged');

//Admin Route
Route::get('/admin', [AdminController::class, 'index'])->middleware('isLogged');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard')->middleware('isLogged');

Route::get('/admin/updatedinfos', [AdminController::class, 'updateInfos'])->name('updateInfos')->middleware('isLogged');


//Cron Job _ Auto scraping dayleyAt(8AM)
Route::get('/schedule/run', [schedule::class, 'exec'])->name('scrapeALL')->middleware('isLogged');
Route::get('/schedule/run/cron', [schedule::class, 'cron']);

// Operation test
Route::get('/operation', [operationController::class, 'exeCities']);

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
