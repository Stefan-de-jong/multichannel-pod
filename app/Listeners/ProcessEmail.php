<?php

namespace App\Listeners;

use App\Events\NewEmailToProcessEvent;
use App\Models\Email;
use Webklex\IMAP\Events\MessageNewEvent;
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
        foreach ($events->message as $email){
            if($email->hasAttachments()){
                $attachments = $email->getAttachments();
                Email::create(['from' => $email->from, 'subject' => $email->subject, 'body' => $email->getTextBody(), 'message_id' => $email->message_id, 'attachment_count' => $attachments->count(), 'processed' => false]);

                foreach ($attachments as $attachment){
                    $attachment->save($path = "./storage/app/images/", $filename = pathinfo($attachment->name, PATHINFO_FILENAME) . '_' . time() . '.' . $attachment->getExtension());
                }
            }
            else{
                Email::create(['from' => $email->from, 'subject' => $email->subject, 'body' => $email->getTextBody(), 'message_id' => $email->message_id, 'processed' => false]);
            }

            $email->move($folder_path = "TCR");


        }
    }
}
