<?php

namespace App\Http\Controllers;

use App\Raffle;
use App\User;
use Illuminate\Http\Request;


class MainController extends Controller

{
    public function index(){
        $raffles = Raffle::almostsoldraffles();
        $top_users = User::orderBy('ranking','DESC')->limit(3)->get();
//        var_dump($top_users);
//        die();
        return view('main',compact('raffles','top_users'));

    }
}
