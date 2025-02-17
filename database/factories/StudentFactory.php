<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'course' => $this->faker->randomElement(['BSIT', 'BSHRM', 'BSCS', 'BSBA']),
            'year_level' => $this->faker->randomElement(['1st Year', '2nd Year', '3rd Year', '4th Year']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address, 
        ];
    }
}
