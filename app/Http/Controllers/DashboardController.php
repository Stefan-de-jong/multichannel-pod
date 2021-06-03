<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Services\EmailService;
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

        return view('dashboard', compact('inboxMessages', 'processedMessages'));
    }


    /**
     * @throws RuntimeException
     */
    public function collectEmail()
    {
        if(EmailService::GetEmails() == 0){
            return redirect('dashboard');
        }
        return back(500);
    }
}
