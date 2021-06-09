<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Services\ImageService;
use Illuminate\Console\Command;

class ProcessCroppedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:cropped-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use the detection script to detect the TCR-number, crop it out and save it';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        ImageService::process();
    }
}
