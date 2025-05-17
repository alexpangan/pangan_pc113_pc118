<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
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
            'what' => $this->faker->text(50),
            'when' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'where' => $this->faker->address(),
            'why' => $this->faker->text(100),
            'organizer' => $this->faker->company(),
        ];
    }
}
