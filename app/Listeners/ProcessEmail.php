<?php

namespace App\Listeners;

use App\Models\Email;
use \Webklex\IMAP\Events\MessageNewEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
    public function handle(MessageNewEvent $event)
    {
        Email::create(['from' => $event->message->from, 'subject' => $event->message->subject, 'body' => $event->message->getTextBody(), 'processed' => false]);
    }
}
