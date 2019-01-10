<?php

namespace App\Http\Controllers;

use App\Raffle;
use App\Repositories\RaffleRepository;
use App\User;
use Illuminate\Http\Request;


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
        $top_users = User::orderBy('ranking','DESC')->limit(3)->get();
        return view('main',compact('raffles','top_users'));

    }
}
