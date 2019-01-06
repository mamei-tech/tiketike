<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Raffle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
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
            $tickets = Raffle::getTicketsSold($raffle->id);
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
