<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCompareSelector extends Component
{
    use WithPagination;

    public string $search = '';

    public int|string $categoryId = '';

    public string $sortBy = 'name';

    public Collection $categories;

    /** @var int[] */
    public array $comparedProductIds = [];

    public function mount(): void
    {
        $this->categories = Category::query()
            ->whereHas('products', fn ($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $this->comparedProductIds = session()->get('compared_product_ids', []);
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    public function selectCategory(int|string $id): void
    {
        $this->categoryId = $id;
        $this->resetPage();
    }

    public bool $showLimitMessage = false;

    public function toggleCompare(int $productId): void
    {
        $ids = session()->get('compared_product_ids', []);

        if (in_array($productId, $ids, true)) {
            $ids = array_values(array_filter($ids, fn (int $id) => $id !== $productId));
            $this->showLimitMessage = false;
        } elseif (count($ids) < 3) {
            $ids[] = $productId;
            $this->showLimitMessage = false;
        } else {
            $this->showLimitMessage = true;
        }

        session()->put('compared_product_ids', $ids);
        $this->comparedProductIds = $ids;
    }

    public function getComparedProductCountProperty(): int
    {
        return count($this->comparedProductIds);
    }

    public function render()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->when($this->categoryId !== '', fn ($q) => $q->where('category_id', $this->categoryId))
            ->when($this->search !== '', function ($q) {
                $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $this->search);
                $q->where(fn ($inner) => $inner
                    ->where('name', 'like', '%'.$escaped.'%')
                    ->orWhere('short_description', 'like', '%'.$escaped.'%')
                    ->orWhere('sku', 'like', '%'.$escaped.'%')
                );
            })
            ->when($this->sortBy === 'name', fn ($q) => $q->orderBy('name'))
            ->when($this->sortBy === 'sort_order', fn ($q) => $q->orderBy('sort_order'))
            ->with('category')
            ->paginate(12);

        return view('livewire.product-compare-selector', compact('products'))
            ->layout('layouts.home')
            ->title('Select Ovens to Compare — '.config('app.name'));
    }
}
