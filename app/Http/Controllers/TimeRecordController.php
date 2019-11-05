<?php

namespace App\Http\Controllers;

use App\TimeRecord;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

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

        $timeRecords = TimeRecord::where([
            ['user_id', '=', "$user->id"],
            ['init_time', '>=', Carbon::today()->startOfDay()],
            ['end_time', '<=', Carbon::today()->endOfDay()]
        ])->get();

        return view('time_record', ['timeRecords' => $timeRecords]);
    }
}
