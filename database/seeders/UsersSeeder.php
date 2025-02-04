<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(['name' => 'Test User', 'email' => 'testuser@develop.com', 'email_verified_at' => now(), 'password' => Hash::make('testuser'), 'created_at' => now(), 'updated_at' => now()]);

    }
}
