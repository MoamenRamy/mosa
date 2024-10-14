<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order_item>
 */
class Order_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->numberBetween(1, 4000),
            'goods_id' => $this->faker->numberBetween(1, 100),
            'count' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->numberBetween(1000, 3000),
        ];
    }
}
