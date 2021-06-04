<?php


namespace App\Services;


use App\Events\NewEmailToProcessEvent;
use Illuminate\Support\Facades\Log;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Exceptions\ConnectionFailedException;
use Webklex\PHPIMAP\Exceptions\FolderFetchingException;
use Webklex\PHPIMAP\Exceptions\RuntimeException;

class EmailService
{

    /**
     * @return int
     * @throws RuntimeException
     */
    public static function DownloadAttachments() : int
    {
        // Connecting to the email client
        $client = Client::account("default");
        try {
            $client->connect();
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }

        // Getting the inbox folder
        try {
            $folder = $client->getFolderByName("INBOX");
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        } catch (FolderFetchingException $e) {
            Log::error($e->getMessage());
            return 1;
        }


        // Collect all message in the folder and fire event if there are any
        try {
            $messages = $folder->messages()->all()->get();
            if (count($messages) > 0){
                event(new NewEmailToProcessEvent($messages));
            }
        } catch (ConnectionFailedException $e) {
            Log::error($e->getMessage());
            return 1;
        }
        return 0;
    }
}
