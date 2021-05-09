<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Events\MessageNewEvent;

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
     */
    public function handle()
    {
        /** @var Client $client */
        $client = Client::account("default");
        try {
            $client->connect();
        } catch (ConnectionFailedException $e) {
            dd('niet connected');
            Log::error($e->getMessage());
            return 1;
        }
        //dd('connected');

        /** @var Folder $folder */
        try {
            $folder = $client->getFolder("INBOX");
            //dd($folder);
        } catch (ConnectionFailedException $e) {
            dd('conn failed excep');
            Log::error($e->getMessage());
            return 1;
        } catch (FolderFetchingException $e) {
            dd('folder fetch excep');
            Log::error($e->getMessage());
            return 1;
        }

        try {
            //$folder->idle(function($message){
            $messages = $folder->messages()->all()->get();
            //dd($messages);
            foreach ($messages as $message){
                echo $message->getSubject();
                echo $message->getFrom();
                echo $message->getTextBody();
            }
            event(new MessageNewEvent($messages));

        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }



        return 0;
    }
}
