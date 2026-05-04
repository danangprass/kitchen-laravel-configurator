<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Accessory;
use App\Models\AccessoryImage;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SeedProductImages extends Command
{
    protected $signature = 'images:seed {--skip-existing : Skip items that already have images}';

    protected $description = 'Download and seed product and accessory images from UNOX CDN';

    private const BASE_URL = 'https://www.unox.com';

    public function handle(): int
    {
        $this->info('Seeding product images...');
        $productCount = $this->seedProductImages();
        $this->info("Created {$productCount} product image records.");

        $this->info('Seeding accessory images...');
        $accessoryCount = $this->seedAccessoryImages();
        $this->info("Created {$accessoryCount} accessory image records.");

        return self::SUCCESS;
    }

    private function seedProductImages(): int
    {
        $count = 0;

        $query = Product::query()
            ->where(function ($query): void {
                $query->whereNotNull('configurator_image')
                    ->orWhereNotNull('list_image');
            });

        if ($this->option('skip-existing')) {
            $query->whereDoesntHave('productImages');
        }

        $products = $query->get();

        foreach ($products as $product) {
            $images = $this->collectImageUrls(
                $product->configurator_image,
                $product->list_image,
            );

            foreach ($images as $index => $relativeUrl) {
                $path = $this->downloadImage($relativeUrl, 'products', $product->sku);

                if ($path === null) {
                    $this->warn("Failed to download image for product {$product->sku}: {$relativeUrl}");

                    continue;
                }

                if ($this->imageExists(ProductImage::class, $product->id, $path)) {
                    continue;
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'alt_text' => $product->name,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
                $count++;
            }
        }

        return $count;
    }

    private function seedAccessoryImages(): int
    {
        $count = 0;

        $query = Accessory::query()
            ->where(function ($query): void {
                $query->whereNotNull('configurator_image')
                    ->orWhereNotNull('list_image');
            });

        if ($this->option('skip-existing')) {
            $query->whereDoesntHave('accessoryImages');
        }

        $accessories = $query->get();

        foreach ($accessories as $accessory) {
            $images = $this->collectImageUrls(
                $accessory->configurator_image,
                $accessory->list_image,
            );

            foreach ($images as $index => $relativeUrl) {
                $path = $this->downloadImage($relativeUrl, 'accessories', $accessory->sku);

                if ($path === null) {
                    $this->warn("Failed to download image for accessory {$accessory->sku}: {$relativeUrl}");

                    continue;
                }

                if ($this->imageExists(AccessoryImage::class, $accessory->id, $path)) {
                    continue;
                }

                AccessoryImage::create([
                    'accessory_id' => $accessory->id,
                    'image_path' => $path,
                    'alt_text' => $accessory->name,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
                $count++;
            }
        }

        return $count;
    }

    /**
     * @return list<string>
     */
    private function collectImageUrls(?string $configuratorImage, ?string $listImage): array
    {
        $images = [];

        if (! empty($configuratorImage)) {
            $images[] = $configuratorImage;
        }

        if (! empty($listImage) && $listImage !== $configuratorImage) {
            $images[] = $listImage;
        }

        return $images;
    }

    private function downloadImage(string $relativeUrl, string $type, string $sku): ?string
    {
        $filename = basename($relativeUrl);
        $directory = $type.'/'.preg_replace('/[^a-zA-Z0-9\-_]/', '_', $sku);
        $path = $directory.'/'.$filename;

        $disk = Storage::disk('public');

        if ($disk->exists($path)) {
            return $path;
        }

        try {
            $response = Http::timeout(30)->get(self::BASE_URL.$relativeUrl);

            if (! $response->successful()) {
                return null;
            }

            $disk->put($path, $response->body());

            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function imageExists(string $modelClass, int $modelId, string $path): bool
    {
        $foreignKey = $modelClass === ProductImage::class ? 'product_id' : 'accessory_id';

        return $modelClass::query()
            ->where($foreignKey, $modelId)
            ->where('image_path', $path)
            ->exists();
    }
}
