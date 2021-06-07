<?php

namespace App\Listeners;

use App\Events\NewEmailToProcessEvent;
use App\Models\Attachment;
use App\Models\Email;
use Illuminate\Support\Facades\Storage;
use Throwable;
use \Webklex\IMAP\Events\MessageNewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Webklex\PHPIMAP\Message;

class ProcessEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageNewEvent  $event
     * @return void
     */
    public function handle(NewEmailToProcessEvent $events)
    {
        foreach ($events->message as $message){
            // create new email object to store in DB
            $email = Email::create(['from' => $message->from, 'subject' => $message->subject, 'n_attachments' => $message->getAttachments()->count(), 'message_id' => $message->message_id, 'processed' => false]);

            // if there are attachments, collect them all
            if($message->hasAttachments()){
                $attachments = $message->getAttachments();

                foreach ($attachments as $attachment){
                    $path = Storage::path('images\originals\step1\\');
                    $filename = pathinfo($attachment->name, PATHINFO_FILENAME) . '_' . time() . '.' . $attachment->getExtension();

                    // Saving the attachment file to disk
                    $attachment->save($path, $filename);

                    // creating a new attachment object to store in DB
                    Attachment::create(['email_id' => $email->id,'file_name' => $filename, 'step' => 1, 'processed' => false]);
                }
            }
            $message->move($folder_path = "TCR");
        }
    }
}
