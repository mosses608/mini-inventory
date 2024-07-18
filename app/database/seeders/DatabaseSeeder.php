<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Member Computer Technology',
            'email' => 'mct@gmail.com',
            'username' => 'mct@123',
            'password' => '1234567890',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin@123',
            'password' => 'admin@098',
        ]);
    }
}
