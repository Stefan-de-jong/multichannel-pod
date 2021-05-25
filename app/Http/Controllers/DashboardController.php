<?php

namespace App\Http\Controllers;

use App\Models\Email_Stats;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     *
     */
    public function __construct()
    {

    }

    /**
     * @return int, which is the status of the fetch:emails command.
     */
    public function processEmails(): int
    {
        return Artisan::call('fetch:emails');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // init
        $newMessages = [];
        $processedMessages = [];
        $processedEmail = new Email_Stats();
        $processedEmailFailed = new Email_Stats();

        ///todo fill it with a default response if nothing is found.
        try {

            // fetching messages
            $newMessages = $this->getNewMessages();
            $processedMessages = $this->getProcessedMessages();

            // fetching stats
            $processedEmail = $this->getProcessedEmailStats();
            $processedEmailFailed = $this->getFailedProcessedEmailStats();
        } catch (Exception $e) {

        } finally {
            return view('dashboard.index', compact('newMessages', 'processedMessages', 'processedEmail', 'processedEmailFailed'));
        }
    }

    /**
     * @return Collection of new messages that are not processed yet.
     */
    private function getNewMessages(): Collection
    {
        return DB::table('emails')->select('from', 'subject', 'attachment_count')->where('processed', 0)->get();
    }


    /**
     * @return Collection of processed messages.
     */
    private function getProcessedMessages(): Collection
    {
        return DB::table('emails')->select('from', 'subject', 'attachment_count')->where('processed', 1)->get();
    }


    /**
     * @return Email_Stats of processed emails.
     */
    private function getProcessedEmailStats(): Email_Stats
    {
        // a weeks time
        $start = Carbon::now()->subDays(7);
        $end = Carbon::now();

        $processedEmail = new Email_Stats();
        $processedEmail->WeeklyAmount = DB::table('emails')->whereBetween('created_at', array($start, $end))->where('processed', 1)->get()->count();
        $processedEmail->TotalAmount = DB::table('emails')->where('processed', 1)->get()->count();

        return $processedEmail;
    }

    /**
     * @return Email_Stats of failed processed emails.
     */
    private function getFailedProcessedEmailStats(): Email_Stats
    {
        // a weeks time
        $start = Carbon::now()->subDays(7);
        $end = Carbon::now();

        $processedEmailFailed = new Email_Stats();
        $processedEmailFailed->WeeklyAmount = DB::table('emails')->whereBetween('created_at', array($start, $end))->where('processed', 1)->where('failed', 1)->get()->count();
        $processedEmailFailed->TotalAmount = DB::table('emails')->where('processed', 1)->where('failed',1)->get()->count();

        return $processedEmailFailed;
    }
}
