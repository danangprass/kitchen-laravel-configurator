<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Products (sort 10–40)
            ['Products', 10, 'What types of commercial ovens does Bakomatic offer?', 'Bakomatic offers a complete range of commercial ovens including combi ovens, convection ovens, deck ovens, and specialized baking ovens suitable for bakeries, restaurants, and catering businesses.'],
            ['Products', 20, 'What is a combi oven and how does it work?', 'A combi oven combines convection, steam, and combination cooking modes in a single unit. It allows chefs to roast, bake, steam, grill, and poach with precise temperature and humidity control for consistent results.'],
            ['Products', 30, 'Can I use Bakomatic ovens for baking bread and pastries?', 'Yes, Bakomatic deck and convection ovens are ideal for artisan bread, pastries, and cakes. The precise temperature control and even heat distribution ensure consistent baking results batch after batch.'],
            ['Products', 40, 'What capacity options are available for Bakomatic ovens?', 'Bakomatic ovens are available in various capacities from compact 5-tray countertop models to full-size 20-tray floor models. Use our configurator to find the right size for your bakomatic volume.'],

            // Ordering (sort 10–40)
            ['Ordering', 10, 'How do I place an order for a Bakomatic oven?', 'You can configure and order your oven through our online configurator, contact our sales team via our contact page, or reach out to an authorized Bakomatic dealer in your region.'],
            ['Ordering', 20, 'What is the typical lead time for oven delivery?', 'Standard lead time is 4 to 6 weeks for most models. Custom configurations or special finishes may require 8 to 10 weeks. Your sales representative will confirm the exact timeline upon order confirmation.'],
            ['Ordering', 30, 'Do you offer financing or installment payment options?', 'Yes, Bakomatic partners with select financing providers to offer flexible payment plans for qualifying commercial customers. Contact our sales team to discuss available financing options for your purchase.'],
            ['Ordering', 40, 'Can I modify or cancel an existing order?', 'Order modifications are possible within 48 hours of placement. After that, changes depend on production status. Contact your sales representative immediately if you need to modify or cancel your order.'],

            // Shipping (sort 10–40)
            ['Shipping', 10, 'Where does Bakomatic ship to?', 'Bakomatic ships to all major cities across Indonesia and select international destinations in Southeast Asia. For international orders, please contact our export team for shipping rates and customs information.'],
            ['Shipping', 20, 'How much does shipping cost?', 'Shipping costs vary based on the oven model, delivery location, and installation requirements. A shipping quote is provided with your order confirmation. Freight is included for orders above certain thresholds within Indonesia.'],
            ['Shipping', 30, 'Do you provide installation and setup services?', 'Yes, Bakomatic provides professional installation and setup by certified technicians. Installation includes uncrating, positioning, electrical and water connections, calibration, and staff orientation on basic operation.'],
            ['Shipping', 40, 'What happens if my oven arrives damaged?', 'Inspect all shipments upon delivery. If you notice any damage, note it on the delivery receipt and contact Bakomatic support within 48 hours. We will arrange a replacement or repair at no additional cost.'],

            // Warranty (sort 10–30)
            ['Warranty', 10, 'What warranty coverage comes with Bakomatic ovens?', 'All Bakomatic ovens come with a 2-year comprehensive warranty covering parts and labor. Extended warranty plans of up to 5 years are available for purchase within 30 days of delivery.'],
            ['Warranty', 20, 'What does the warranty NOT cover?', 'The warranty does not cover damage from improper installation, misuse, unauthorized modifications, failure to perform routine maintenance, or consumable parts such as gaskets, lamps, and filters.'],
            ['Warranty', 30, 'How do I file a warranty claim?', 'Contact Bakomatic support via email or our contact form with your oven serial number and a description of the issue. Our support team will diagnose the problem and dispatch a technician if needed.'],

            // General (sort 10–40)
            ['General', 10, 'How do I clean and maintain my Bakomatic oven?', 'Regular cleaning with non-abrasive cleaners and daily wiping of door gaskets extends oven life. Follow the maintenance schedule in your user manual for descaling, filter replacement, and periodic technician inspections.'],
            ['General', 20, 'Where can I find spare parts and accessories?', 'Genuine Bakomatic spare parts and accessories are available through our parts department. Contact support with your oven model and serial number. Commonly needed items are kept in stock for immediate dispatch.'],
            ['General', 30, 'Do you offer staff training for operating Bakomatic ovens?', 'Yes, Bakomatic provides comprehensive staff training as part of installation. Additional training sessions, recipe consultation, and advanced technique workshops are available upon request.'],
            ['General', 40, 'How energy efficient are Bakomatic commercial ovens?', 'Bakomatic ovens feature advanced insulation, efficient heating elements, and smart power management systems. Most models exceed ENERGY STAR standards for commercial cooking equipment, reducing operational costs.'],
        ];

        foreach ($faqs as [$category, $sortOrder, $question, $answer]) {
            Faq::firstOrCreate(
                ['question' => $question],
                [
                    'answer' => $answer,
                    'category' => $category,
                    'sort_order' => $sortOrder,
                    'is_active' => true,
                ]
            );
        }
    }
}
