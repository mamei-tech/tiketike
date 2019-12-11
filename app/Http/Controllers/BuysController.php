<?php

namespace App\Http\Controllers;

use App\Country;
use App\Promo;
use App\RaffleCategory;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use App\Raffle;
use App\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

abstract class BuysController extends Controller
{
    private $raffleRepository;

    /**
     * BuysController constructor.
     * @param $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->raffleRepository = $raffleRepository;
    }






}
