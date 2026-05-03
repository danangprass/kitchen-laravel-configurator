<?php

namespace Database\Factories;

use App\Models\Accessory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAccessoryFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'accessory_id' => Accessory::factory(),
            'quantity' => fake()->numberBetween(-10000, 10000),
            'is_default' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
