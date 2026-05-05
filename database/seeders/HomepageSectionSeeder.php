<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'type' => 'hero',
                'title' => 'Commercial ovens to build your success.',
                'subtitle' => 'Discover the full range of UNOX professional ovens — from combi to speed, convection to baking. Built for chefs who demand perfection.',
                'background_type' => 'none',
                'cta_text' => 'Build your own',
                'cta_url' => '/configurator',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'type' => 'line_showcase',
                'title' => 'The most powerful combi oven ever.',
                'subtitle' => 'CHEFTOP-X combines intelligent cooking technology with unmatched energy efficiency. Perfect results, every time.',
                'line_family' => 'CHEFTOP-X',
                'cta_text' => 'Discover CHEFTOP-X',
                'cta_url' => '/configurator',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'type' => 'product_slider',
                'title' => 'Featured Products',
                'subtitle' => 'Explore our most popular commercial oven solutions',
                'content' => ['max_items' => 8, 'show_energy_badges' => true],
                'cta_text' => 'View all products',
                'cta_url' => '/configurator',
                'sort_order' => 30,
                'is_active' => true,
            ],
            [
                'type' => 'cta_banner',
                'title' => 'Try the oven for free!',
                'subtitle' => 'Book an Individual Cooking Experience and test a UNOX oven at your venue with our expert chefs.',
                'content' => ['style' => 'dark'],
                'cta_text' => 'Book your trial',
                'cta_url' => '/configurator',
                'sort_order' => 40,
                'is_active' => true,
            ],
            [
                'type' => 'value_props',
                'title' => 'Much more than just commercial ovens.',
                'subtitle' => 'Every UNOX oven is packed with intelligent technology to transform your kitchen.',
                'content' => [
                    'items' => [
                        [
                            'icon' => 'chip',
                            'title' => 'Intelligent Cooking',
                            'description' => 'AI-driven cooking programs automatically adjust time, temperature, and humidity for consistent results.',
                        ],
                        [
                            'icon' => 'leaf',
                            'title' => 'Energy Efficiency',
                            'description' => 'Industry-leading low energy consumption reduces operational costs and environmental impact.',
                        ],
                        [
                            'icon' => 'shield',
                            'title' => 'Built to Last',
                            'description' => 'Premium materials and rigorous testing ensure reliable performance for years to come.',
                        ],
                        [
                            'icon' => 'globe',
                            'title' => 'Global Support',
                            'description' => 'Worldwide network of dealers and service centers ready to support your business.',
                        ],
                        [
                            'icon' => 'lightning',
                            'title' => 'Speed & Power',
                            'description' => 'From speed ovens to high-capacity combi ovens, match the right power to your kitchen volume.',
                        ],
                        [
                            'icon' => 'chart',
                            'title' => 'Data Driven',
                            'description' => 'Connect your ovens to Data Driven Cooking for analytics, HACCP monitoring, and remote management.',
                        ],
                    ],
                ],
                'sort_order' => 50,
                'is_active' => true,
            ],
            [
                'type' => 'newsletter',
                'title' => 'Stay in the know',
                'subtitle' => 'Get the latest product updates, recipes, and industry insights delivered to your inbox.',
                'cta_text' => 'Subscribe',
                'sort_order' => 60,
                'is_active' => true,
            ],
            [
                'type' => 'seo_text',
                'title' => 'UNOX Commercial Ovens',
                'content' => [
                    'body' => '<p>UNOX is a leading manufacturer of professional commercial ovens for the food service, bakery, and pastry industries. Our product range includes <strong>combi ovens</strong>, <strong>speed ovens</strong>, <strong>convection ovens</strong>, and specialized baking solutions. With intelligent cooking technology, energy-efficient design, and global support, UNOX ovens help chefs achieve consistent, high-quality results every day.</p><p>Whether you run a restaurant, bakery, hotel, or catering operation, UNOX has the right oven for your kitchen. Explore our configurator to build your perfect setup.</p>',
                ],
                'sort_order' => 70,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            HomepageSection::firstOrCreate(
                ['type' => $section['type'], 'sort_order' => $section['sort_order']],
                $section,
            );
        }
    }
}
