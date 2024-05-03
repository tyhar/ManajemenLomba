<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lomba>
 */
class LombaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'eventlomba_id' =>
            // 'name' => $this->faker->name,
            'description' => $this->faker->text(80),
            'kontak' => $this->faker->phoneNumber(9),
            'pj' => $this->faker->name(),
            'tempat' => $this->faker->city(),
            // 'picture' => $this->faker->file(),
            // 'link_file' => $this->faker->url(),
        ];
    }
}
