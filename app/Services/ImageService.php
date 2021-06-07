<?php


namespace App\Services;


class ImageService
{

    public static function crop() : int
    {
        // Todo: add try catch block to catch any python exceptions
        shell_exec('D:\dev\multichannel-app\app\Scripts\resize.py');
        return 0;
    }


    public static function process() : int
    {
        // Todo: add try catch block to catch any python exceptions
        shell_exec('D:\dev\multichannel-app\app\Scripts\detect.py');
        return 0;
    }
}
