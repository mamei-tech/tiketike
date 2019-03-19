<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class UpdateRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ranking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is the job to update users ranking';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user)
        {
            $created_raffles = count($user->getRaffles);
            $buyed_tickets = count($user->getTickets);
            $times_winner =$user->WinnedRaffles();
            $raferals = count($user->getReferralsBuys);
            $comments = count($user->getComments);
            $ranking = $created_raffles*0.3 + $buyed_tickets*0.05 + $times_winner*0.3 + $raferals*0.3 + $comments*0.05;
            $user->ranking = $ranking;
            $user->save();
        }

    }
}