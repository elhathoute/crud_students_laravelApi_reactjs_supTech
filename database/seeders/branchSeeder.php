<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Branch;

class branchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Create 20 students with fake data
        for ($i = 0; $i < 10; $i++) {
            Branch::create([
                'name' => $faker->name(),
                'description' => $faker->text(100),     
            ]);                        
                                    }
    }
}
