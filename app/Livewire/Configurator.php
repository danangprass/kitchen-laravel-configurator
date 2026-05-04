<?php

namespace App\Livewire;

use App\Models\Accessory;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function restart(): void
    {
        $this->step = 1;
        $this->selectedCategoryId = null;
        $this->selectedSubcategoryId = null;
        $this->selectedProductIds = [];
        $this->columnAccessories = [];
        $this->otherAccessories = [];
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
            ->orderBy('sort_order')
            ->get();
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
        $total = 0.0;

        foreach ($this->selectedProducts as $product) {
            $total += (float) ($product->price ?? 0);
        }

        foreach ($this->selectedColumnAccessoriesList as $accessory) {
            $total +=
                (float) ($accessory->price ?? 0) *
                $accessory->selected_quantity;
        }

        foreach ($this->selectedOtherAccessoriesList as $accessory) {
            $total +=
                (float) ($accessory->price ?? 0) *
                $accessory->selected_quantity;
        }

        return $total > 0 ? $total : null;
    }

    public function downloadPdf()
    {
        $data = [
            'selectedProducts' => $this->selectedProducts,
            'selectedColumnAccessoriesList' => $this->selectedColumnAccessoriesList,
            'selectedOtherAccessoriesList' => $this->selectedOtherAccessoriesList,
            'totalPrice' => $this->totalPrice,
        ];

        $pdf = Pdf::loadView('pdf.configuration', $data);
        $pdf->setPaper('a4', 'portrait');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Kitchen_Configuration_'.now()->format('Ymd_His').'.pdf');
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
