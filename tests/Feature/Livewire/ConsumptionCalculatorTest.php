<?php

namespace Tests\Feature\Livewire;

use App\Livewire\ConsumptionCalculator;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

final class ConsumptionCalculatorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function product_label_appends_sku_when_present(): void
    {
        $product = new Product;
        $product->name = 'CHEFTOP MIND.Maps BIG PLUS';
        $product->sku = 'XEVC-1011-E3R';

        $component = new ConsumptionCalculator;

        $this->assertSame(
            'CHEFTOP MIND.Maps BIG PLUS — XEVC-1011-E3R',
            $component->productLabel($product)
        );
    }

    #[Test]
    public function product_label_falls_back_to_tray_count_when_sku_blank(): void
    {
        $product = new Product;
        $product->name = 'CHEFTOP MIND.Maps BIG PLUS';
        $product->sku = '';
        $product->number_of_trays = 10;

        $component = new ConsumptionCalculator;

        $this->assertSame(
            'CHEFTOP MIND.Maps BIG PLUS (10 trays)',
            $component->productLabel($product)
        );
    }

    #[Test]
    public function product_label_returns_name_only_when_no_differentiator(): void
    {
        $product = new Product;
        $product->name = 'CHEFTOP MIND.Maps BIG PLUS';
        $product->sku = '';
        $product->number_of_trays = null;

        $component = new ConsumptionCalculator;

        $this->assertSame('CHEFTOP MIND.Maps BIG PLUS', $component->productLabel($product));
    }

    #[Test]
    public function results_step_renders_disambiguated_oven_label(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id,
            'name' => 'CHEFTOP MIND.Maps BIG PLUS',
            'sku' => 'XEVC-1011-E3R',
            'is_active' => true,
            'consumption_kwh' => 10,
            'electric_power' => 10,
            'co2_emission' => 0.5,
            'sort_order' => 1,
        ]);

        Livewire::test(ConsumptionCalculator::class)
            ->call('toggleProduct', $product->id)
            ->call('nextStep')
            ->call('nextStep')
            ->call('nextStep')
            ->assertSee('CHEFTOP MIND.Maps BIG PLUS — XEVC-1011-E3R');
    }
}
