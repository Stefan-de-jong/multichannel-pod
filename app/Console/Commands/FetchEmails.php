<?php

namespace App\Console\Commands;

use App\Services\EmailService;
use Illuminate\Console\Command;
use Webklex\PHPIMAP\Exceptions\RuntimeException;

class FetchEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect new emails from the server and store in DB';

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
     * @return int
     * @throws RuntimeException
     */
    public function handle() : int
    {
        if(EmailService::GetEmails() == 0){
            $this->info('Command executed successfully');
            return 0;
        }
        else $this->info('Command execution failed, check error log');
        return 1;
    }
}
