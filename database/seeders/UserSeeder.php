<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed akun default: admin dan member.
     */
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Administrator',
                'email'             => 'admin@example.com',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Akun Member
        User::firstOrCreate(
            ['email' => 'member@example.com'],
            [
                'name'              => 'Member User',
                'email'             => 'member@example.com',
                'password'          => Hash::make('password'),
                'role'              => 'member',
                'email_verified_at' => now(),
            ]
        );
    }
}
