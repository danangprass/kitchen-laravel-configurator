<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected static array $faqs = [
        'Products' => [
            ['What types of commercial ovens does Kitchen offer?', 'Kitchen offers a complete range of commercial ovens including combi ovens, convection ovens, deck ovens, and specialized baking ovens suitable for bakeries, restaurants, and catering businesses.'],
            ['What is a combi oven and how does it work?', 'A combi oven combines convection, steam, and combination cooking modes in a single unit. It allows chefs to roast, bake, steam, grill, and poach with precise temperature and humidity control for consistent results.'],
            ['Can I use Kitchen ovens for baking bread and pastries?', 'Yes, Kitchen deck and convection ovens are ideal for artisan bread, pastries, and cakes. The precise temperature control and even heat distribution ensure consistent baking results batch after batch.'],
            ['What capacity options are available for Kitchen ovens?', 'Kitchen ovens are available in various capacities from compact 5-tray countertop models to full-size 20-tray floor models. Use our configurator to find the right size for your kitchen volume.'],
        ],
        'Ordering' => [
            ['How do I place an order for a Kitchen oven?', 'You can configure and order your oven through our online configurator, contact our sales team at info@kitchen.com, or reach out to an authorized Kitchen dealer in your region.'],
            ['What is the typical lead time for oven delivery?', 'Standard lead time is 4 to 6 weeks for most models. Custom configurations or special finishes may require 8 to 10 weeks. Your sales representative will confirm the exact timeline upon order confirmation.'],
            ['Do you offer financing or installment payment options?', 'Yes, Kitchen partners with select financing providers to offer flexible payment plans for qualifying commercial customers. Contact our sales team to discuss available financing options for your purchase.'],
            ['Can I modify or cancel an existing order?', 'Order modifications are possible within 48 hours of placement. After that, changes depend on production status. Contact your sales representative immediately if you need to modify or cancel your order.'],
        ],
        'Shipping' => [
            ['Where does Kitchen ship to?', 'Kitchen ships to all major cities across Indonesia and select international destinations in Southeast Asia. For international orders, please contact our export team for shipping rates and customs information.'],
            ['How much does shipping cost?', 'Shipping costs vary based on the oven model, delivery location, and installation requirements. A shipping quote is provided with your order confirmation. Freight is included for orders above certain thresholds within Indonesia.'],
            ['Do you provide installation and setup services?', 'Yes, Kitchen provides professional installation and setup by certified technicians. Installation includes uncrating, positioning, electrical and water connections, calibration, and staff orientation on basic operation.'],
            ['What happens if my oven arrives damaged?', 'Inspect all shipments upon delivery. If you notice any damage, note it on the delivery receipt and contact Kitchen support within 48 hours. We will arrange a replacement or repair at no additional cost.'],
        ],
        'Warranty' => [
            ['What warranty coverage comes with Kitchen ovens?', 'All Kitchen ovens come with a 2-year comprehensive warranty covering parts and labor. Extended warranty plans of up to 5 years are available for purchase within 30 days of delivery.'],
            ['What does the warranty NOT cover?', 'The warranty does not cover damage from improper installation, misuse, unauthorized modifications, failure to perform routine maintenance, or consumable parts such as gaskets, lamps, and filters.'],
            ['How do I file a warranty claim?', 'Contact Kitchen support at info@kitchen.com or call +62 81908852999 with your oven serial number and a description of the issue. Our support team will diagnose the problem and dispatch a technician if needed.'],
        ],
        'General' => [
            ['How do I clean and maintain my Kitchen oven?', 'Regular cleaning with non-abrasive cleaners and daily wiping of door gaskets extends oven life. Follow the maintenance schedule in your user manual for descaling, filter replacement, and periodic technician inspections.'],
            ['Where can I find spare parts and accessories?', 'Genuine Kitchen spare parts and accessories are available through our parts department. Contact support with your oven model and serial number. Commonly needed items are kept in stock for immediate dispatch.'],
            ['Do you offer staff training for operating Kitchen ovens?', 'Yes, Kitchen provides comprehensive staff training as part of installation. Additional training sessions, recipe consultation, and advanced technique workshops are available upon request.'],
            ['How energy efficient are Kitchen commercial ovens?', 'Kitchen ovens feature advanced insulation, efficient heating elements, and smart power management systems. Most models exceed ENERGY STAR standards for commercial cooking equipment, reducing operational costs.'],
        ],
    ];

    public function definition(): array
    {
        $category = fake()->randomElement(array_keys(static::$faqs));
        $qa = fake()->randomElement(static::$faqs[$category]);

        return [
            'question' => $qa[0],
            'answer' => $qa[1],
            'category' => $category,
            'sort_order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
