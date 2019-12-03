<?php

namespace App\Http\Controllers;

use App\Country;
use App\Promo;
use App\Raffle;
use App\RaffleCategory;
use App\Repositories\RaffleRepository;
use App\User;
use App\WelcomePoster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller

{
    private $raffleRepository;

    /**
     * MainController constructor.
     * @param $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->raffleRepository = $raffleRepository;
    }


    public function index(){
        $raffles = $this->raffleRepository->almostsoldraffles();
        $categories = RaffleCategory::all();
        $top_users = User::orderBy('ranking','DESC')->limit(10)->get();
        $promos = Promo::where('status',1)->where('type',0)->get();
        $countries = Country::all();
        $welcome_poster = WelcomePoster::all();
        $welcome_title = $welcome_poster->first()->title;
        $welcome_subtitle = $welcome_poster->first()->subtitle;
        return view('main',compact('raffles','top_users','promos','categories','countries','welcome_title','welcome_subtitle'));
    }



    public function markAsRead() {
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json([
            'status' => 'Notifications mark as read'
        ],200);
    }
}
