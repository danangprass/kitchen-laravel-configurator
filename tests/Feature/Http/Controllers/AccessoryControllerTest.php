<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\AccessoryController;
use App\Http\Requests\AccessoryStoreRequest;
use App\Http\Requests\AccessoryUpdateRequest;
use App\Models\Accessory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see AccessoryController
 */
final class AccessoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $accessories = Accessory::factory()->count(3)->create();

        $response = $this->get(route('accessories.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            AccessoryController::class,
            'store',
            AccessoryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = fake()->name();
        $slug = fake()->slug();
        $sku = fake()->word();
        $quantity = fake()->numberBetween(-10000, 10000);
        $is_active = fake()->boolean();
        $sort_order = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('accessories.store'), [
            'name' => $name,
            'slug' => $slug,
            'sku' => $sku,
            'quantity' => $quantity,
            'is_active' => $is_active,
            'sort_order' => $sort_order,
        ]);

        $accessories = Accessory::query()
            ->where('name', $name)
            ->where('slug', $slug)
            ->where('sku', $sku)
            ->where('quantity', $quantity)
            ->where('is_active', $is_active)
            ->where('sort_order', $sort_order)
            ->get();
        $this->assertCount(1, $accessories);
        $accessory = $accessories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function show_behaves_as_expected(): void
    {
        $accessory = Accessory::factory()->create();

        $response = $this->get(route('accessories.show', $accessory));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }

    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            AccessoryController::class,
            'update',
            AccessoryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $accessory = Accessory::factory()->create();
        $name = fake()->name();
        $slug = fake()->slug();
        $sku = fake()->word();
        $quantity = fake()->numberBetween(-10000, 10000);
        $is_active = fake()->boolean();
        $sort_order = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('accessories.update', $accessory), [
            'name' => $name,
            'slug' => $slug,
            'sku' => $sku,
            'quantity' => $quantity,
            'is_active' => $is_active,
            'sort_order' => $sort_order,
        ]);

        $accessory->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $accessory->name);
        $this->assertEquals($slug, $accessory->slug);
        $this->assertEquals($sku, $accessory->sku);
        $this->assertEquals($quantity, $accessory->quantity);
        $this->assertEquals($is_active, $accessory->is_active);
        $this->assertEquals($sort_order, $accessory->sort_order);
    }

    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $accessory = Accessory::factory()->create();

        $response = $this->delete(route('accessories.destroy', $accessory));

        $response->assertNoContent();

        $this->assertModelMissing($accessory);
    }
}
