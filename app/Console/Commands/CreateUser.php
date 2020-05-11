<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for the admin';

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
        $first_name         = $this->ask("What is the user\'s       first name?");
        $last_name          = $this->ask("What is the user\'s       last name?");
        $email              = $this->ask("What is the user\'s       email ?");
        $twitter_username    = $this->ask("What is the user\'s   twitter username ?");

        $password = $this->secret("What is the user\'s   password ?");
        $passwordConfirm = $this->secret("Please Confirm  the user\'s   password ?");

        if ($password != $passwordConfirm) {
            return $this->error('Password do not match');
        }
        $this->table([
            'First Name',
            'Last Name',
            'Email',
            'Twitter Username'
        ],
            [
                [
                    $first_name,
                    $last_name,
                    $email,
                    $twitter_username
                ]
            ]);
        if ($this->confirm("Does everything look right ?")) {
            User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'twitter_username' => $twitter_username,
                'password' => Hash::make($password),
                'role' => User::ADMIN_ROLE,

            ]);

            return $this->info("User created");
        }
            return $this->info("User not created");
    }
}
