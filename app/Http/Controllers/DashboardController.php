<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
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
        $inboxMessages = $inbox->messages()->all()->get();

        $emails = Email::get()->count();
        $attachments = Attachment::get();

        $files = $this->getAllStepFiles(1);
        $croppedFiles = $this->getAllStepFiles(2);
        $processedFiles = $this->getAllStepFiles(3);



        return view('dashboard', compact('emails', 'attachments', 'inboxMessages', 'files', 'croppedFiles', 'processedFiles'));
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
        $this->updateStep(1);

        return redirect('dashboard');
    }

    public function processImages()
    {
        ImageService::process();
        $this->updateStep(2);

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

    /**
     * @return array
     */
    public function getAllStepFiles(int $step): array
    {
        $allFiles = Storage::disk('local')->files('images/originals/step' . $step);
        $files = array();
        foreach ($allFiles as $file) {
            $files[] = $this->fileInfo(pathinfo(Storage::path('') . $file));
        }
        return $files;
    }

    public function updateStep(int $step): void
    {
        $files = $this->getAllStepFiles($step+1);
        foreach ($files as $file) {
            Attachment::where([
                ['file_name', '=', $file['name'] . '.' . $file['extension']],
                ['step', '=', $step]
            ])->update(['step' => $step+1]);
        }
    }
}
