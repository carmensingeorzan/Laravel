<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UnverifyUserEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unverifyuseremail {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'unverify user email';

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
     * @param  \App\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        try {
        $id = $this->argument('id');
        
        $user = User::find($id);
        $user->confirmed_email = 0;
        $user->save();

        
    } catch (\Exception $e) {
        $this->error("UnverifyUserEmailCommand failed for $id with an exception");
        $this->error($e->getMessage());
        return 2;
    }

    $this->info("UnverifyUserEmailCommand passed for $id! The email for user with id $id was unverified.");

    return 0;
        
        
    }
}
