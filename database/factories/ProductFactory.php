<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'sku' => fake()->regexify('[A-Za-z0-9]{100}'),
            'description' => fake()->text(),
            'short_description' => fake()->text(),
            'type' => fake()->regexify('[A-Za-z0-9]{100}'),
            'panel' => fake()->regexify('[A-Za-z0-9]{100}'),
            'power_supply' => fake()->regexify('[A-Za-z0-9]{100}'),
            'width' => fake()->randomFloat(2, 0, 999999.99),
            'depth' => fake()->randomFloat(2, 0, 999999.99),
            'height' => fake()->randomFloat(2, 0, 999999.99),
            'weight' => fake()->randomFloat(2, 0, 999999.99),
            'number_of_trays' => fake()->numberBetween(-10000, 10000),
            'tray_size' => fake()->regexify('[A-Za-z0-9]{50}'),
            'distance_between_trays' => fake()->numberBetween(-10000, 10000),
            'voltage' => fake()->regexify('[A-Za-z0-9]{100}'),
            'electric_power' => fake()->randomFloat(2, 0, 999999.99),
            'frequency' => fake()->regexify('[A-Za-z0-9]{50}'),
            'consumption_kwh' => fake()->randomFloat(2, 0, 999999.99),
            'co2_emission' => fake()->randomFloat(2, 0, 999999.99),
            'energy_star_certified' => fake()->boolean(),
            'price' => fake()->randomFloat(2, 0, 9999999999.99),
            'is_active' => fake()->boolean(),
            'sort_order' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
