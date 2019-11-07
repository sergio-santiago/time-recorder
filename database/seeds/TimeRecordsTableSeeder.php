<?php

use App\Http\Services\IntervalTimeService;
use App\TimeRecord;
use Illuminate\Database\Seeder;

class TimeRecordsTableSeeder extends Seeder
{
    /* @var IntervalTimeService */
    private $intervalTimeService;

    public function __construct(IntervalTimeService $intervalTimeService)
    {
        $this->intervalTimeService = $intervalTimeService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->createTimeRecord(1, new DateTime('-3 hours'), new DateTime('-2 hours'));
        $this->createTimeRecord(1, new DateTime('-1 hours'), new DateTime('+2 hours'));
        $this->createTimeRecord(1, new DateTime('+3 hours'), new DateTime('+5 hours'));
    }

    /**
     * @param $userId
     * @param $initTime
     * @param $endTime
     * @throws Exception
     */
    private function createTimeRecord($userId, $initTime, $endTime)
    {
        TimeRecord::create([
            'init_time' => $initTime,
            'end_time' => $endTime,
            'interval_time' => $this->intervalTimeService->calculateEncodedTimeRecordIntervalTime($initTime, $endTime),
            'user_id' => $userId,
        ]);
    }
}
