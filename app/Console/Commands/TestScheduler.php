<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class TestScheduler extends Command
{

    protected $signature = 'test:scheduler';

    protected $description = 'create new user';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        Log::info('TestScheduler Worker');

    }

}
