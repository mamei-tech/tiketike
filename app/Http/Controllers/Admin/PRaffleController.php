<?php

namespace App\Http\Controllers\Admin;

use App\Raffle;
use App\Repositories\RaffleRepository;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PRaffleController extends Controller
{
    private $raffleRepository;
    // TODO Identify which methods apply to convert to rest method !!!!

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        // I think this is not needed because I have this in the route middleware
        // Authentication
        $this->middleware('auth');
        $this->middleware('permission:list raffles');
        $this->middleware('permission:create raffle', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit raffle', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete raffle', ['only' => ['destroy']]);
        $this->raffleRepository = $raffleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raffles = $this->raffleRepository->getTenPublishedRaffles();

        return view('admin.praffles', [
            'raffles' => $raffles,
            'div_showRaffles' => 'show',
            'li_activePRaffles' => 'active',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

