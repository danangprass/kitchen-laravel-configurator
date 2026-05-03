<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'sku' => fake()->regexify('[A-Za-z0-9]{100}'),
            'description' => fake()->text(),
            'short_description' => fake()->text(),
            'accessory_type' => fake()->regexify('[A-Za-z0-9]{100}'),
            'width' => fake()->randomFloat(2, 0, 999999.99),
            'depth' => fake()->randomFloat(2, 0, 999999.99),
            'height' => fake()->randomFloat(2, 0, 999999.99),
            'weight' => fake()->randomFloat(2, 0, 999999.99),
            'voltage' => fake()->regexify('[A-Za-z0-9]{100}'),
            'electric_power' => fake()->randomFloat(2, 0, 999999.99),
            'min_flow' => fake()->randomFloat(2, 0, 99.99),
            'max_flow' => fake()->randomFloat(2, 0, 99.99),
            'quantity' => fake()->numberBetween(-10000, 10000),
            'price' => fake()->randomFloat(2, 0, 9999999999.99),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
