<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Raffle;
use App\Repositories\RaffleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Refund;

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
        $this->middleware('permission:pending_execute')    ->  only(['pending_execute']);

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

    public function pending_execute($id)
    {
        Stripe::setApiKey(env('STRIPE_KEY'));
        $payment = Payment::findOrFail($id);
        if ($payment->type == 'refund') {
            $raffle = $payment->getRaffle();
            $pending_pays = $raffle->getPaymentsAttached;
            foreach ($pending_pays as $pay) {
                $refund = Refund::create([
                    'charge' => $pay->charge_id,
                    'amount' => $pay->amount,
                    'reason' => 'Raffle ' . $raffle->title . ' was canceled.'
                ]);
                if ($refund['status'] != 'succeeded') {
                    return redirect()->back()
                        ->with('404', 'Refund failed');
                }
            }
        }else {
            //TODO investigate hoy to transfer money to another account
            return true;
//            $refund = Refund::create([
//                'charge' => $pay->charge_id,
//                'amount' => $pay->amount,
//                'reason' => 'Raffle ' . $raffle->title . ' was canceled.'
//            ]);
//            if ($refund['status'] != 'succeeded') {
//                return redirect()->back()
//                    ->with('404', 'Refund failed');
//            }
        }
        $payment->status = 'executed';
        $payment->save();
        return redirect()->back()
            ->with('success','Refund executed successfully');
    }
}
