<?php

namespace App\Console\Commands;

use App\Models\Email;
use App\Services\ImageService;
use Illuminate\Console\Command;

class ProcessRawImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:raw-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resize all raw/downloaded images, resize them and crop upper right corner out' ;

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
        ImageService::crop();
    }
}
