<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Webklex\PHPIMAP\Message;

class NewEmailToProcessEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Message $message */
    public $message;

    /**
     * Create a new event instance.
     * @return void
     * @var Message[] $messages
     */
    public function __construct($message)
    {
        $this->message = $message;
    }
}
