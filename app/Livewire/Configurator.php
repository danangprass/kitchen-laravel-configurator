<?php

namespace App\Livewire;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class Configurator extends Component
{
    public int $step = 1;

    public ?int $selectedCategoryId = null;

    public ?int $selectedSubcategoryId = null;

    /** @var int[] */
    public array $selectedProductIds = [];

    /** @var array<int, array{quantity: int, selected: bool}> */
    public array $columnAccessories = [];

    /** @var array<int, array{quantity: int, selected: bool}> */
    public array $otherAccessories = [];

    // Advanced product filters (Step 1)
    public string $filterTraySize = '';

    public string $filterPowerSupply = '';

    public string $filterEnergyStar = '';

    public string $filterTrayCount = '';

    public string $filterLine = '';

    public string $filterDoorOpening = '';

    public bool $showFilters = false;

    public function mount(): void
    {
        $this->step = 1;
    }

    public function selectCategory(int $id): void
    {
        $this->selectedCategoryId = $id;
        $this->selectedSubcategoryId = null;
    }

    public function selectSubcategory(int $id): void
    {
        $this->selectedSubcategoryId = $id;
        $this->clearFilters();
    }

    public function toggleProduct(int $id): void
    {
        if (in_array($id, $this->selectedProductIds, true)) {
            $this->selectedProductIds = array_diff($this->selectedProductIds, [
                $id,
            ]);
        } else {
            $this->selectedProductIds[] = $id;
        }
    }

    public function removeProduct(int $id): void
    {
        $this->selectedProductIds = array_diff($this->selectedProductIds, [
            $id,
        ]);
        $this->resetAccessorySelections();
    }

    public function goToStep(int $step): void
    {
        if ($step < 1 || $step > 5) {
            return;
        }

        if ($step > 1 && empty($this->selectedProductIds)) {
            return;
        }

        $this->step = $step;

        if ($step === 3 || $step === 4) {
            $this->initializeAccessorySelections();
        }
    }

    public function nextStep(): void
    {
        $this->goToStep($this->step + 1);
    }

    public function prevStep(): void
    {
        $this->goToStep($this->step - 1);
    }

    public function toggleColumnAccessory(int $accessoryId): void
    {
        if (isset($this->columnAccessories[$accessoryId])) {
            unset($this->columnAccessories[$accessoryId]);
        } else {
            $this->columnAccessories[$accessoryId] = [
                'quantity' => 1,
                'selected' => true,
            ];
        }
    }

    public function updateColumnAccessoryQuantity(
        int $accessoryId,
        int $quantity,
    ): void {
        if ($quantity < 1) {
            unset($this->columnAccessories[$accessoryId]);

            return;
        }

        if (isset($this->columnAccessories[$accessoryId])) {
            $this->columnAccessories[$accessoryId]['quantity'] = $quantity;
        }
    }

    public function toggleOtherAccessory(int $accessoryId): void
    {
        if (isset($this->otherAccessories[$accessoryId])) {
            unset($this->otherAccessories[$accessoryId]);
        } else {
            $this->otherAccessories[$accessoryId] = [
                'quantity' => 1,
                'selected' => true,
            ];
        }
    }

    public function updateOtherAccessoryQuantity(
        int $accessoryId,
        int $quantity,
    ): void {
        if ($quantity < 1) {
            unset($this->otherAccessories[$accessoryId]);

            return;
        }

        if (isset($this->otherAccessories[$accessoryId])) {
            $this->otherAccessories[$accessoryId]['quantity'] = $quantity;
        }
    }

    public function toggleCompare(int $productId): void
    {
        $ids = session()->get('compared_product_ids', []);

        if (in_array($productId, $ids, true)) {
            $ids = array_values(
                array_filter($ids, fn (int $id) => $id !== $productId),
            );
        } elseif (count($ids) < 3) {
            $ids[] = $productId;
        }

        session()->put('compared_product_ids', $ids);
    }

    public function getComparedProductIdsProperty(): array
    {
        return session()->get('compared_product_ids', []);
    }

    public function getComparedProductCountProperty(): int
    {
        return count($this->comparedProductIds);
    }

