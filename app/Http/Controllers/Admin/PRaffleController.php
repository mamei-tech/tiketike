<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\RaffleAnulled;
use App\Notifications\RaffleDeleted;
use App\Notifications\RaffleFinished;
use App\Notifications\RaffleWinned;
use App\Payment;
use App\Raffle;
use App\Repositories\RaffleRepository;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PRaffleController extends Controller
{
    private $raffleRepository;

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

    public function shuffle($id)
    {
        $raffle = Raffle::findOrFail($id);
        $code = $raffle->shuffle();
        $raffle->status = 5;
        $raffle->save();
        $winner = Ticket::where('code', '=', $code)->firstOrFail();
        $user_winner = $winner->getBuyer;
        $winner->bingo = 1;
        $winner->save();
        Notification::send($user_winner,new RaffleWinned($raffle,$user_winner));
        Notification::send($raffle->getOwner,new RaffleFinished($raffle,$raffle->getOwner));
        return redirect()->back(200);
    }

    /**
     *
     * Anullate the raffle
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function null($id) {
        $raffle = Raffle::findOrFail($id);
//        foreach ($raffle->getFollowers as $user) {
//            $user->notify(new RaffleDeleted($raffle,$user));
//        }
//        $raffle->getOwner->notify(new RaffleAnulled($raffle,$raffle->getOwner));

        $payback = new Payment();
        $payback->name = "A raffle ".$raffle->title." was anulled";
        $payback->description = "You have to pay back to all users that had buy a ticket on this raffle";
        $payback->status = "Pending";
        $payback->save();
        $users = array();
        foreach ($raffle->getTickets as $ticket) {
            array_push($users,$ticket->getBuyer->id);
        }
        $payback->getUser()->sync($users);
        $payback->getRaffle()->save($raffle);
        $raffle->anullate();

        return redirect()->back()
            ->with('success', 'Raffle "' . $id . '" anulled successfully');

    }
}

