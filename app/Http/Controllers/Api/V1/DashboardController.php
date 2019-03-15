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

//        ActiveUsers::updateActiveUsers();
//
//        $trackedActiveUsers = ActiveUsers::all(); //Allways are 30 items
        $male_users     = [];
        $female_users   = [];
        //TODO Arreglar.
        for($i = 0; $i < 30; $i++)
        {
            $male_users[$i] = rand(1, 100);
            $female_users[$i] = rand(1, 100);
        }
//        for ($i = count($trackedActiveUsers) - 1; $i >= 0; $i--) {
//            array_push($male_users, $trackedActiveUsers[$i]->male_count);
//            array_push($female_users, $trackedActiveUsers[$i]->female_count);
//        }
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

    static function maleSolds($byCom) {
        return count(
            DB::table('usersprofiles')
                ->join('tickets', 'usersprofiles.user', '=', 'tickets.buyer')
                ->join('raffles', 'tickets.raffle', '=', 'raffles.id')
                ->where('raffles.status', '!=', 3)
                ->where('tickets.soldByCom', $byCom)
                ->where('usersprofiles.gender', 'male')->get()
        );
    }

    public function soldedTickets() {
        $soldedTicketsDirec = DashboardController::soldedTicketsBy(false);
        $soldedTicketsByCom = DashboardController::soldedTicketsBy(true);

        $directMaleSolds = DashboardController::maleSolds(false);

        $comMaleSolds = DashboardController::maleSolds(true);

        $remainTickets = count(Ticket::where('sold', false)->get());

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

    static function soldedTicketsBySocialNetworksAux($netId, $gender) {
        return count(
            DB::table('referralsbuys')
                ->join('users', 'referralsbuys.comisionist', '=', 'users.id')
                ->join('usersprofiles', 'usersprofiles.user', '=', 'users.id')
                ->where('referralsbuys.socialNetwork', '=', $netId)
                ->where('usersprofiles.gender', '=', $gender)->get()
        );
    }

    public function soldedTicketsBySocialNetworks() {

        $male_facebook = DashboardController::soldedTicketsBySocialNetworksAux(1, 'male');
        $female_facebook = DashboardController::soldedTicketsBySocialNetworksAux(1, 'female');

        $male_twitter = DashboardController::soldedTicketsBySocialNetworksAux(2, 'male');
        $female_twitter = DashboardController::soldedTicketsBySocialNetworksAux(2, 'female');

        $male_instagram = DashboardController::soldedTicketsBySocialNetworksAux(3, 'male');
        $female_instagram = DashboardController::soldedTicketsBySocialNetworksAux(3, 'female');

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'male_facebook'     => $male_facebook,
            'female_facebook'   => $female_facebook,
            'male_twitter'      => $male_twitter,
            'female_twitter'    => $female_twitter,
            'male_instagram'    => $male_instagram,
            'female_instagram'  => $female_instagram,
        ]);
    }

    static function soldedTicketsBy($byCom) {
        return DB::table('tickets')
            ->join('raffles', 'raffles.id', '=', 'tickets.raffle')
            ->where('raffles.status', '!=', 3)
            ->where('tickets.sold', true)
            ->where('tickets.soldByCom', $byCom)->get();
    }

    public function moneyByTickets() {
        $soldedTicketsDirec = DashboardController::soldedTicketsBy(false);
        $soldedTicketsByCom = DashboardController::soldedTicketsBy(true);

        $directlyMoneyCount = 0;
        foreach($soldedTicketsDirec as $std) {
            $directlyMoneyCount += $std->tickets_price;
        }

        $comMoneyCount = 0;
        foreach($soldedTicketsByCom as $stc) {
            $comMoneyCount += $stc->tickets_price;
        }

        return $this->respond([
            'status' => 'success',
            'status_code' => Response::HTTP_OK,
            // Payload
            'directly'     => round($directlyMoneyCount, 2),
            'referrals'    => round($comMoneyCount, 2),
            'net_gain'     => round(Raffle::rafflesNetGain(), 2),
        ]);
    }
}
