<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        // init
        $newMessages = [];
        $processedMessages = [];

        ///todo fill it with a default response if nothing is found.
        try {
            $newMessages = DB::table('emails')->select('from', 'subject', 'attachment_count')->where('processed', 0)->get();
            $processedMessages = DB::table('emails')->select('from', 'subject', 'attachment_count')->where('processed', 1)->get();
        } catch (Exception $e) {

        } finally {
            return view('dashboard.index', compact('newMessages', 'processedMessages'));
        }
    }
}
