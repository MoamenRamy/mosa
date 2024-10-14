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
            'supplier_order_id' => $this->faker->numberBetween(1, 20),
            'goods_id' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->numberBetween(100000, 300000),
            'count' => $this->faker->numberBetween(1, 200),
        ];
    }
}
