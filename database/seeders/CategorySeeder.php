<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Combi',
                'slug' => 'combi',
                'description' => 'Combination ovens offering versatile cooking modes',
                'sort_order' => 1,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Countertop',
                        'slug' => 'combi-countertop',
                        'description' => 'Compact countertop combi ovens for smaller kitchens',
                        'sort_order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Trolley',
                        'slug' => 'combi-trolley',
                        'description' => 'Mobile trolley-mounted combi ovens',
                        'sort_order' => 2,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Speed',
                'slug' => 'speed',
                'description' => 'High-speed cooking ovens for rapid service',
                'sort_order' => 2,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Combi',
                        'slug' => 'speed-combi',
                        'description' => 'Speed combi ovens for fast combination cooking',
                        'sort_order' => 1,
                        'is_active' => true,
                    ],
                    [
                        'name' => 'Baking',
                        'slug' => 'speed-baking',
                        'description' => 'Speed baking ovens for rapid pastry and bakery production',
                        'sort_order' => 2,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Convection with humidity',
                'slug' => 'convection-with-humidity',
                'description' => 'Convection ovens with humidity control for perfect baking',
                'sort_order' => 3,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Countertop',
                        'slug' => 'convection-with-humidity-countertop',
                        'description' => 'Countertop convection ovens with humidity control',
                        'sort_order' => 1,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Convention',
                'slug' => 'convention',
                'description' => 'Traditional convention ovens for standard cooking needs',
                'sort_order' => 4,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Countertop',
                        'slug' => 'convention-countertop',
                        'description' => 'Countertop convention ovens for compact spaces',
                        'sort_order' => 1,
                        'is_active' => true,
                    ],
                ],
            ],
            [
                'name' => 'Service temperature food preserver',
                'slug' => 'service-temperature-food-preserver',
                'description' => 'Food preservation units to maintain optimal serving temperatures',
                'sort_order' => 5,
                'is_active' => true,
                'children' => [
                    [
                        'name' => 'Countertop',
                        'slug' => 'service-temperature-food-preserver-countertop',
                        'description' => 'Countertop food preservation units',
                        'sort_order' => 1,
                        'is_active' => true,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $parent = Category::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                Category::create($childData);
            }
        }
    }
}
