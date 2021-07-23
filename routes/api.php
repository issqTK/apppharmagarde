<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

set_time_limit(0);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Gards Routes
Route::get('/gards/position/', [ApiController::class, 'showcloser']);//done
Route::get('/gards/{city_id}', [ApiController::class, 'guardsByCity']);//done
