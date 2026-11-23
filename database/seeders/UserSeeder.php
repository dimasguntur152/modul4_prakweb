<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 3 user dummy
        User::create([
            'name' => 'Dimas',
            'email' => 'dimas@flip.com',
            'password' => Hash::make('password123'), // Password wajib di-hash
        ]);

        User::create([
            'name' => 'Shafa',
            'email' => 'shafa@flip.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Sasti',
            'email' => 'sasti@flip.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
