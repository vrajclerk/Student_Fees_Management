<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'roll_no' => $this->faker->unique()->randomNumber(5),
            'name' => $this->faker->name(),
            'total_fees' => $this->faker->randomFloat(2, 1000, 5000),
            'fees_paid' => $this->faker->randomFloat(2, 0, 1000),
            'date' => $this->faker->date(),
        ];
    }
    public function run(): void
{
    Student::factory()
            ->count(50)
            ->create();
}
}
