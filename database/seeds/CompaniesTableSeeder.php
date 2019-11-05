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
        $this->createCompany('default_company');
    }

    private function createCompany($name)
    {
        Company::create([
            'name' => $name,
        ]);
    }

}
