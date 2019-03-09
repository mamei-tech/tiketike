<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use App\Raffle;
use App\RaffleStatus;
use App\ReferralsBuys;
use App\Ticket;
use App\User;
use App\UserProfile;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:enter_admin')          ->  only(['index']);
    }

    /**
     * Show the admin section dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $publishedId = RaffleStatus::where('status', 'Published')->first()->id;
//        $unpublishedId = RaffleStatus::where('status', 'Unpublished')->first()->id;
//        $anulledId = RaffleStatus::where('status', 'Cancelled')->first()->id;
//
//        $usersCount = count(User::all());
//        $maleUsers = count(UserProfile::where('gender', 'Male')->get());
//        $registeredRaffles = count(Raffle::all());
//        $activeRaffles = count(Raffle::where('status', $publishedId)->get());
//        $waitingRaffles = count(Raffle::where('status', $unpublishedId)->get());
//
//        $soldedTicketsDirec = DB::table('tickets')
//            ->join('raffles', 'raffles.id', '=', 'tickets.raffle')
//            ->where('raffles.status', '!=', $anulledId)
//            ->where('tickets.sold', true)
//            ->where('tickets.soldByCom', false)->get();
//
//        $soldedTicketsByCom = DB::table('tickets')
//            ->join('raffles', 'raffles.id', '=', 'tickets.raffle')
//            ->where('raffles.status', '!=', $anulledId)
//            ->where('tickets.sold', true)
//            ->where('tickets.soldByCom', true)->get();
//
//        $directMaleSolds = count(
//            DB::table('usersprofiles')
//                ->join('tickets', 'usersprofiles.user', '=', 'tickets.buyer')
//                ->join('raffles', 'tickets.raffle', '=', 'raffles.id')
//                ->where('raffles.status', '!=', $anulledId)
//                ->where('tickets.soldByCom', false)
//                ->where('usersprofiles.gender', 'Male')->get()
//        );
//
//        $comMaleSolds = count(
//            DB::table('usersprofiles')
//                ->join('tickets', 'usersprofiles.user', '=', 'tickets.buyer')
//                ->join('raffles', 'tickets.raffle', '=', 'raffles.id')
//                ->where('raffles.status', '!=', $anulledId)
//                ->where('tickets.soldByCom', true)
//                ->where('usersprofiles.gender', 'Male')->get()
//        );
//
//        $remainTickets = count(Ticket::where('sold', false)->get());
//
//        $directlyMoneyCount = 0;
//        foreach($soldedTicketsDirec as $std)
//            $directlyMoneyCount += $std->tickets_price;
//
//        $comMoneyCount = 0;
//        foreach($soldedTicketsByCom as $stc)
//            $comMoneyCount += $stc->tickets_price;

//        return view('admin.index',
//            [
//                'li_activeDash' => 'active',
//                'usersCount' => $usersCount,
//                'maleUsers' => $maleUsers,
//                'femaleUsers' => $usersCount - $maleUsers,
//                'registeredRaffles' => $registeredRaffles,
//                'activeRaffles' =>$activeRaffles,
//                'waitingRaffles' => $waitingRaffles,
//                'soldedTicketsCount' => count($soldedTicketsDirec) + count($soldedTicketsByCom),
//                'soldedTicketsCountByCom' => count($soldedTicketsByCom),
//                'comMaleSolds' => $comMaleSolds,
//                'comFemaleSolds' => count($soldedTicketsByCom) - $comMaleSolds,
//                'soldedTicketsCountDirec' => count($soldedTicketsDirec),
//                'directMaleSolds' => $directMaleSolds,
//                'directFemaleSolds' => count($soldedTicketsDirec) - $directMaleSolds,
//                'remainTickets' => $remainTickets,
//                'moneyCountByTickets' => $directlyMoneyCount + $comMoneyCount,
//                'directlyMoneyCount' => $directlyMoneyCount,
//                'comMoneyCount' => $comMoneyCount,
//
//                'actRafflesByMonth' => $this->activatedRafflesByMonth(),
//            ]);

        return view('admin.index',
            [
                'li_activeDash' => 'active',
                'usersCount' => 0,
                'maleUsers' => 0,
                'femaleUsers' => 0,
                'registeredRaffles' => 0,
                'activeRaffles' =>0,
                'waitingRaffles' => 0,
                'soldedTicketsCount' => 0,
                'soldedTicketsCountByCom' => 0,
                'comMaleSolds' => 0,
                'comFemaleSolds' => 0,
                'soldedTicketsCountDirec' => 0,
                'directMaleSolds' => 0,
                'directFemaleSolds' => 0,
                'remainTickets' => 0,
                'moneyCountByTickets' => 0,
                'directlyMoneyCount' => 0,
                'comMoneyCount' => 0,

                'actRafflesByMonth' => $this->activatedRafflesByMonth(),
            ]);
    }

    function activatedRafflesByMonth()
    {
        $currenYear = date('Y');
        return [
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 1)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 2)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 3)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 4)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 5)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 6)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 7)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 8)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 9)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 10)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 11)->get()),
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 12)->get())
        ];
    }
}

