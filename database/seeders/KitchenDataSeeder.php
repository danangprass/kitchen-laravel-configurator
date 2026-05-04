<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KitchenDataSeeder extends Seeder
{
    private array $categoryMap = [];
    private array $accessoryIdMap = [];
    private array $productIdMap = [];

    public function run(): void
    {
        $productsJson = json_decode(
            file_get_contents(storage_path("app/unox_data/products_full.json")),
            true,
        );
        $accessoriesJson = json_decode(
            file_get_contents(
                storage_path("app/unox_data/accessories_full.json"),
            ),
            true,
        );

        $this->buildCategoryMap();
        $this->seedAccessories($accessoriesJson);
        $this->seedProducts($productsJson);
        $this->seedProductAccessoryRelations($productsJson);

        $this->command->info("Kitchen data imported successfully!");
        $this->command->info(Category::count() . " categories");
        $this->command->info(Product::count() . " products");
        $this->command->info(Accessory::count() . " accessories");

        $relationCount = DB::table("product_accessories")->count();
        $this->command->info($relationCount . " product-accessory relations");
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
            $maxGasPower = $this->parseNumber($p["max_gas_power"] ?? null);

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

            $product = Product::updateOrCreate(
                ["sku" => $p["code"] ?? Str::uuid()],
                [
                    "category_id" => $categoryId,
                    "name" => $name,
                    "line" => $p["line"] ?? null,
                    "slug" => $slug,
                    "sku" => $p["code"] ?? null,
                    "description" => $p["description"] ?? null,
                    "short_description" => $p["oven_subtype_title"] ?? null,
                    "type" => $p["oven_subtype_title"] ?? null,
                    "panel" => null,
                    "control_type" => $p["control_type"] ?? null,
                    "power_supply" => $p["power_type"] ?? null,
                    "opening_side" => $p["opening_side"] ?? null,
                    "width" => $width,
                    "depth" => $depth,
                    "height" => $height,
                    "weight" => $weight,
                    "number_of_trays" => $traysNumber,
                    "tray_size" => $traySize,
                    "distance_between_trays" => $distanceBetweenTrays,
                    "voltage" => $p["voltage"] ?? null,
                    "electric_power" => $electricPower,
                    "max_gas_power" => $maxGasPower,
                    "frequency" => $p["frequency"] ?? null,
                    "consumption_kwh" => null,
                    "co2_emission" => null,
                    "energy_star_certified" => $p["energy_star"] ?? false,
                    "configurator_image" =>
                        $p["configurator_image"] ?? ($p["image_src"] ?? null),
                    "list_image" =>
                        $p["list_image"] ?? ($p["image_src"] ?? null),
                    "features" => $p["features"] ?? null,
                    "card_info" => $p["card_info"] ?? null,
                    "price" => $this->parseNumber($p["price"] ?? null),
                    "is_active" => true,
                    "sort_order" => $index + 1,
                ],
            );

            $this->productIdMap[$p["id"]] = $product->id;
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

            $accessory = Accessory::updateOrCreate(
                ["sku" => $a["code"] ?? Str::uuid()],
                [
                    "name" => $name,
                    "slug" => $slug,
                    "sku" => $a["code"] ?? null,
                    "commercial_name" => $a["commercial_name"] ?? null,
                    "description" => $a["description"] ?? null,
                    "short_description" => null,
                    "accessory_type" => $a["accessory_category"] ?? null,
                    "configurator_position" =>
                        $a["configurator_position"] ?? null,
                    "configurator_image" => $a["configurator_image"] ?? null,
                    "list_image" => $a["list_image"] ?? null,
                    "list_image_alt" => $a["list_image_alt"] ?? null,
                    "accessory_line" => $a["accessory_line"] ?? null,
                    "accessory_category" => $a["accessory_category"] ?? null,
                    "accessory_subcategory" =>
                        $a["accessory_subcategory"] ?? null,
                    "labels" => $a["labels"] ?? null,
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
                    "is_featured" => $a["is_featured"] ?? false,
                    "prefooter" => $a["prefooter"] ?? false,
                    "price" => null,
                    "is_active" => true,
                    "sort_order" => $index + 1,
                ],
            );

            $this->accessoryIdMap[$a["id"]] = $accessory->id;
        }

        $this->command->info(
            "  " . Accessory::count() . " accessories created",
        );
    }

    private function seedProductAccessoryRelations(array $products): void
    {
        $this->command->info("Linking accessories to products...");

        $inserts = [];
        $usedPairs = [];

        foreach ($products as $product) {
            $productDbId = $this->productIdMap[$product["id"]] ?? null;
            if (!$productDbId) {
                continue;
            }

            foreach ($product["accessories"] ?? [] as $accJsonId) {
                $accessoryDbId = $this->accessoryIdMap[$accJsonId] ?? null;
                if (!$accessoryDbId) {
                    continue;
                }

                $key = "{$productDbId}-{$accessoryDbId}";
                if (!isset($usedPairs[$key])) {
                    $usedPairs[$key] = true;
                    $inserts[] = [
                        "product_id" => $productDbId,
                        "accessory_id" => $accessoryDbId,
                        "quantity" => 1,
                        "is_default" => false,
                        "sort_order" => 0,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ];
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
        $totalAccessories = count($this->accessoryIdMap);
        $unlinkedCount = $totalAccessories - $linkedCount;

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
