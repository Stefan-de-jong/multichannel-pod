<?php

namespace App\Console;

use App\Console\Commands\FetchIdleCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Webklex\IMAP\Commands\ImapIdleCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\FetchEmails::class,
        \App\Console\Commands\ProcessEmails::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Commands to run, if server is configured with a cronjob to run 'php artisan schedule:run' each minute
        $schedule->command('fetch:emails')->everyFiveMinutes();
        $schedule->command('process:emails')->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
