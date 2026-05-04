<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $countertopCategoryId = 2;

        Product::create([
            'category_id' => $countertopCategoryId,
            'name' => 'CHEFTOP-X™ Digital.ID™ 10 Trays',
            'slug' => 'cheftop-x-digital-id-10-trays',
            'sku' => 'XEDA-1011-EXRS-ET',
            'description' => 'Professional high-performance combi oven equipped with a state-of-the-art operating system and intelligent technology designed to perfectly handle any gastronomy, pastry and bakery cooking process.',
            'short_description' => '10 trays GN 1/1 countertop combi oven with 16" touch panel.',
            'type' => 'Commercial countertop combi ovens',
            'panel' => '16" Touch control panel',
            'power_supply' => 'Electric',
            'width' => 750.0,
            'depth' => 841.0,
            'height' => 1069.0,
            'weight' => 132.0,
            'number_of_trays' => 10,
            'tray_size' => 'GN 1/1',
            'distance_between_trays' => 67,
            'voltage' => '380-415V 3N~ / 220-240V 3~',
            'electric_power' => 19.6,
            'frequency' => '50 / 60 Hz',
            'consumption_kwh' => 38.8,
            'co2_emission' => 0.0,
            'price' => 0.0,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Product::create([
            'category_id' => $countertopCategoryId,
            'name' => 'CHEFTOP-X™ Digital.ID™ 6 Trays',
            'slug' => 'cheftop-x-digital-id-6-trays',
            'sku' => 'XEDA-0611-EXRS-ET',
            'description' => 'Professional high-performance combi oven equipped with a state-of-the-art operating system and intelligent technology designed to perfectly handle any gastronomy, pastry and bakery cooking process.',
            'short_description' => '6 trays GN 1/1 countertop combi oven with 16" touch panel.',
            'type' => 'Commercial countertop combi ovens',
            'panel' => '16" Touch control panel',
            'power_supply' => 'Electric',
            'width' => 750.0,
            'depth' => 841.0,
            'height' => 789.0,
            'weight' => 114.0,
            'number_of_trays' => 6,
            'tray_size' => 'GN 1/1',
            'distance_between_trays' => 67,
            'voltage' => '380-415V 3N~ / 220-240V 3~ / 220-240V 1~',
            'electric_power' => 11.6,
            'frequency' => '50 / 60 Hz',
            'consumption_kwh' => 27.4,
            'co2_emission' => 0.0,
            'price' => 0.0,
            'is_active' => true,
            'sort_order' => 2,
        ]);
    }
}
