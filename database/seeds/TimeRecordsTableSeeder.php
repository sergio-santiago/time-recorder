<?php

use App\TimeRecord;
use Illuminate\Database\Seeder;

class TimeRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTimeRecord(1, new DateTime('-3 hours'), new DateTime('-2 hours'));
        $this->createTimeRecord(1, new DateTime('-1 hours'), new DateTime('+2 hours'));
        $this->createTimeRecord(1, new DateTime('+3 hours'), new DateTime('+5 hours'));
    }

    private function createTimeRecord($userId, $initTime, $endTime)
    {
        $timeDiff = date_diff($initTime, $endTime);
        TimeRecord::create([
            'init_time' => $initTime,
            'end_time' => $endTime,
            'interval_time' => json_encode(['hours' => $timeDiff->h, 'minutes' => $timeDiff->i]),
            'user_id' => $userId,
        ]);
    }
}
