<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnoxDataSeeder extends Seeder
{
    private array $categoryMap = [];

    public function run(): void
    {
        $productsJson = json_decode(
            file_get_contents(storage_path("app/unox_data/products.json")),
            true,
        );
        $accessoriesJson = json_decode(
            file_get_contents(storage_path("app/unox_data/accessories.json")),
            true,
        );

        $this->buildCategoryMap();
        $this->seedProducts($productsJson);
        $this->seedAccessories($accessoriesJson);
        $this->seedProductAccessoryRelations();

        $this->command->info("UNOX data imported successfully!");
        $this->command->info(Category::count() . " categories");
        $this->command->info(Product::count() . " products");
        $this->command->info(Accessory::count() . " accessories");
    }

    private function buildCategoryMap(): void
    {
        $parents = Category::whereNull("parent_id")
            ->whereIn("name", [
                "Combi",
                "Speed",
                "Convection with humidity",
                "Convention",
                "Service temperature food preserver",
            ])
            ->get()
            ->keyBy("name");

        $combi = $parents["Combi"] ?? null;
        $speed = $parents["Speed"] ?? null;
        $convHum = $parents["Convection with humidity"] ?? null;
        $convention = $parents["Convention"] ?? null;
        $service = $parents["Service temperature food preserver"] ?? null;

        $this->categoryMap = [
            "Commercial countertop combi ovens" => $this->getChildId(
                $combi,
                "Countertop",
            ),
            "Commercial trolley combi ovens" => $this->getChildId(
                $combi,
                "Trolley",
            ),
            "Commercial combi speed ovens" => $this->getChildId(
                $speed,
                "Combi",
            ),
            "Commercial baking speed ovens" => $this->getChildId(
                $speed,
                "Baking",
            ),
            "Commercial convection ovens with humidity" => $this->getChildId(
                $convHum,
                "Countertop",
            ),
            "Commercial convection ovens" => $this->getChildId(
                $convention,
                "Countertop",
            ),
            "The Hot Fridge" => $this->getChildId($service, "Countertop"),
        ];
    }

    private function getChildId(?Category $parent, string $childName): ?int
    {
        if (!$parent) {
            return null;
        }

        return Category::where("parent_id", $parent->id)
            ->where("name", $childName)
            ->first()?->id;
    }

    private function seedProducts(array $products): void
    {
        $this->command->info("Seeding products...");

        foreach ($products as $index => $p) {
            $name = strip_tags(
                $p["title"] ?? ($p["line"] ?? "Unknown Product"),
            );
            $slug = Str::slug($name . " " . ($p["code"] ?? ""));

            $width = $this->parseNumber($p["width"] ?? null);
            $depth = $this->parseNumber($p["depth"] ?? null);
            $height = $this->parseNumber($p["height"] ?? null);
            $weight = $this->parseNumber($p["weight"] ?? null);
            $electricPower = $this->parseNumber($p["electric_power"] ?? null);

            $traySize = $p["trays_dimensions"] ?? null;
            $traysNumber = is_numeric($p["trays_number"] ?? null)
                ? (int) $p["trays_number"]
                : null;
            $distanceBetweenTrays = null;
            if (isset($p["trays_distance"])) {
                $distanceBetweenTrays = $this->parseNumber(
                    $p["trays_distance"],
                );
            }

            $ovenSubtype = $p["oven_subtype_title"] ?? null;
            $categoryId = $this->categoryMap[$ovenSubtype] ?? null;

            Product::updateOrCreate(
                ["sku" => $p["code"] ?? Str::uuid()],
                [
                    "category_id" => $categoryId,
                    "name" => $name,
                    "slug" => $slug,
                    "sku" => $p["code"] ?? null,
                    "description" => $p["description"] ?? null,
                    "short_description" => $p["oven_subtype_title"] ?? null,
                    "type" => $p["oven_subtype_title"] ?? null,
                    "panel" => null,
                    "power_supply" => $p["power_type"] ?? null,
                    "width" => $width,
                    "depth" => $depth,
                    "height" => $height,
                    "weight" => $weight,
                    "number_of_trays" => $traysNumber,
                    "tray_size" => $traySize,
                    "distance_between_trays" => $distanceBetweenTrays,
                    "voltage" => $p["voltage"] ?? null,
                    "electric_power" => $electricPower,
                    "frequency" => $p["frequency"] ?? null,
                    "consumption_kwh" => null,
                    "co2_emission" => null,
                    "energy_star_certified" => $p["energy_star"] ?? false,
                    "price" => $this->parseNumber($p["price"] ?? null),
                    "is_active" => true,
                    "sort_order" => $index + 1,
                ],
            );
        }

        $this->command->info("  " . Product::count() . " products created");
    }

    private function seedAccessories(array $accessories): void
    {
        $this->command->info("Seeding accessories...");

        foreach ($accessories as $index => $a) {
            $name =
                $a["commercial_name"] ?? ($a["title"] ?? "Unknown Accessory");
            $slug = Str::slug($name . " " . ($a["code"] ?? ""));

            $width = $this->parseNumber($a["width_mm"] ?? null);
            $depth = $this->parseNumber($a["depth_mm"] ?? null);
            $height = $this->parseNumber($a["height_mm"] ?? null);
            $weight = $this->parseNumber($a["weight_kg"] ?? null);
            $electricPower = $this->parseNumber($a["electric_power"] ?? null);

            Accessory::updateOrCreate(
                ["sku" => $a["code"] ?? Str::uuid()],
                [
                    "name" => $name,
                    "slug" => $slug,
                    "sku" => $a["code"] ?? null,
                    "description" => $a["description"] ?? null,
                    "short_description" => null,
                    "accessory_type" => $a["category"] ?? null,
                    "width" => $width,
                    "depth" => $depth,
                    "height" => $height,
                    "weight" => $weight,
                    "voltage" => isset($a["voltage"])
                        ? (string) $a["voltage"]
                        : null,
                    "electric_power" => $electricPower,
                    "min_flow" => $this->parseNumber($a["min_flow"] ?? null),
                    "max_flow" => $this->parseNumber($a["max_flow"] ?? null),
                    "quantity" => $a["buy_multiple"] ?? 1,
                    "price" => null,
                    "is_active" => true,
                    "sort_order" => $index + 1,
                ],
            );
        }

        $this->command->info(
            "  " . Accessory::count() . " accessories created",
        );
    }

    private function seedProductAccessoryRelations(): void
    {
        $this->command->info("Linking accessories to products...");

        $products = Product::pluck("id")->toArray();
        $accessories = Accessory::pluck("id")->toArray();

        $inserts = [];
        $usedPairs = [];

        foreach ($products as $productId) {
            if (rand(1, 100) > 30) {
                $count = rand(1, min(5, count($accessories)));
                shuffle($accessories);
                $selected = array_slice($accessories, 0, $count);

                foreach ($selected as $accessoryId) {
                    $key = "{$productId}-{$accessoryId}";
                    if (!isset($usedPairs[$key])) {
                        $usedPairs[$key] = true;
                        $inserts[] = [
                            "product_id" => $productId,
                            "accessory_id" => $accessoryId,
                            "quantity" => 1,
                            "is_default" => rand(1, 100) <= 30 ? 1 : 0,
                            "sort_order" => rand(0, 10),
                            "created_at" => now(),
                            "updated_at" => now(),
                        ];
                    }
                }
            }
        }

        foreach (array_chunk($inserts, 500) as $chunk) {
            DB::table("product_accessories")->insert($chunk);
        }

        $linkedAccessoryIds = array_unique(
            array_column($inserts, "accessory_id"),
        );
        $linkedCount = count($linkedAccessoryIds);
        $unlinkedCount = count($accessories) - $linkedCount;

        $this->command->info(
            "  " . count($inserts) . " product-accessory relations created",
        );
        $this->command->info(
            "  " . $linkedCount . " accessories linked to at least one product",
        );
        $this->command->info(
            "  " . $unlinkedCount . " accessories remain unlinked",
        );
    }

    private function parseNumber($value): ?float
    {
        if (empty($value) || !is_string($value)) {
            return is_numeric($value) ? (float) $value : null;
        }

        $cleaned = str_replace(
            [
                " mm",
                " kg",
                " kW",
                " kWh",
                " A",
                " V",
                " Hz",
                " l",
                " m³/h",
                ",",
            ],
            ["", "", "", "", "", "", "", "", "", "."],
            $value,
        );
        $cleaned = trim($cleaned);

        return is_numeric($cleaned) ? (float) $cleaned : null;
    }
}
