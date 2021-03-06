<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Repositories\RaffleRepository;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

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

    /**
     * List the executed payments
     *
     */
    public function executed()
    {
        // TODO Pending
        $payments = Payment::where('status','=','executed')->get();

        var_dump($payments);
        die();
    }

    /**
     * List of pending payments
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Make a payment. Witedraw or RollBack
     *
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    public function pending_execute($id)
    {
        // Witedraw ??
        Stripe::setApiKey(env('STRIPE_KEY'));
        $payment = Payment::findOrFail($id);
        if ($payment->type == 'refund') {
            $raffle = $payment->getRaffle();
            $pending_pays = $raffle->getPaymentsAttached;
            foreach ($pending_pays as $pay)
            {
                $refund = Refund::create([
                    'charge' => $pay->charge_id,  'amount' => $pay->amount,
                    'reason' => 'Raffle ' . $raffle->title . ' was canceled.'  // TODO Transalation
                ]);
                if ($refund['status'] != 'succeeded') {
                    return redirect()->back()
                        ->with('404', 'Refund failed');
                }

                //TODO poner el dueño del tike que se le va a realziar el refaund en el arreglo null del log
                Log::log('INFO', trans('aLogs.adm_refaund_exction'), [
                    'user'      => Auth::user()->id,
                ]);
            }

        }else {
            //TODO investigate hoy to transfer money to another account
            //TODO poner en el contexto del Log el ide del usuario de la rifa, en el arreglo que esta vacia
            Log::log('INFO', trans('aLogs.adm_witedraw_exc'), [
                    'user'      => Auth::user()->id,
                ]);

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
