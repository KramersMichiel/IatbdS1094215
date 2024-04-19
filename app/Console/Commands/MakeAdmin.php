<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {UserEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a user admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user_email = $this->argument('UserEmail');

        $admin = Role::where('role', 'admin')->first();
        $user = User::where('email', $user_email)->first();
        $user->roles()->attach($admin->id);
        
        echo("User has been made admin\n");
    }
}
