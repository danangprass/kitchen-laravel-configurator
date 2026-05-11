<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductDetail extends Component
{
    public ?Product $product = null;

    public function mount(string $slug): void
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category.parent', 'productImages' => function ($query) {
                $query->orderBy('sort_order');
            }, 'accessories' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->first();

        if (! $this->product) {
            abort(404);
        }
    }

    public function render()
    {
        return view('livewire.product-detail')->layout('layouts.home', [
            'title' => $this->product->name.' — '.config('app.name'),
        ]);
    }

    public static function getVideoEmbedUrl(?string $url): ?string
    {
        return Configurator::getVideoEmbedUrl($url);
    }

    public function addToCompare(int $productId): void
    {
        $ids = session()->get('compared_product_ids', []);

        if (in_array($productId, $ids, true)) {
            $ids = array_values(array_filter($ids, fn (int $id) => $id !== $productId));
        } elseif (count($ids) < 3) {
            $ids[] = $productId;
        }

        session()->put('compared_product_ids', $ids);
    }

    public function getComparedProductIdsProperty(): array
    {
        return session()->get('compared_product_ids', []);
    }
}
