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
     */
    public function __construct(RaffleRepository $raffleRepository)
    {
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
        $raffle = $payment->getRaffle->first();
        $price = $raffle->tickets_price;
        $amount = $price * count($raffle->getTickets);
        $users = "";
        foreach ($payment->getUser as $user) {
            $users .= $user->name." ".$user->lastname.";";
        }
        $response['user'] = $users;
        $response['amount'] = round($amount,2);
        return $response;
    }
}
