<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     *
     */
    public function __construct()
    {

    }
    public function index(){
        $newMessages = DB::table('emails')->select('from','subject', 'attachment_count')->where('processed',0)->get();

        $processedMessages = DB::table('emails')->select('from','subject', 'attachment_count')->where('processed', 1)->get();

        return view('dashboard.index', compact('newMessages','processedMessages'));
    }
}
