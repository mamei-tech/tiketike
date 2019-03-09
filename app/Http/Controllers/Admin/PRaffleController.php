<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\RaffleAnulled;
use App\Notifications\RaffleDeleted;
use App\Notifications\RaffleFinished;
use App\Notifications\RaffleWinned;
use App\Raffle;
use App\Repositories\RaffleRepository;
use App\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PRaffleController extends Controller
{
    private $raffleRepository;
    // TODO Identify which methods apply to convert to rest method !!!!

    /**
     * Create a new controller instance.
     *
     * @param RaffleRepository $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->middleware('permission:list_praffles')          ->  only(['index']);
        $this->middleware('permission:shuffle_praffles')       ->  only(['shuffle']);
        $this->middleware('permission:null_praffles')          ->  only(['null']);

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
        foreach ($raffle->getFollowers as $user) {
            $user->notify(new RaffleDeleted($raffle,$user));
        }
        $raffle->getOwner->notify(new RaffleAnulled($raffle,$raffle->getOwner));
        
        $raffle->anullate();

        return redirect()->back()
            ->with('success', 'Raffle "' . $id . '" anulled successfully');

    }
}

