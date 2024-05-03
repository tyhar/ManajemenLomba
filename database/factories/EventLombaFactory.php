<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventLomba>
 */
class EventLombaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->name(),
            // 'logo' => $this->faker->text(),
            'description' => $this->faker->text(100),
            'year' => $this->faker->year(now()),
            // 'file_report' => $this->faker->city(),
        ];
    }
}
