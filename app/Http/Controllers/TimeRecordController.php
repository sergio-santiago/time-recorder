<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeRecordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $timeRecords = DB::table('time_records')
            ->where('user_id', $user['id'])
            ->where('init_time', '>=', Carbon::today()->startOfDay())
            ->where('end_time', '<=', Carbon::today()->endOfDay())
            ->get();

        return view('time_record', ['timeRecords' => $timeRecords]);
    }
}
