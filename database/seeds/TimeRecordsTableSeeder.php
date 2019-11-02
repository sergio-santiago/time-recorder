<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_records')->insert([
            'init_time' => (new DateTime('-3 hours'))->format('m-d-y H:i:s'),
            'end_time' => (new DateTime())->format('m-d-y H:i:s'),
            'user_id' => 1,
        ]);
    }
}
