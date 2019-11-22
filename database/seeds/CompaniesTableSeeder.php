<?php

use App\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCompany('Desarroyo web SL');
        $this->createCompany('Componentes informaticos SL ');
    }

    /**
     * @param $name
     */
    private function createCompany($name)
    {
        Company::create([
            'name' => $name,
        ]);
    }

}
