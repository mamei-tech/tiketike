<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Raffle;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{

    private $raffleRepository;


    /**
     * PaymentController constructor.
     * @param RaffleRepository $raffleRepository
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
        $this->middleware('permission:list_roles')                  ->  only(['executed']);
        $this->middleware('permission:pending_list_payments')       ->  only(['pending_list']);
        $this->middleware('permission:pending_details_payments')    ->  only(['pending_details']);

        $this->raffleRepository = $raffleRepository;
    }

    public function executed()
    {
        $payments = Payment::where('status','=','executed')->get();
        var_dump($payments);
        die();
    }

    public function pending_list()
    {
        $payments = Payment::where('status','=','pending')->paginate(10);
        return view('admin.payment_pending',compact('payments'));
    }

    public function pending_details(Request $request)
    {
        $id = $request->get('payment');
        $response = array();
        $payment = Payment::find($id);
        if (count($payment->getUser) > 0)
        {
            $user = $payment->getUser->first();
            $response['amount'] = $user->getProfile->balance;
            $response['user'] = $user->name." ".$user->lastname.";";
        }else {
            $raffle = $payment->getRaffle->first();
            $tickets = $raffle->getTicketsSold();
            $response['amount'] = count($tickets)*$raffle->tickets_price;
            $users = "";
            foreach ($tickets as $ticket) {
                $users .= $ticket->getBuyer->name." ".$ticket->getBuyer->lastname.";";
            }
            $response['user'] = $users;
        }

        return $response;
    }
}
