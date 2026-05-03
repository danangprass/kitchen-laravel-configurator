<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $category = Category::factory()->create();
        $name = fake()->name();
        $slug = fake()->slug();
        $sku = fake()->word();
        $energy_star_certified = fake()->boolean();
        $is_active = fake()->boolean();
        $sort_order = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('products.store'), [
            'category_id' => $category->id,
            'name' => $name,
            'slug' => $slug,
            'sku' => $sku,
            'energy_star_certified' => $energy_star_certified,
            'is_active' => $is_active,
            'sort_order' => $sort_order,
        ]);

        $products = Product::query()
            ->where('category_id', $category->id)
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('sku', $sku)
            ->where('energy_star_certified', $energy_star_certified)
            ->where('is_active', $is_active)
            ->where('sort_order', $sort_order)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $product = Product::factory()->create();
        $category = Category::factory()->create();
        $name = fake()->name();
        $slug = fake()->slug();
        $sku = fake()->word();
        $energy_star_certified = fake()->boolean();
        $is_active = fake()->boolean();
        $sort_order = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('products.update', $product), [
            'category_id' => $category->id,
            'name' => $name,
            'slug' => $slug,
            'sku' => $sku,
            'energy_star_certified' => $energy_star_certified,
            'is_active' => $is_active,
            'sort_order' => $sort_order,
        ]);

        $product->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($category->id, $product->category_id);
        $this->assertEquals($name, $product->name);
        $this->assertEquals($slug, $product->slug);
        $this->assertEquals($sku, $product->sku);
        $this->assertEquals($energy_star_certified, $product->energy_star_certified);
        $this->assertEquals($is_active, $product->is_active);
        $this->assertEquals($sort_order, $product->sort_order);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertNoContent();

        $this->assertModelMissing($product);
    }
}
