<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();

        User::firstOrCreate([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',

        ], [
            'password' => Hash::make('password')
        ]);
    }
}
