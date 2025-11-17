<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    /**
     * The command signature:
     * example: php artisan make:admin email password --name="John Doe"
     */
    protected $signature = 'make:admin {email} {password} {--name=Admin}';

    protected $description = 'Create a new admin user';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $name = $this->option('name');

        // Prevent duplicates
        if (User::where('email', $email)->exists()) {
            $this->error("A user with email {$email} already exists.");
            return Command::FAILURE;
        }

        // Create admin
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
            'role'     => 'admin', // IMPORTANT
        ]);

        $this->info("Admin created successfully!");
        $this->line("ID: {$user->id}");
        $this->line("Email: {$user->email}");

        return Command::SUCCESS;
    }
}
