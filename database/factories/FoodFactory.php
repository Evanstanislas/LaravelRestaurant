<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'brief' => fake()->text(),
            'detail' => fake()->text(),
            'category' => fake()->randomElement(['Main Course', 'Beverages', 'Desserts']),
            'price' => fake()->randomNumber(),
            'picture' => $this->faker->image(storage_path('app/public/images'), 640,480, null, false),
        ];
    }
}
