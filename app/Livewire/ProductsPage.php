<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPage extends Component
{
    use WithPagination;

    public string $search = '';

    public int|string $categoryId = '';

    public string $sortBy = 'name';

    public $categories;

    public function mount(): void
    {
        $this->categories = Category::query()
            ->whereHas('products', fn ($q) => $q->where('is_active', true))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
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

        return view('livewire.products-page', compact('products'))
            ->layout('layouts.home')
            ->title('Products — '.config('app.name'));
    }
}
