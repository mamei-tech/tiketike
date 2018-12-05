<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RaffleConfigRequest;
use App\Http\TkTk\Cfg\CfgRaffles;


class AdminConfigController extends Controller
{
    private $cfghandler =  null;                   // Raffle configs handler

    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        // Authentication
        $this->middleware('auth');

        /* TODO: Check what this is for, how to use it */
        // Authorization

        /* -- The rest of the thing -- */
        // Makin a new config handler
        $this->cfghandler = new CfgRaffles();
    }

    /**
     * Display Raffle Configurations Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showraffleconfig()
    {
        // Setting this for sending it
        $cnf = [
            'gwfee'                     => $this->cfghandler->getConfig('gwfee'),
            'minextractbalance'         => $this->cfghandler->getConfig('minextractbalance')
        ];

        return view('admin.confviews.raffles', [
            'div_showRaffles' => 'show',
            'li_activeRConfig' => 'active',

            'cnf' => $cnf,
        ]);
    }

    /**
     * Save Raffle Configurations Form.
     *
     * @param RaffleConfigRequest $request
     * @return \Illuminate\Http\Response
     */
    public function saveraffleconfig(RaffleConfigRequest $request)
    {
        //Setting
        $this->cfghandler->setConfig('gwfee', $request->transactionfee);
        $this->cfghandler->setConfig('minextractbalance', $request->minextractbalance);

        $cnf = [
            'gwfee'                     => $this->cfghandler->getConfig('gwfee'),
            'minextractbalance'         => $this->cfghandler->getConfig('minextractbalance')
        ];

        return redirect()->route('admin.raffle.showconfig',
            compact('cfg', $cnf),
            '303')
            ->with('success', trans('aRaffle.saveconfsucces'));
    }

}
