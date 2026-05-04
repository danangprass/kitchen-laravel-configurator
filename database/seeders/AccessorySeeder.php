<?php

namespace Database\Seeders;

use App\Models\Accessory;
use Illuminate\Database\Seeder;

class AccessorySeeder extends Seeder
{
    public function run(): void
    {
        $accessories = [
            [
                'name' => 'OPTIC.Cooking + Ventless hood',
                'slug' => 'optic-cooking-ventless-hood',
                'sku' => 'XEDOA-11-R-XUC600-XEDHA-HC11',
                'description' => 'OPTIC.Cooking system with ventless hood for combi ovens.',
                'short_description' => 'OPTIC.Cooking + Ventless hood combination.',
                'width' => 750.0,
                'depth' => 870.0,
                'height' => 383.0,
                'weight' => 225.0,
                'voltage' => '220 V',
                'electric_power' => 0.1,
                'min_flow' => 0.12,
                'max_flow' => 0.21,
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Floor positioning stand',
                'slug' => 'floor-positioning-stand',
                'sku' => 'XEDRA-0011-F',
                'description' => 'Mandatory for oven positioning on the floor.',
                'short_description' => 'Floor stand for oven positioning.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'OPTIC.Cooking for lower unit',
                'slug' => 'optic-cooking-lower-unit',
                'sku' => 'XEDOA-11-R-QE',
                'description' => 'Includes all necessary parts for stacking two ovens, for drains connection and the OPTIC.Cooking kit for the bottom oven.',
                'short_description' => 'OPTIC.Cooking kit for double-stacked bottom oven.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'BLACK.FRY',
                'slug' => 'black-fry',
                'sku' => 'GRP816',
                'description' => 'Non-stick stainless steel frying tray.',
                'short_description' => 'Non-stick stainless steel frying tray.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'POTATO.FRY',
                'slug' => 'potato-fry',
                'sku' => 'GRP817',
                'description' => 'French fries frying tray.',
                'short_description' => 'French fries frying tray.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'CLEAN.FRY',
                'slug' => 'clean-fry',
                'sku' => 'GRP820',
                'description' => 'Non-stick perforated stainless-steel frying grid with fat-collection tray.',
                'short_description' => 'Frying grid with fat-collection tray.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'DET&Rinse ULTRAPLUS',
                'slug' => 'det-rinse-ultraplus',
                'sku' => 'DB1076A0',
                'description' => 'Ultra strong detergent for high level of dirt, recommended for poultry and meat fats. One box contains 10 x 1l bottles of chemical cleaner.',
                'short_description' => 'Ultra strong detergent for oven cleaning.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'D&CAL',
                'slug' => 'd-cal',
                'sku' => 'DB1085A0',
                'description' => 'Powerful descaler to be used to remove limestone incrustations in the cooking chamber. Each box includes ten 1-liter bottles of chemical anti-limescale.',
                'short_description' => 'Descaler for cooking chamber.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Two-stage safety door opening',
                'slug' => 'two-stage-safety-door',
                'sku' => 'XUC113',
                'description' => 'The first stage allows the steams to slowly exit from the cooking chamber, as protection from possible injuries due to the rapid exit of large amounts of steam.',
                'short_description' => 'Safety door with two-stage opening.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'HYPER.Smoker',
                'slug' => 'hyper-smoker',
                'sku' => 'XUC090',
                'description' => 'Natural wood chip smoker. An additional electric power supply is not required.',
                'short_description' => 'Natural wood chip smoker.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Tray holder trolley',
                'slug' => 'tray-holder-trolley',
                'sku' => 'XTB0002',
                'description' => 'Multi-functional support for storing and transporting the trays.',
                'short_description' => 'Tray storage and transport trolley.',
                'quantity' => 1,
                'price' => 0.0,
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'name' => 'RO.Care',
                'slug' => 'ro-care',
                'sku' => 'XHC040',
                'description' => 'Integrated water filtering system that eliminates substances that contribute to the formation of limescale. Up to 1300L of filtered water with a cartridge.',
                'short_description' => 'Water filtering system for ovens.',
                'quantity' => 2,
                'price' => 0.0,
                'sort_order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($accessories as $accessory) {
            Accessory::create($accessory);
        }
    }
}
