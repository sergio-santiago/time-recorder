<?php

namespace App\Http\Controllers;

use App\TimeRecord;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
            ['user_id', '=', $user->id],
            ['init_time', '>=', Carbon::today()->startOfDay()],
            ['end_time', '<=', Carbon::today()->endOfDay()]
        ])->get();

        return view('time_record.time_record', ['timeRecords' => $timeRecords]);
    }

    /**
     * @return Factory|View
     */
    public function renderCreateTimeRecordForm()
    {
        return view('time_record.create_time_record');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function processCreateTimeRecordForm(Request $request)
    {
        return view('time_record.create_time_record');
    }
}
