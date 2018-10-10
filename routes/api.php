<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'Api\V1',
    'prefix' => 'adm' . config('tiketike.urladminsalt') . '/v1',
    'middleware' => ['auth:api'],
],function () {
    Route::post('/amuntala', 'URaffleController@compute')->name('v1.uraffle.computetval');      // TODO Why not a normal GET here in the method
    Route::get('/cliproml', 'PromoController@clients')->name('v1.promo.clients');
    Route::post('/casckit', 'PromoController@promodata')->name('v1.promo.promodata');
});