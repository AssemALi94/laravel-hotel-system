<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use mysql_xdevapi\Exception;

class create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'create:admin {--email} {--password}';
    protected $signature = 'create:admin {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin';

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
     * @return int
     */
    public function handle()
    {
        try {
            User::create([
                'email'    => $this->argument('email'),
                'password'    => $this->argument('password'),
                'role'    => 'admin',
            ]);
            $this->info('Created Successfully');
        } catch (\Throwable $exception){
            $this->info('Error while creating an admin');
        }
        return 0;
    }
}
/*
Artisan::command('create:admin {--email} {--password}', function ($email,$password) {


//    $this->comment($type,$email,$password);
//    $this->comment(User::create([
//        'email'    => $email,
//        'password'    => $password,
//    ]));
})->purpose('Display an inspiring quote');*/
