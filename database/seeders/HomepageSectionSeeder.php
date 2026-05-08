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
                'title' => 'Mastering Every Bake',
                'subtitle' => 'Commercial kitchen equipment that blends artisan tradition with smart technology, delivering consistent results every single time.',
                'content' => [
                    'eyebrow' => 'Professional Kitchen Solutions',
                    'secondary_cta_text' => 'Calculate ROI',
                    'secondary_cta_url' => '/calculator',
                    'trust_indicators' => [
                        'ISO 9001 Certified',
                        '10+ Years of Engineering',
                        '24/7 Technical Support',
                    ],
                ],
                'background_type' => 'none',
                'cta_text' => 'Build Your Configuration',
                'cta_url' => '/configurator',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'type' => 'line-showcase',
                'title' => 'The most powerful combi oven ever.',
                'subtitle' => 'CHEFTOP-X combines intelligent cooking technology with unmatched energy efficiency. From automated wash cycles to AI-driven recipe management — perfect results, every single time.',
                'line_family' => 'CHEFTOP-X',
                'content' => [
                    'eyebrow' => 'CHEFTOP-X Series',
                ],
                'cta_text' => 'Discover CHEFTOP-X',
                'cta_url' => '/configurator',
                'sort_order' => 20,
                'is_active' => true,
            ],
            [
                'type' => 'product-slider',
                'title' => 'Pillars of Your Professional Kitchen',
                'subtitle' => 'Every piece of equipment is purpose-built for the demanding standards of modern bakery and pastry operations.',
                'content' => ['max_items' => 8, 'show_energy_badges' => true],
                'cta_text' => 'View All Products',
                'cta_url' => '/configurator',
                'sort_order' => 30,
                'is_active' => true,
            ],
            [
                'type' => 'cta-banner',
                'title' => 'Ready to Build Your Kitchen?',
                'subtitle' => 'Use our interactive configurator to design the perfect layout, compare equipment, and get an instant estimate — all in one place.',
                'content' => [
                    'style' => 'light',
                    'eyebrow' => 'Get Started Today',
                ],
                'cta_text' => 'Launch Configurator',
                'cta_url' => '/configurator',
                'sort_order' => 40,
                'is_active' => true,
            ],
            [
                'type' => 'value-props',
                'title' => 'Much more than just commercial ovens.',
                'subtitle' => 'Every oven is a long-term investment for your business — engineered for precision, built for consistency.',
                'content' => [
                    'eyebrow' => 'Why Choose Us',
                    'items' => [
                        [
                            'icon' => 'chip',
                            'title' => 'Intelligent Cooking',
                            'description' => 'AI-driven programs automatically adjust time, temperature, and humidity for flawless results across every bake.',
                        ],
                        [
                            'icon' => 'leaf',
                            'title' => 'Energy Efficiency',
                            'description' => 'Industry-leading low energy consumption reduces operational costs by up to 30% versus conventional ovens.',
                        ],
                        [
                            'icon' => 'shield',
                            'title' => 'Built to Last',
                            'description' => 'Premium-grade stainless steel and rigorous factory testing ensure reliable performance for decades.',
                        ],
                        [
                            'icon' => 'globe',
                            'title' => 'Global Support',
                            'description' => 'Worldwide network of certified dealers and service centers ready to support your business 24/7.',
                        ],
                        [
                            'icon' => 'lightning',
                            'title' => 'Speed & Power',
                            'description' => 'From rapid speed ovens to high-capacity combi ovens — match the right power to your kitchen volume.',
                        ],
                        [
                            'icon' => 'chart',
                            'title' => 'Data Driven',
                            'description' => 'Connect your ovens for real-time analytics, HACCP monitoring, and remote kitchen management.',
                        ],
                    ],
                ],
                'sort_order' => 50,
                'is_active' => true,
            ],
            [
                'type' => 'newsletter',
                'title' => 'Achieve Consistency in Every Bake',
                'subtitle' => 'Get technical guides, kitchen optimization tips, and the latest equipment updates delivered straight to your inbox.',
                'content' => [
                    'eyebrow' => 'Stay Updated',
                ],
                'cta_text' => 'Subscribe',
                'sort_order' => 60,
                'is_active' => true,
            ],
            [
                'type' => 'seo-text',
                'title' => 'UNOX Commercial Ovens',
                'content' => [
                    'body' => '<p>UNOX is a leading manufacturer of <strong>professional commercial ovens</strong> for the food service, bakery, and pastry industries. Our product range includes <strong>combi ovens</strong>, <strong>speed ovens</strong>, <strong>convection ovens</strong>, and specialized baking solutions. With intelligent cooking technology, energy-efficient design, and global support, UNOX ovens help chefs achieve consistent, high-quality results every day.</p><p>Whether you run a restaurant, bakery, hotel, or catering operation, UNOX has the right oven for your kitchen. Every oven is engineered as a long-term investment — explore our configurator to build your perfect setup.</p>',
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
