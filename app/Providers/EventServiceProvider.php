<?php

namespace App\Providers;

use App\Events\NewEmailToProcessEvent;
use App\Listeners\ProcessEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Webklex\IMAP\Events\MessageNewEvent;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MessageNewEvent::class => [
            ProcessEmail::class,
        ],
        \Webklex\PHPIMAP\Events\MessageNewEvent::class => [
            ProcessEmail::class,
        ],
        NewEmailToProcessEvent::class => [
          ProcessEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