    public function restart(): void
    {
        $this->step = 1;
        $this->selectedCategoryId = null;
        $this->selectedSubcategoryId = null;
        $this->selectedProductIds = [];
        $this->columnAccessories = [];
        $this->otherAccessories = [];
        $this->clearFilters();
    }

    public function getCategoriesProperty(): Collection
    {
        return Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function getSelectedCategoryProperty(): ?Category
    {
        if (! $this->selectedCategoryId) {
            return null;
        }

        return $this->categories->firstWhere('id', $this->selectedCategoryId);
    }

    public function getSubcategoriesProperty(): Collection
    {
        $category = $this->selectedCategory;

        if (! $category) {
            return collect();
        }

        return $category
            ->children()
            ->withCount('products')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function getSelectedSubcategoryProperty(): ?Category
    {
        if (! $this->selectedSubcategoryId) {
            return null;
        }

        return $this->subcategories->firstWhere(
            'id',
            $this->selectedSubcategoryId,
        );
    }

    public function getProductsProperty(): Collection
    {
        $subcategory = $this->selectedSubcategory;

        if (! $subcategory) {
            return collect();
        }

        return Product::where('category_id', $subcategory->id)
            ->where('is_active', true)
            ->when($this->filterTraySize !== '', function ($query) {
                $query->where('tray_size', $this->filterTraySize);
            })
            ->when($this->filterPowerSupply !== '', function ($query) {
                $query->where('power_supply', $this->filterPowerSupply);
            })
            ->when($this->filterEnergyStar !== '', function ($query) {
                $query->where(
                    'energy_star_certified',
                    $this->filterEnergyStar === '1',
                );
            })
            ->when($this->filterTrayCount !== '', function ($query) {
                $query->where('number_of_trays', (int) $this->filterTrayCount);
            })
            ->when($this->filterLine !== '', function ($query) {
                $query->where('line', $this->filterLine);
            })
            ->when($this->filterDoorOpening !== '', function ($query) {
                $query->where('opening_side', $this->filterDoorOpening);
            })
            ->orderBy('sort_order')
            ->get();
    }

    public function getTraySizeOptionsProperty(): Collection
    {
        return $this->getDistinctValues('tray_size');
    }

    public function getPowerSupplyOptionsProperty(): Collection
    {
        return $this->getDistinctValues('power_supply');
    }

    public function getLineOptionsProperty(): Collection
    {
        return $this->getDistinctValues('line');
    }

    public function getDoorOpeningOptionsProperty(): Collection
    {
        return $this->getDistinctValues('opening_side');
    }

    public function getTrayCountOptionsProperty(): Collection
    {
        return $this->getDistinctValues('number_of_trays', ascending: true);
    }

    private function getDistinctValues(
        string $column,
        bool $ascending = false,
    ): Collection {
        $subcategory = $this->selectedSubcategory;

        if (! $subcategory) {
            return collect();
        }

        $query = Product::where('category_id', $subcategory->id)
            ->where('is_active', true)
            ->whereNotNull($column)
            ->distinct()
            ->orderBy($column, $ascending ? 'asc' : 'desc');

        return $query->pluck($column);
    }

    public function getSelectedProductsProperty(): Collection
    {
        if (empty($this->selectedProductIds)) {
            return collect();
        }

        return Product::whereIn('id', $this->selectedProductIds)
            ->with('category.parent')
            ->orderBy('sort_order')
            ->get();
    }

    public function getCompatibleColumnAccessoriesProperty(): Collection
    {
        if (empty($this->selectedProductIds)) {
            return collect();
        }

        return Accessory::whereHas('products', function ($query) {
            $query->whereIn('products.id', $this->selectedProductIds);
        })
            ->whereIn('configurator_position', ['upper', 'bottom'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function getCompatibleOtherAccessoriesProperty(): Collection
    {
        if (empty($this->selectedProductIds)) {
            return collect();
        }

        return Accessory::whereHas('products', function ($query) {
            $query->whereIn('products.id', $this->selectedProductIds);
        })
            ->where(function ($query) {
                $query
                    ->where('configurator_position', 'other')
                    ->orWhereNull('configurator_position');
            })
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function getSelectedColumnAccessoriesListProperty(): Collection
    {
        if (empty($this->columnAccessories)) {
            return collect();
        }

        $ids = array_keys($this->columnAccessories);

        return Accessory::whereIn('id', $ids)
            ->get()
            ->map(function (Accessory $accessory) {
                $accessory->selected_quantity =
                    $this->columnAccessories[$accessory->id]['quantity'] ?? 1;

                return $accessory;
            });
    }

    public function getSelectedOtherAccessoriesListProperty(): Collection
    {
        if (empty($this->otherAccessories)) {
            return collect();
        }

        $ids = array_keys($this->otherAccessories);

        return Accessory::whereIn('id', $ids)
            ->get()
            ->map(function (Accessory $accessory) {
                $accessory->selected_quantity =
                    $this->otherAccessories[$accessory->id]['quantity'] ?? 1;

                return $accessory;
            });
    }

    public function getTotalPriceProperty(): ?float
    {
        return self::calculateTotalPrice(
            $this->selectedProducts,
            $this->selectedColumnAccessoriesList,
            $this->selectedOtherAccessoriesList,
        );
    }

    public function getHasPricingProperty(): bool
    {
        return $this->totalPrice !== null;
    }

    public static function calculateTotalPrice(
        Collection $products,
        Collection $columnAccessories,
        Collection $otherAccessories,
    ): ?float {
        $total = 0.0;

        foreach ($products as $product) {
            $total += (float) ($product->price ?? 0);
        }

        foreach ($columnAccessories as $accessory) {
            $total +=
                (float) ($accessory->price ?? 0) *
                $accessory->selected_quantity;
        }

        foreach ($otherAccessories as $accessory) {
            $total +=
                (float) ($accessory->price ?? 0) *
                $accessory->selected_quantity;
        }

        return $total > 0 ? $total : null;
    }

    public function clearFilters(): void
    {
        $this->filterTraySize = '';
        $this->filterPowerSupply = '';
        $this->filterEnergyStar = '';
        $this->filterTrayCount = '';
        $this->filterLine = '';
        $this->filterDoorOpening = '';
        $this->showFilters = false;
    }

    public function getActiveFilterCountProperty(): int
    {
        $count = 0;

        if ($this->filterTraySize !== '') {
            $count++;
        }
        if ($this->filterPowerSupply !== '') {
            $count++;
        }
        if ($this->filterEnergyStar !== '') {
            $count++;
        }
        if ($this->filterTrayCount !== '') {
            $count++;
        }
        if ($this->filterLine !== '') {
            $count++;
        }
        if ($this->filterDoorOpening !== '') {
            $count++;
        }

        return $count;
    }

    /**
     * Validate and convert a video URL to a sandboxed embed URL.
     * Only allows youtube.com, youtu.be, and vimeo.com domains.
     */
    public static function getVideoEmbedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $host = parse_url($url, PHP_URL_HOST);

        if (! $host) {
            return null;
        }

        $host = strtolower($host);
        $allowedHosts = [
            'youtube.com',
            'www.youtube.com',
            'youtu.be',
            'vimeo.com',
            'www.vimeo.com',
        ];

        if (! in_array($host, $allowedHosts, true)) {
            return null;
        }

        // Convert YouTube watch URLs to embed format
        if (preg_match("/youtube\.com\/watch\?v=([A-Za-z0-9_-]+)/", $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        if (preg_match("/youtu\.be\/([A-Za-z0-9_-]+)/", $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        // Convert Vimeo URLs to embed format
        if (preg_match("/vimeo\.com\/(\d+)/", $url, $m)) {
            return 'https://player.vimeo.com/video/'.$m[1];
        }

        return null;
    }

    public function render()
    {
        return view('livewire.configurator')->layout('layouts.app', [
            'title' => 'Kitchen Oven Configurator',
        ]);
    }

    private function resetAccessorySelections(): void
    {
        $this->columnAccessories = [];
        $this->otherAccessories = [];
    }

    private function initializeAccessorySelections(): void
    {
        $columnIds = $this->compatibleColumnAccessories->pluck('id')->toArray();
        $otherIds = $this->compatibleOtherAccessories->pluck('id')->toArray();

        $this->columnAccessories = array_intersect_key(
            $this->columnAccessories,
            array_flip($columnIds),
        );

        $this->otherAccessories = array_intersect_key(
            $this->otherAccessories,
            array_flip($otherIds),
        );
    }
}
