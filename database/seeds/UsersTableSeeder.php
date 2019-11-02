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
            'name' => 'default_user_admin',
            'email' => 'default_user_admin@gmail.com',
            'password' => bcrypt('password'),
            'link_hash' => Str::random(10),
            'company_id' => 1,
            'is_admin' => true
        ]);
        DB::table('users')->insert([
            'name' => 'default_user',
            'email' => 'default_user@gmail.com',
            'password' => bcrypt('password'),
            'link_hash' => Str::random(10),
            'company_id' => 1,
            'is_admin' => false
        ]);
        DB::table('users')->insert([
            'name' => 'default_user_orphan',
            'email' => 'default_user_orphan@gmail.com',
            'password' => bcrypt('password'),
            'link_hash' => Str::random(10),
            'company_id' => null,
            'is_admin' => false
        ]);
    }
}
