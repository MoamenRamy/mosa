<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoodsSupplier>
 */
class Goods_SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goods_id' => $this->faker->numberBetween(1, 3),
            'supplier_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
