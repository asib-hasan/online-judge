<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'type' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'type' => 'user',
        ]);

        \App\Models\Problem::create([
            'title' => 'A+B Problem',
            'description' => 'Calculate the sum of a and b.',
            'test_cases' => json_encode([
                ['input' => '1 2', 'output' => '3'],
                ['input' => '3 4', 'output' => '7'],
            ]),
        ]);
    }
}
