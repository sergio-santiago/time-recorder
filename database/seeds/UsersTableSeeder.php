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
        $this->createUser('Sergio Santiago', 'sergiosantiago@gmail.com', 1, true);
        $this->createUser('Carlos Hernandez', 'carloshernandez@gmail.com', 2, true);
        $this->createUser('Pedro Gonzalez', 'pedrogonzalez@gmail.com', 1, false);
        for ($i = 0; $i < 15; $i++) {
            $this->createUser('Zoe Millan', "zoemillan$i@gmail.com", 1, false);
        }
        $this->createUser('Silvia Henares', 'silviahenares@gmail.com', null, false);
    }

    /**
     * @param $name
     * @param $email
     * @param $companyId
     * @param $isAdmin
     */
    private function createUser($name, $email, $companyId, $isAdmin)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make('password'),
            'link_hash' => Str::random(15),
            'company_id' => $companyId,
            'is_admin' => $isAdmin
        ]);
    }
}
