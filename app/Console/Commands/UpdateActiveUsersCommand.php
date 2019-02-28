<?php

namespace App\Console\Commands;

use App\ActiveUsers;
use Illuminate\Console\Command;

class UpdateActiveUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:active_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the active users in the las 30 days';

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
        ActiveUsers::shiftDays();
        ActiveUsers::updateActiveUsers();
    }
}
