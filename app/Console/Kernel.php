<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\DownloadAttachments::class,
        \App\Console\Commands\ProcessRawImages::class,
        \App\Console\Commands\ProcessCroppedImages::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Commands to run, if server is configured with a cronjob to run 'php artisan schedule:run' each minute
        $schedule->command('download:attachments')->everyFifteenMinutes();
        $schedule->command('process:raw-images')->everyFifteenMinutes();
        $schedule->command('process:cropped-images')->everyFifteenMinutes();
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
