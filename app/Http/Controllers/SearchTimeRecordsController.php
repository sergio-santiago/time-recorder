<?php

namespace App\Http\Controllers;

use App\Http\Services\IntervalTimeService;
use App\TimeRecord;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SearchTimeRecordsController extends Controller
{
    /* @var IntervalTimeService */
    private $intervalTimeService;

    /**
     * Create a new controller instance.
     *
     * @param IntervalTimeService $intervalTimeService
     */
    public function __construct(IntervalTimeService $intervalTimeService)
    {
        $this->middleware('auth');
        $this->intervalTimeService = $intervalTimeService;
    }

    /**
     * @return Factory|View
     */
    public function renderSearchTimeRecordsForm()
    {
        return view('search_time_records.search_time_records', [
            'timeRecords' => [],
            'teamMembers' => User::where('company_id', Auth::user()['company_id'])->get(),
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function processSearchTimeRecordsForm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'init_date' => ['required', 'string', 'date_format:Y-m-d', 'before_or_equal:end_date'],
                'end_date' => ['required', 'string', 'date_format:Y-m-d', 'after_or_equal:init_date'],
                'user_ids' => ['array'],
            ]
        );

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Validation error, please try again...');
            return redirect('render-search-time-records-form');
        }

        if (!empty($request->user_ids)) {
            $timeRecords = TimeRecord::where([
                ['init_time', '>=', Carbon::create($request->init_date)->startOfDay()],
                ['end_time', '<=', Carbon::create($request->end_date)->endOfDay()]
            ])->whereIn('user_id', $request->user_ids)->get();
        } else {
            $timeRecords = TimeRecord::where([
                ['init_time', '>=', Carbon::create($request->init_date)->startOfDay()],
                ['end_time', '<=', Carbon::create($request->end_date)->endOfDay()]
            ])->get();
        }
        $this->intervalTimeService->decodeIntervalTimeField($timeRecords);
        $this->addUserNamesToTimeRecords($timeRecords);

        return view('search_time_records.search_time_records', [
            'timeRecords' => $timeRecords,
            'teamMembers' => User::where('company_id', Auth::user()['company_id'])->get(),
        ]);
    }

    /**
     * @param $timeRecords
     */
    private function addUserNamesToTimeRecords(&$timeRecords)
    {
        foreach ($timeRecords as $record) {
            $user = User::find($record->user_id);
            $record->userName = $user->name;
        }
        return;
    }
}
