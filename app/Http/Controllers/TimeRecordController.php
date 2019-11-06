<?php

namespace App\Http\Controllers;

use App\TimeRecord;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $this->decodeIntervalTimeFieldInTimeRecords($timeRecords);

        $totalInterval = $this->calculateSumIntervalTimes($timeRecords);
        return view('time_record.time_record', ['timeRecords' => $timeRecords, 'totalInterval' => $totalInterval]);
    }

    /**
     * @param $timeRecords
     * @return mixed
     */
    private function decodeIntervalTimeFieldInTimeRecords(&$timeRecords)
    {
        foreach ($timeRecords as $timeRecord) {
            $this->decodeIntervalTimeFieldInTimeRecord($timeRecord);
        }
        return;
    }

    /**
     * @param $timeRecord
     * @return mixed
     */
    private function decodeIntervalTimeFieldInTimeRecord(&$timeRecord)
    {
        $timeRecord->interval_time = json_decode($timeRecord->interval_time);
        return;
    }

    /**
     * @param $timeRecords
     * @return array
     */
    private function calculateSumIntervalTimes($timeRecords)
    {
        $total = [
            'hours' => 0,
            'minutes' => 0,
        ];

        foreach ($timeRecords as $timeRecord) {
            $total['hours'] += $timeRecord->interval_time->hours;
            $total['minutes'] += $timeRecord->interval_time->minutes;
            while ($total['minutes'] >= 60) {
                $total['hours']++;
                $total['minutes'] = $total['minutes'] - 60;
            }
        }

        return $total;
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
     * @throws Exception
     */
    public function processCreateTimeRecordForm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'init_time' => ['required', 'string', 'date_format:H:i', 'before:end_time'],
                'end_time' => ['required', 'string', 'date_format:H:i', 'after:init_time'],
            ],
            [
                'before' => 'The init time must be before the end time',
                'after' => 'The end time must be after the start time'
            ]
        );

        if ($validator->fails()) {
            return view('time_record.create_time_record')
                ->withErrors($validator);
        }

        TimeRecord::create([
            'init_time' => new Carbon($request->init_time),
            'end_time' => new Carbon($request->end_time),
            'interval_time' => $this->calculateEncodedTimeRecordIntervalTime($request->init_time, $request->end_time),
            'user_id' => Auth::user()->id,
        ]);
        $request->session()->flash('alert-success', 'New time record created successfully!');

        return redirect('time-record');
    }

    /**
     * @param $initTime
     * @param $endTime
     * @return string
     * @throws Exception
     */
    private function calculateEncodedTimeRecordIntervalTime($initTime, $endTime)
    {
        $timeDiff = date_diff(new DateTime($initTime), new DateTime($endTime));

        return json_encode(['hours' => $timeDiff->h, 'minutes' => $timeDiff->i]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function processRemoveTimeRecordForm(Request $request)
    {
        if (empty($request->modal_id)) {
            $request->session()->flash('alert-danger', 'Error, bad request, try again...');
            return redirect('time-record');
        }

        $timeRecord = TimeRecord::find($request->modal_id);

        if (empty($timeRecord)) {
            $request->session()->flash('alert-danger', 'Error, time record not exists, try again...');
            return redirect('time-record');
        }

        if ($timeRecord->user_id !== Auth::user()->id) {
            $request->session()->flash('alert-danger', 'The time record does not belong to you, try again...');
            return redirect('time-record');
        }

        $timeRecord->delete();

        $request->session()->flash('alert-success', 'Time record deleted successfully!');
        return redirect('time-record');
    }
}
