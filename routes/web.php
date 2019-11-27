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


/* FIRST LEVEL ROUTES */
Auth::routes();
Route::get('/', 'MainController@index')->name('main');
Route::post('/pusher/auth',function(Request $request) {
    return Broadcast::auth($request);
});

Route::group(['prefix' => 'raffles', 'middleware' => ['update_users']], function () {
    Route::get('/', 'RafflesController@index')->name('raffles.index');
});

/*-- USER SECTION -- */
Route::group(['prefix' => 'raffles',
    'middleware' => ['auth','update_users']
], function () {
    Route::post('/add', 'RafflesController@store')->name('raffles.index.store');
    Route::get('/edit/{raffleId}', 'RafflesController@edit')->name('raffles.edit');
    Route::post('/{raffleId}', 'RafflesController@update')->name('raffles.update');
    Route::get('{raffleId}/follow', 'RafflesController@follow')->name('raffles.follow');
    Route::post('/{raffleId}/tickets/buy', 'DirectBuysController@buyTickets')->name('raffle.tickets.buy');
    Route::post('/{raffleId}/{referralId}/{socialNetworkId}', 'ReferralsBuysController@buyTickets')->name('referrals.tickets.buy');
    Route::get('/search', 'RafflesController@busqueda')->name('raffles.index.search');

    Route::post('/{raffleId}/tickets/buy/comment','CommentsController@store')->name('raffle.comment');
    Route::post('/comment/edit/{commentId}','CommentsController@edit')->name('comment.edit');
    Route::get('/comment/delete/{commentId}','CommentsController@delete')->name('comment.delete');
    Route::post('/upload/images','RafflesController@uploadfile')->name('upload.images');
});

Route::group(['prefix' => 'payments',
    'namespace' => 'Admin',
    'middleware' => ['auth','update_users']
], function () {
    Route::get('/executed/list', 'PaymentController@executed')->name('payment.executed');
    Route::get('/pending/list', 'PaymentController@pending_list')->name('payment.pending.list');
    Route::get('/pending/pay/{payment}', 'PaymentController@pending_execute')->name('payment.pending.pay');
    Route::post('/pending/details', 'PaymentController@pending_details')->name('payment.pending.details');
});

Route::group(['prefix' => 'users',
    'middleware' => ['auth','update_users']
], function () {
    Route::get('/profile/edit/{userid}', 'UserController@edit')->name('profile.edit');
    Route::patch('/profile/edit/{userid}/update', 'UserController@update')->name('profile.update');
});

/* ADMIN ROUTES | MIX NAMESPACE */

/* PURE ADMIN ROUTES | ADMIN NAMESPACE */
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'adm' . config('tiketike.urladminsalt'),
    'middleware' => ['auth','update_users']
], function () {

    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::post('/', 'LangController@localizator')->name('admin.lansw');

    // Users Management
    Route::resource('/users', 'UserController', ['except' => ['show', 'store', 'create']]);
    Route::put('/users.updateadmin/{userid}', 'UserController@updateadmin')->name('users.updateadmin');

    // Roles Management
    Route::resource('/roles', 'RoleController', ['except' => [ 'show']]);

    // Promos Management
    Route::resource('/promos', 'PromoController', ['except' => ['edit', 'show']]);
    Route::resource('/pmclients', 'PromoClientController', ['except' => ['edit', 'create']]);

    // Raffles Management
    Route::group([
        'prefix' => 'raffles',
        'middleware' => ['update_users']
    ], function () {
        Route::resource('/published', 'PRaffleController', ['except' => ['edit', 'show', 'update', 'destroy']]);
        Route::resource('/unpublished', 'URaffleController', ['except' => ['edit', 'show', 'destroy', 'create']]);
        Route::post('/publish/{id}', 'URaffleController@publish')->name('unpublished.publish');
        Route::get('/anulled', 'ARaffleController@index')->name('arraffle.index');
        Route::delete('/destroy/{id}', 'ARaffleController@destroy')->name('arraffle.destroy');
        Route::get('/praffle/{id}/shuffle','PRaffleController@shuffle')->name('praffle.shuffle');
        Route::post('/null/{id}', 'PRaffleController@null')->name('raffles.null');

        Route::resource('/categories', 'CategoriesController', ['except' => ['edit', 'show']]);
        Route::get('/config', 'AdminConfigController@showraffleconfig')->name('admin.raffle.showconfig');
        Route::patch('/saveconfig', 'AdminConfigController@saveraffleconfig')->name('admin.raffle.saveconfig');
    });
});
Route::get('markasread','MainController@markAsRead')->name('mark.as.read');
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::group(['prefix' => 'raffles',
    'middleware' => ['update_users']
], function () {
//publishing raffle access route
    Route::get('/view/{raffleId}/finished','RafflesController@finishedView')->name('raffle.finished.view');
    Route::post('view/checkConfirmation/{raffleId}/finished','RafflesController@checkConfirmation')->name('raffle.finished.checkConfirmation');
    Route::get('/{raffleId}/tickets/buy', 'DirectBuysController@availableTickets')->name('raffle.tickets.available');
    Route::get('/{raffleId}/{referralId}/{socialNetworkId}', 'ReferralsBuysController@availableTickets')->name('referrals.tickets.available');
});

Route::group(['prefix' => 'users',
    'middleware' => ['update_users']
], function () {
    Route::get('/profile/{userid}/', 'UserController@getProfile')->name('profile.info');
    Route::get('{userid}/follow', 'UserController@follow')->name('user.follow');
    Route::get('{userid}/Unfollow', 'UserController@unFollow')->name('user.unfollow');
});
