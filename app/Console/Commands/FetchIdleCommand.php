<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Webklex\IMAP\Events\MessageNewEvent;
use Webklex\PHPIMAP\Client;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\EventNotFoundException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Exceptions\InvalidMessageDateException;
use Webklex\PHPIMAP\Exceptions\MessageContentFetchingException;
use Webklex\PHPIMAP\Exceptions\MessageHeaderFetchingException;
use Webklex\PHPIMAP\Exceptions\RuntimeException;
use Webklex\PHPIMAP\Folder;
use Webklex\PHPIMAP\Message;

class FetchIdleCommand extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:idle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new messages by utilising imap idle';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws EventNotFoundException
     * @throws InvalidMessageDateException
     * @throws MessageContentFetchingException
     * @throws MessageHeaderFetchingException
     * @throws RuntimeException
     */
    public function handle() {
        /** @var Client $client */
        $client = \Client::account("default");
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
            $folder->idle(function($message){
                /** @var Message $message */
                //event(new MessageNewEvent($message));
                //$message->move('TCR');
            });
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
