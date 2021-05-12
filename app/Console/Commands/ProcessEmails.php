<?php

namespace App\Console\Commands;

use App\Models\Email;
use Illuminate\Console\Command;

class ProcessEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect all emails from DB with processed = false, and process them';

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
     */
    public function handle()
    {
        $emails = Email::where('processed', '=', false)->get();

        foreach ($emails as $email){
            $email->processed = true;
            $email->save();
        }
    }
}
