<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Component>
 */
class ComponentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => fake()->sentence(),
            'category' => $this->faker->randomElement(['1_seater', 'chaise_left', 'chaise_right', 'corner_left', 'corner_right']),
        ];
    }
}
