<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* TODO Making the routes of logs-viewer match with the admin section */

/* FIRST LEVEL ROUTES */
Auth::routes();
Route::get('/', 'MainController@index')->name('main');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/pusher/auth',function(Request $request) {
    return Broadcast::auth($request);
});

Route::group(['prefix' => 'raffles'], function () {
    Route::get('/', 'RafflesController@index')->name('raffles.index');
});

/*-- USER SECTION -- */
Route::group(['prefix' => 'raffles',
    'middleware' => ['auth']
], function () {

//    Route::get('/add', 'RafflesController@create')->name('raffles.create');
    Route::post('/add', 'RafflesController@store')->name('raffles.index.store');
    Route::get('/edit/{raffleId}', 'RafflesController@edit')->name('raffles.edit');
    Route::post('/{raffleId}', 'RafflesController@update')->name('raffles.update');
    Route::get('{raffleId}/follow', 'RafflesController@follow')->name('raffles.follow');
    Route::post('/{raffleId}/tickets/buy', 'DirectBuysController@buyTickets')->name('raffle.tickets.buy');
    Route::post('/{raffleId}/{referralId}', 'ReferralsBuysController@buyTickets')->name('referrals.tickets.buy');

    Route::get('/{raffleId}/comments/{commentId}/responses', 'CommentsController@commentResponses')->name('raffle.commentResponses');
    Route::post('/{raffleId}/comments/{commentId}/responses', 'CommentsController@respondComment')->name('raffle.respondComment');
});

Route::group(['prefix' => 'payments',
    'namespace' => 'Admin',
    'middleware' => ['auth']
], function () {
    Route::get('/executed/list', 'PaymentController@executed')->name('payment.executed');
    Route::get('/pending/list', 'PaymentController@pending_list')->name('payment.pending.list');
    Route::post('/pending/pay', 'PaymentController@pending_pay')->name('payment.pending.pay');
    Route::post('/pending/details', 'PaymentController@pending_details')->name('payment.pending.details');
});

Route::group(['prefix' => 'users',
    'middleware' => ['auth']
], function () {
    Route::get('/billing/{userid}', 'BillingController@getBillingInfo')->name('billing.info');
    Route::patch('/billing/{userid}', 'BillingController@saveBillingInfo')->name('billing.saveinfo');
//    FRONT
//    Route::get('/profile/{userid}/', 'UserController@getProfile')->name('profile.info');
    Route::get('/profile/edit/{userid}', 'UserController@edit')->name('profile.edit');
    Route::patch('/profile/edit/{userid}/update', 'UserController@update')->name('profile.update');
});

/* ADMIN ROUTES | MIX NAMESPACE */
Route::group([
    'prefix' => 'adm' . config('tiketike.urladminsalt'),
    'middleware' => ['auth']
], function (){

    //Rafles
    Route::group([
        'prefix' => 'raffles',
    ], function (){
        Route::post('/null/{id}', 'RafflesController@null')->name('raffles.null');
    });

});


/* PURE ADMIN ROUTES | ADMIN NAMESPACE */
//TODO: Filter this by role, implement authorization i mean
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'adm' . config('tiketike.urladminsalt'),
    'middleware' => ['auth']
], function () {

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('/', 'LangController@localizator')->name('admin.lansw');

    // Users Management
    Route::resource('/users', 'UserController', ['except' => [ 'show']]);
    Route::put('/users.updateadmin/{userid}', 'UserController@updateadmin')->name('users.updateadmin');

    // Roles Management
    Route::resource('/roles', 'RoleController', ['except' => [ 'show']]);

    // Promos Management
    Route::resource('/promos', 'PromoController', ['except' => ['edit', 'show']]);
    Route::resource('/pmclients', 'PromoClientController', ['except' => ['edit', 'create']]);

    // Raffles Management
    Route::group([
        'prefix' => 'raffles',
    ], function () {
        Route::resource('/published', 'PRaffleController', ['except' => ['edit', 'show']]);
        Route::resource('/unpublished', 'URaffleController', ['except' => ['edit', 'show', 'destroy']]);
        Route::post('/publish/{id}', 'URaffleController@publish')->name('unpublished.publish');
        Route::get('/anulled', 'ARaffleController@index')->name('arraffle.index');
        Route::delete('/destroy/{id}', 'ARaffleController@destroy')->name('arraffle.destroy');

        Route::resource('/categories', 'CategoriesController', ['except' => ['edit', 'show']]);

        // TODO Change the name for two these views
        Route::get('/config', 'AdminConfigController@showraffleconfig')->name('admin.raffle.showconfig');
        Route::patch('/saveconfig', 'AdminConfigController@saveraffleconfig')->name('admin.raffle.saveconfig');

    });

    //    Roles Manager
    //    Route::group([
    //        'middleware' => ['permission:roles list']
    //    ], function (){
    //        Route::resource('/roles','RoleController', ['except' => ['edit', 'show']]);
    //    });


});

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');


Route::group(['prefix' => 'raffles'
], function () {
//publishing raffle access route
    Route::get('/{raffleId}/tickets/buy', 'DirectBuysController@availableTickets')->name('raffle.tickets.available');

    Route::get('/{raffleId}/{referralId}', 'ReferralsBuysController@availableTickets')->name('referrals.tickets.available');
});

Route::group(['prefix' => 'users'
], function () {
    Route::get('/profile/{userid}/', 'UserController@getProfile')->name('profile.info');
});
