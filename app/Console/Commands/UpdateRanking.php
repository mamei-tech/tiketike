<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
                $created_raffles = count($user->getRaffles());
                $buyed_tickets = count($user->getTickets());
                $tickets = User::with('getTickets')
                    ->whereHas('getTickets', function (Builder $q) use ($user){
                        $q->where('bingo',0);
                        $q->where('buyer',$user->id);
                    })
                    ->get();
                $times_winner = count($tickets);
                $raferals = count($user->getReferralsBuys());
                $comments = count($user->getComments());
                $ranking = $created_raffles*0.3 + $buyed_tickets*0.05 + $times_winner*0.3 + $raferals*0.3 + $comments*0.05;
                User::update([
                    'ranking' => $ranking
                ],$user);
            }

    }
}
