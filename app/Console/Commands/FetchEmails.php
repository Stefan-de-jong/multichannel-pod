<?php

namespace App\Console\Commands;

use App\Events\NewEmailToProcessEvent;
use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Webklex\IMAP\Events\MessageNewEvent;

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
            Log::error($e->getMessage());
            return 1;
        }

        /** @var Folder $folder */
        try {
            $folder = $client->getFolder("INBOX");
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        } catch (FolderFetchingException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        try {
            $messages = $folder->messages()->all()->get();
            foreach ($messages as $message){
                //print_r($message->getAttributes());
                $this->info('New message from ' . $message->getFrom() . ' with subject: ' . $message->getSubject());
                //$this->info('New message with subject: ' . $message->getSubject() . ' and id: ' . $message->getMessage_id());
                $this->newLine();
            }
            event(new NewEmailToProcessEvent($messages));
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
