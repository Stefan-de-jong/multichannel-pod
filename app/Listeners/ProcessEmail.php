<?php

namespace App\Listeners;

use App\Events\NewEmailToProcessEvent;
use App\Models\Email;
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

        // dit werkt nu!
        foreach ($events->message as $event){
            //dd($event);
            Email::create(['from' => $event->from, 'subject' => $event->subject, 'body' => $event->getTextBody(), 'processed' => false]);
            $event->move($folder_path = "TCR");
        }


    }
}
