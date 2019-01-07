<?php

namespace App\Http\Controllers;

use App\DebitCard;
use App\User;
use App\Http\Requests\StoreBillingInfoReques;

class BillingController extends Controller
{

    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
    }

    public function getBillingInfo($userid)
    {
        $user = User::with('debitcards')->findOrFail($userid);

        return view('admin.userbillinginfo', [
            'user' => $user,
        ]);
    }

    public function saveBillingInfo(StoreBillingInfoReques $request, $userid)
    {
        $user = User::with('profile')->findOrFail($userid);
        $debitcard = $user->debitcards->first();                // By now we only will manage one credit card by user

        // If there is no previous card
        if ($debitcard == null) {

            $dbcard = new DebitCard();

            $dbcard->accnumber = $request->accnumber;
            $debitcard->cvv = $request->cvv;
            $debitcard->expiration = $request->expdate_month . "/" . $request->expdate_year;

            $user->debitcards()->save($dbcard);
        }
        // If exist one card
        else {

            $debitcard->accnumber = $request->accnumber;
            $debitcard->cvv = $request->cvv;
            $debitcard->expiration = $request->expdate_month . "/" . $request->expdate_year;

            $debitcard->save();
        }

        return redirect()->route('billing.info',
            [
                'user' => $user,
            ],
            '303')
            ->with('success', 'billing info of "' . $user->profile->username . '" user was updated successfully');
    }

}
