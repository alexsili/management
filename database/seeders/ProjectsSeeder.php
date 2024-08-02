<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert(
            [
                ['name' => 'Project 1', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Project 2', 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Project 3', 'created_at' => now(), 'updated_at' => now()],
            ]);

    }
}
