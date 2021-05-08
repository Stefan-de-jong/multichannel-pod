<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Webklex\PHPIMAP\ClientManager;

class EmailController extends Controller
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
        $folders = $this->cm->getFolders();

        foreach ($folders as $folder){
            $messages = $folder->messages()->all()->get();
        }

        foreach ($messages as $message){
            $email = Email::create(['from' => $message->from, 'subject' => $message->subject, 'body' => $message->getTextBody(), 'processed' => false]);
        }

        return view('email.index', compact('messages'));
    }
}
