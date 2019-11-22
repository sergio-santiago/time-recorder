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
        for ($i = 0; $i < 100; $i++) {
            $this->createTimeRecord(1, new DateTime('-3 hours'), new DateTime('-2 hours'));
            $this->createTimeRecord(2, new DateTime('-1 hours'), new DateTime('+2 hours'));
            $this->createTimeRecord(4, new DateTime('+3 hours'), new DateTime('+5 hours'));

            $this->createTimeRecord(2, new DateTime('-3 hours'), new DateTime('-2 hours'));
            $this->createTimeRecord(5, new DateTime('-1 hours'), new DateTime('+2 hours'));
            $this->createTimeRecord(1, new DateTime('+3 hours'), new DateTime('+5 hours'));

            $this->createTimeRecord(6, new DateTime('-3 hours'), new DateTime('-2 hours'));
            $this->createTimeRecord(2, new DateTime('-1 hours'), new DateTime('+2 hours'));
            $this->createTimeRecord(1, new DateTime('+3 hours'), new DateTime('+5 hours'));
        }
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
            'commentary' => "Some commentary about this time record"
        ]);
    }
}
