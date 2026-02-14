<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Create 20 students with fake data
        for ($i = 0; $i < 10; $i++) {
            Student::create([
                'name' => $faker->name(),
                'gender' => $faker->randomElement(['m', 'f']),
                'address' => $faker->address(),
                'birthDate' => $faker->date('Y-m-d', '2005-01-01'), // Students born between 2005 and now
                'idBranch' => $faker->numberBetween(1, 10),
                'bacGrade' => $faker->randomFloat(2, 10, 20), // Grade between 10 and 20
            ]);
                                 }
    }
}
