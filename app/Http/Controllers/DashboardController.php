<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webklex\PHPIMAP\Support\MessageCollection;

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

        /** @var MessageCollection $newMessages */
        $newMessages = DB::table('emails')->select('from','subject')->where('processed',0)->get();

        /** @var MessageCollection $processedMessages */
        $processedMessages = DB::table('emails')->select('from','subject')->where('processed', 1)->get();
xdebug_break();
        return view('dashboard.index', compact('newMessages','processedMessages'));
    }
}
