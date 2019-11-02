<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin_' . Str::random(10),
            'email' => 'admin_' . Str::random(10) . '@gmail.com',
            'password' => bcrypt('password'),
            'link_hash' => Str::random(10),
            'company_id' => null,
            'is_admin' => true
        ]);
        DB::table('users')->insert([
            'name' => 'user_' . Str::random(10),
            'email' => 'user_' . Str::random(10) . '@gmail.com',
            'password' => bcrypt('password'),
            'link_hash' => Str::random(10),
            'company_id' => null,
            'is_admin' => false
        ]);
    }
}
