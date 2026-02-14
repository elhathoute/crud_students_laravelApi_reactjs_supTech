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
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => 'password']
        );

        User::updateOrCreate(
            ['email' => 'super_admin@example.com'],
            ['name' => 'super_admin', 'password' => 'azerty']
        );
        
        // Seed branches
        $this->call(branchSeeder::class);
        
        // Seed students
        $this->call(StudentSeeder::class);
    }
}
