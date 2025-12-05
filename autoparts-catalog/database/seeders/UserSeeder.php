<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Адміністратор
        User::create([
            'name' => 'Адміністратор',
            'email' => 'utyb27544@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Звичайні користувачі
        User::create([
            'name' => 'Іван Петренко',
            'email' => 'user1@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Марія Коваленко',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}