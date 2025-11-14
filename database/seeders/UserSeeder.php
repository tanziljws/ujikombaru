<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
            'nisn' => '1234567890',
        ]);

        User::create([
            'name' => 'Salwa Napila',
            'email' => 'salwa@smkn4.com',
            'password' => Hash::make('password123'),
            'nisn' => '0987654321',
        ]);
    }
}
