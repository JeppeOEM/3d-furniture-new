<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuration>
 */
class ConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition(): array
    {
        $uniqueId = uniqid('', true);
        $identifier = Str::limit($uniqueId, 10, '');
        return [
            'name' => fake()->sentence(),
            'configuration' => fake()->sentence(),
            'identifier' => $identifier,
        ];
    }
}
