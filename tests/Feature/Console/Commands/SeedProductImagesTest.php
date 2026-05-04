<?php

declare(strict_types=1);

namespace Tests\Feature\Console\Commands;

use App\Console\Commands\SeedProductImages;
use App\Models\Accessory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Tests\TestCase;

final class SeedProductImagesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_seeds_product_images_from_cdn(): void
    {
        Storage::fake('public');
        Http::fake([
            'https://www.unox.com/unox/media/contents/test-product.png' => Http::response('fake-image-data', 200),
        ]);

        $product = Product::factory()->create([
            'configurator_image' => '/unox/media/contents/test-product.png',
            'list_image' => '/unox/media/contents/test-product.png',
        ]);

        $command = new SeedProductImages;
        $command->setLaravel($this->app);
        $exitCode = $command->run(new ArrayInput([]), new BufferedOutput);
        $this->assertSame(0, $exitCode);

        $this->assertDatabaseHas('product_images', [
            'product_id' => $product->id,
            'image_path' => 'products/'.$product->sku.'/test-product.png',
            'is_primary' => true,
        ]);

        Storage::disk('public')->assertExists('products/'.$product->sku.'/test-product.png');
    }

    #[Test]
    public function it_seeds_accessory_images_from_cdn(): void
    {
        Storage::fake('public');
        Http::fake([
            'https://www.unox.com/unox/media/contents/test-accessory.png' => Http::response('fake-image-data', 200),
        ]);

        $accessory = Accessory::factory()->create([
            'configurator_image' => '/unox/media/contents/test-accessory.png',
            'list_image' => null,
        ]);

        $command = new SeedProductImages;
        $command->setLaravel($this->app);
        $exitCode = $command->run(new ArrayInput([]), new BufferedOutput);
        $this->assertSame(0, $exitCode);

        $this->assertDatabaseHas('accessory_images', [
            'accessory_id' => $accessory->id,
            'image_path' => 'accessories/'.$accessory->sku.'/test-accessory.png',
            'is_primary' => true,
        ]);

        Storage::disk('public')->assertExists('accessories/'.$accessory->sku.'/test-accessory.png');
    }

    #[Test]
    public function it_creates_multiple_images_when_configurator_and_list_differ(): void
    {
        Storage::fake('public');
        Http::fake([
            'https://www.unox.com/unox/media/contents/config.png' => Http::response('fake-config-data', 200),
            'https://www.unox.com/unox/media/contents/list.png' => Http::response('fake-list-data', 200),
        ]);

        $product = Product::factory()->create([
            'configurator_image' => '/unox/media/contents/config.png',
            'list_image' => '/unox/media/contents/list.png',
        ]);

        $command = new SeedProductImages;
        $command->setLaravel($this->app);
        $exitCode = $command->run(new ArrayInput([]), new BufferedOutput);
        $this->assertSame(0, $exitCode);

        $this->assertDatabaseCount('product_images', 2);
        $this->assertDatabaseHas('product_images', [
            'product_id' => $product->id,
            'image_path' => 'products/'.$product->sku.'/config.png',
            'is_primary' => true,
        ]);
        $this->assertDatabaseHas('product_images', [
            'product_id' => $product->id,
            'image_path' => 'products/'.$product->sku.'/list.png',
            'is_primary' => false,
        ]);
    }

    #[Test]
    public function it_skips_existing_images_when_option_is_set(): void
    {
        Storage::fake('public');
        Http::fake([
            'https://www.unox.com/unox/media/contents/test.png' => Http::response('fake-image-data', 200),
        ]);

        $product = Product::factory()->create([
            'configurator_image' => '/unox/media/contents/test.png',
        ]);

        $command = new SeedProductImages;
        $command->setLaravel($this->app);
        $exitCode = $command->run(new ArrayInput([]), new BufferedOutput);
        $this->assertSame(0, $exitCode);
        $this->assertDatabaseCount('product_images', 1);

        $command2 = new SeedProductImages;
        $command2->setLaravel($this->app);
        $exitCode = $command2->run(new ArrayInput(['--skip-existing' => true]), new BufferedOutput);
        $this->assertSame(0, $exitCode);
        $this->assertDatabaseCount('product_images', 1);
    }

    #[Test]
    public function it_skips_failed_downloads_gracefully(): void
    {
        Storage::fake('public');
        Http::fake([
            'https://www.unox.com/unox/media/contents/missing.png' => Http::response('', 404),
        ]);

        Product::factory()->create([
            'configurator_image' => '/unox/media/contents/missing.png',
        ]);

        $command = new SeedProductImages;
        $command->setLaravel($this->app);
        $output = new BufferedOutput;
        $exitCode = $command->run(new ArrayInput([]), $output);
        $this->assertSame(0, $exitCode);
        $this->assertStringContainsString('Failed to download image', $output->fetch());

        $this->assertDatabaseCount('product_images', 0);
    }
}
