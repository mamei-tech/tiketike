<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\RaffleAnulled;
use App\Notifications\RaffleDeleted;
use App\Notifications\RaffleFinished;
use App\Notifications\RaffleTerminatedAndNotWinned;
use App\Notifications\RaffleWinned;
use App\Payment;
use App\Raffle;
use App\RaffleConfirmation;
use App\Repositories\RaffleRepository;
use App\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PRaffleController extends Controller
{
    private $raffleRepository;

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
        $confirmation = new RaffleConfirmation();
        $confirmation->winner_id = $user_winner->id;
        $confirmation->owner_id = $raffle->getOwner->id;
        $confirmation->raffle_id = $raffle->id;
        $confirmation->oconfirmation = false;
        $confirmation->wconfirmation = false;
        $confirmation->save();
        Notification::send($user_winner,new RaffleWinned($raffle,$user_winner));
        Notification::send($raffle->getOwner,new RaffleFinished($raffle,$raffle->getOwner));
        $tickets = Ticket::where('bingo',0)->where('raffle',$raffle->id)->groupBy('buyer');
        foreach ($tickets as $ticket) {
            Notification::send($ticket->getBuyer,(new RaffleTerminatedAndNotWinned($raffle,$ticket->getBuyer))->delay(now()->addMinute()));
        }
        foreach ($raffle->getFollowers as $follower) {
            Notification::send($follower,(new RaffleTerminatedAndNotWinned($raffle,$follower))->delay(now()->addMinute()));
        }
        return redirect()->back()->with('success','The raffle was shuffled successfully.');
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

        $payback = new Payment();
        $payback->name = "A raffle ".$raffle->title." was anulled";
        $payback->description = "You have to pay back to all users that had buy a ticket on this raffle";
        $payback->status = "Pending";
        $payback->type = 'refund';
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

