<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->title(),
            'address' => $this->faker->address(),
            'stars' => $this->faker->numberBetween(0, 7),
            'sales' => $this->faker->numberBetween(50000, 100000),
            'debt' => $this->faker->numberBetween(0, 50000),
            'last_supply_date' => $this->faker->date(),
            'last_supply_count' => $this->faker->numberBetween(1, 50)
        ];
    }
}
