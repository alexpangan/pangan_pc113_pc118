<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SchoolActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'who' => $this->faker->name(),
            'what' => $this->faker->sentence(),
            'when' => $this->faker->dateTime(),
            'where' => $this->faker->address(),
            'why' => $this->faker->paragraph(),
            'organizer' => $this->faker->company(),
        ];
    }
}
