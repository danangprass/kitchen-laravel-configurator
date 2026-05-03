<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'image_path' => fake()->regexify('[A-Za-z0-9]{255}'),
            'alt_text' => fake()->regexify('[A-Za-z0-9]{255}'),
            'sort_order' => fake()->numberBetween(-10000, 10000),
            'is_primary' => fake()->boolean(),
        ];
    }
}
