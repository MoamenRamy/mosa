<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier_order_item>
 */
class Supplier_order_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_order_id' => $this->faker->numberBetween(1, 3),
            'goods_id' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->numberBetween(1000, 3000),
            'count' => $this->faker->numberBetween(0, 3),
        ];
    }
}
