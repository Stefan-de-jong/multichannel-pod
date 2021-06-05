<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Services\EmailService;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Webklex\PHPIMAP\Exceptions\RuntimeException;
use Illuminate\Http\Request;
use Webklex\PHPIMAP\ClientManager;

class DashboardController extends Controller
{
    private $cm;

    /**
     * EmailController constructor.
     *
     */
    public function __construct()
    {
        $this->cm = new ClientManager('../config/imap.php');
    }

    public function index()
    {
        $this->cm->connect();
        $inbox = $this->cm->getFolderByName('INBOX');
        $processed = $this->cm->getFolderByName('TCR');

        $inboxMessages = $inbox->messages()->all()->get();
        $processedMessages = $processed->messages()->all()->get();


//        $files = Storage::disk('local')->files('images/step1');
//        dd($files);

        $allFiles = Storage::disk('local')->files('images/step1');
        $files = array();

        foreach ($allFiles as $file) {
            $files[] = $this->fileInfo(pathinfo(Storage::path('') . $file));
        }

        return view('dashboard', compact('inboxMessages', 'processedMessages', 'files'));
    }


    /**
     * @throws RuntimeException
     */
    public function downloadAttachments()
    {
        if(EmailService::DownloadAttachments() == 0){
            return redirect('dashboard');
        }
        return back(500);
    }

    public function cropImages()
    {
        ImageService::crop();
        return redirect('dashboard');
    }

    private function fileInfo($filePath)
    {
        $file = array();
        $file['name'] = $filePath['filename'];
        $file['extension'] = $filePath['extension'];
        $file['size'] = $this->formatBytes(filesize($filePath['dirname'] . '/' . $filePath['basename']),2);

        return $file;
    }


    private function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}
