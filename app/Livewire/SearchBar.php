<?php

namespace App\Livewire;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class SearchBar extends Component
{
    public string $query = '';

    public bool $isOpen = false;

    private const MAX_PER_GROUP = 5;

    private const MIN_QUERY_LENGTH = 2;

    public function updatedQuery(): void
    {
        $this->isOpen = strlen($this->query) >= self::MIN_QUERY_LENGTH;
    }

    public function closeDropdown(): void
    {
        $this->isOpen = false;
    }

    public function resetAndNavigate(): void
    {
        $this->query = '';
        $this->isOpen = false;
    }

    /**
     * @return array{products: array<array{label: string, url: string}>, accessories: array<array{label: string, url: string}>, categories: array<array{label: string, url: string}>}
     */
    public function getResultsProperty(): array
    {
        if (strlen($this->query) < self::MIN_QUERY_LENGTH) {
            return ['products' => [], 'accessories' => [], 'categories' => []];
        }

        $search = '%' . $this->query . '%';

        $products = Product::where('is_active', true)
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                    ->orWhere('slug', 'like', $search)
                    ->orWhere('sku', 'like', $search)
                    ->orWhere('description', 'like', $search);
            })
            ->limit(self::MAX_PER_GROUP)
            ->get()
            ->map(fn (Product $product): array => [
                'label' => $product->name,
                'url' => route('configurator', ['product' => $product->slug]),
            ])
            ->toArray();

        $accessories = Accessory::where('is_active', true)
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                    ->orWhere('sku', 'like', $search)
                    ->orWhere('description', 'like', $search);
            })
            ->limit(self::MAX_PER_GROUP)
            ->get()
            ->map(fn (Accessory $accessory): array => [
                'label' => $accessory->name,
                'url' => route('configurator', ['accessory' => $accessory->slug]),
            ])
            ->toArray();

        $categories = Category::query()
            ->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                    ->orWhere('description', 'like', $search);
            })
            ->limit(self::MAX_PER_GROUP)
            ->get()
            ->map(fn (Category $category): array => [
                'label' => $category->name,
                'url' => route('configurator', ['category' => $category->slug]),
            ])
            ->toArray();

        return [
            'products' => $products,
            'accessories' => $accessories,
            'categories' => $categories,
        ];
    }

    public function getHasResultsProperty(): bool
    {
        $results = $this->results;

        return ! empty($results['products'])
            || ! empty($results['accessories'])
            || ! empty($results['categories']);
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
