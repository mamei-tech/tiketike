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
    Route::post('/fetch', 'URaffleController@fetchRaffle')->name('v1.uraffle.fetch');
});

Route::group([
    'namespace' => 'Api\V1',
],function () {
    Route::post('/filterByCategory', 'RaffleFrontController@filterByCategory')->name('filter.by.category');
    Route::post('/filterByPercent', 'RaffleFrontController@filterByPercent')->name('filter.by.percent');
    Route::post('/filterByPrice', 'RaffleFrontController@filterByPrice')->name('filter.by.price');
    Route::post('/getUser', 'UserFrontController@getUser')->name('get.user');
    Route::get('/getcity/{country_id}/{user_id}', 'UserFrontController@getcity')->name('get.cities');
});

Route::group([
    'namespace' => 'Api\V1',
    //'middleware' => ['auth:api'],
], function (){
    Route::get('/activeusers', 'DashboardController@activeUsers')->name('v1.customadmin.activeusers');
    Route::get('/publishedraffles', 'DashboardController@publishedRaffles')->name('v1.customadmin.publishedraffles');
    Route::get('/registeredusers', 'DashboardController@registeredUsers')->name('v1.customadmin.registeredusers');
    Route::get('/rafflesbystatus', 'DashboardController@rafflesByStatus')->name('v1.customadmin.rafflesbystatus');
    Route::get('/soldedtickets', 'DashboardController@soldedTickets')->name('v1.customadmin.soldedtickets');
    Route::get('/soldedticketsbysocialnetworks', 'DashboardController@soldedTicketsBySocialNetworks')->name('v1.customadmin.soldedticketsbysocialnetworks');
    Route::get('/moneybytickets', 'DashboardController@moneyByTickets')->name('v1.customadmin.moneybytickets');
    Route::get('/rafflereferrals/{raffleId}', 'DashboardController@raffleReferrals')->name('v1.groups.rafflereferrals');
});


