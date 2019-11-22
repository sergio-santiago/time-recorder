<?php

namespace App\Console\Commands;

use App\Company;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class RegisterCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new company';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Pedir el nombre de la empresa para crearla despues
        $companyName = null;
        $this->info('We will create a new company!');
        while (!$companyName) {
            $companyName = $this->ask('What is the name you want to put to the company?');
            $validator = Validator::make(
                [
                    'name' => $companyName
                ],
                [
                    'name' => ['required', 'string', 'unique:companies'],
                ],
                [
                    'name' => 'The company name already used test with another',
                ]
            );
            if ($validator->fails()) {
                $companyName = null;
                $error = $validator->errors()->first();
                $this->info($error);
            }
        }

        //Pedir el admin de la empresa introduciendo su email para asignarlo a la empresa y ponerle admin
        $user = null;
        $this->info('The new company must have at least a member user');
        $this->info('The user you choose will be assigned to the new company as an administrator');
        $this->info('He can invite new users');
        $this->info('If the user have an assigned company, will no longer be a member of it to be a new one');
        while (!$user) {
            $userEmail = $this->ask('What is the email of the already created user that you want to choose?');
            $user = User::where('email', $userEmail)->first();
            if ($user === null) {
                $this->info("There is no user with the email $userEmail");
            }
        }

        //Crear compañia
        $company = Company::create([
            'name' => $companyName,
        ]);

        //Poner user como admin de la nueva company
        $user->is_admin = true;
        $user->company_id = $company->id;
        $user->save();

        $this->info("The user with email $userEmail has been assigned to the new company $companyName as admin, thanks");
    }
}
