<?php

namespace App\Http\Controllers;

use App\Raffle;
use Illuminate\Http\Request;


class MainController extends Controller

{
    public function index(){
        $raffles = Raffle::almostsoldraffles();
        return view('main',compact('raffles'));
    }


}
