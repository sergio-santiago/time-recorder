<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $this->createUser('default_user_admin', 1, true);
        $this->createUser('default_user_admin_alternative', 2, true);

        $this->createUser("default_user", 1, false);
        for ($i = 0; $i < 15; $i++) {
            $this->createUser("default_user_$i", 1, false);
        }

        $this->createUser('default_user_orphan', null, false);
    }

    /**
     * @param $name
     * @param $companyId
     * @param $isAdmin
     */
    private function createUser($name, $companyId, $isAdmin)
    {
        User::create([
            'name' => $name,
            'email' => "$name@gmail.com",
            'password' => Hash::make('password'),
            'link_hash' => Str::random(15),
            'company_id' => $companyId,
            'is_admin' => $isAdmin
        ]);
    }
}
