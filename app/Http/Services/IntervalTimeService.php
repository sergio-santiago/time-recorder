<?php

namespace App\Http\Services;

use DateTime;
use Exception;
use stdClass;

class IntervalTimeService
{
    public function decodeIntervalTimeField(&$timeRecords)
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
     * @param $collection
     * @param $accessToIntervalTime
     * @return stdClass
     */
    public function calculateSumIntervalTimes($collection, $accessToIntervalTime)
    {
        $total = new stdClass();
        $total->hours = 0;
        $total->minutes = 0;

        foreach ($collection as $item) {
            $intervalTime = $accessToIntervalTime($item);
            $total->hours += $intervalTime->hours;
            $total->minutes += $intervalTime->minutes;
            while ($total->minutes >= 60) {
                $total->hours++;
                $total->minutes = $total->minutes - 60;
            }
        }

        return $total;
    }

    /**
     * @param DateTime $initTime
     * @param DateTime $endTime
     * @return string
     * @throws Exception
     */
    public function calculateEncodedTimeRecordIntervalTime($initTime, $endTime)
    {
        $timeDiff = date_diff($initTime, $endTime);
        $intervalTime = new stdClass();
        $intervalTime->hours = $timeDiff->h;
        $intervalTime->minutes = $timeDiff->i;

        return json_encode($intervalTime);
    }
}
