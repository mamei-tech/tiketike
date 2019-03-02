<?php

namespace App\Http\Controllers\Api\V1;

use App\ActiveUsers;
use App\Http\Controllers\Api\ApiController;
use App\Raffle;
use App\RaffleStatus;
use App\Ticket;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DashboardController extends ApiController
{
    public function activeUsers() {

        ActiveUsers::updateActiveUsers();

        $trackedActiveUsers = ActiveUsers::all(); //Allways are 30 items
        $male_users     = [];
        $female_users   = [];
        for ($i = count($trackedActiveUsers) - 1; $i >= 0; $i--) {
            array_push($male_users, $trackedActiveUsers[$i]->male_count);
            array_push($female_users, $trackedActiveUsers[$i]->female_count);
        }
        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male_users'    => $male_users,
            'female_users'  => $female_users,
        ]);
    }

    public function publishedRaffles() {
        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'publishedRaffles' => $this->activatedRafflesByMonth(),
        ]);
    }

    function activatedRafflesByMonth() {
        $currenYear = date('Y');
//        $raffles = Raffle::whereYear('activation_date', $currenYear)->get();
//        $rafflesByMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
//        foreach ($raffles as $r)
//            $rafflesByMonth[$r->activation_date->month() - 1]++;
//        return $rafflesByMonth;
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
            count(Raffle::whereYear('activation_date', $currenYear)->whereMonth('activation_date', 12)->get()),
        ];
    }

    public function registeredUsers() {
        $maleCount      = 0;
        $femaleCount    = 0;
        User::chunk(1000, function ($users) use (&$maleCount, &$femaleCount){
            foreach ($users as $u) {
                if (strtolower($u->getProfile->gender) == 'male')
                    $maleCount++;
                else
                    $femaleCount++;
            }
        });

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male'      => $maleCount,
            'female'    => $femaleCount,
        ]);
    }

    public function rafflesByStatus() {

        $unpublished    = 0;
        $published      = 0;
        $cancelled      = 0;
        $sold           = 0;
        $shuffled       = 0;
        $confirmed      = 0;
        Raffle::chunk(1000, function ($raffles)
            use (&$unpublished, &$published, &$cancelled, &$sold, &$shuffled, &$confirmed) {

            foreach ($raffles as $r) {
                switch ($r->getStatus->status) {
                    case 'Unpublished':
                        $unpublished++;
                        break;
                    case 'Published':
                        $published++;
                        break;
                    case 'Cancelled':
                        $cancelled++;
                        break;
                    case 'Sold':
                        $sold++;
                        break;
                    case 'Shuffled':
                        $shuffled++;
                        break;
                    case 'Confirmed':
                        $confirmed++;
                        break;
                }
            }
        });

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'unpublished'   => $unpublished,
            'published'     => $published,
            'cancelled'     => $cancelled,
            'sold'          => $sold,
            'shuffled'      => $shuffled,
            'confirmed'     => $confirmed,
        ]);
    }

    public function soldedTickets() {
        $anulledId = RaffleStatus::where('status', 'Cancelled')->first()->id;
        $soldedTicketsDirec = DB::table('tickets')
            ->join('raffles', 'raffles.id', '=', 'tickets.raffle')
            ->where('raffles.status', '!=', $anulledId)
            ->where('tickets.sold', true)
            ->where('tickets.soldByCom', false)->get();

        $soldedTicketsByCom = DB::table('tickets')
            ->join('raffles', 'raffles.id', '=', 'tickets.raffle')
            ->where('raffles.status', '!=', $anulledId)
            ->where('tickets.sold', true)
            ->where('tickets.soldByCom', true)->get();

        $directMaleSolds = count(
            DB::table('usersprofiles')
                ->join('tickets', 'usersprofiles.user', '=', 'tickets.buyer')
                ->join('raffles', 'tickets.raffle', '=', 'raffles.id')
                ->where('raffles.status', '!=', $anulledId)
                ->where('tickets.soldByCom', false)
                ->where('usersprofiles.gender', 'male')->get()
        );

        $comMaleSolds = count(
            DB::table('usersprofiles')
                ->join('tickets', 'usersprofiles.user', '=', 'tickets.buyer')
                ->join('raffles', 'tickets.raffle', '=', 'raffles.id')
                ->where('raffles.status', '!=', $anulledId)
                ->where('tickets.soldByCom', true)
                ->where('usersprofiles.gender', 'male')->get()
        );

        $remainTickets = count(Ticket::where('sold', false)->get());

//        $directlyMoneyCount = 0;
//        foreach($soldedTicketsDirec as $std)
//            $directlyMoneyCount += $std->tickets_price;
//
//        $comMoneyCount = 0;
//        foreach($soldedTicketsByCom as $stc)
//            $comMoneyCount += $stc->tickets_price;

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male_referrals'    => $comMaleSolds,
            'female_referrals'  => count($soldedTicketsByCom) - $comMaleSolds,
            'male_directly'     => $directMaleSolds,
            'female_directly'   => count($soldedTicketsDirec) - $directMaleSolds,
            'remain'            => $remainTickets,
        ]);
    }

    public function soldedTicketsBySocialNetworks() {

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male_facebook'     => 156,
            'female_facebook'   => 60,
            'male_twitter'      => 90,
            'female_twitter'    => 84,
            'male_instagram'    => 105,
            'female_instagram'  => 125,
        ]);
    }
}
