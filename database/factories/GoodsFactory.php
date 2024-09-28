<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goods>
 */
class GoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 3000),
            'category_id' => $this->faker->numberBetween(1, 3),
            'supplier_id' => $this->faker->numberBetween(1, 3),
            'count' => $this->faker->numberBetween(1, 30),
        ];
    }
}
