<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ProductComparator extends Component
{
    public bool $showOnlyDifferences = false;

    /** @var int[] */
    public array $comparedProductIds = [];

    public function mount(): void
    {
        $this->comparedProductIds = session()->get('compared_product_ids', []);
    }

    public function toggleDifferences(): void
    {
        $this->showOnlyDifferences = ! $this->showOnlyDifferences;
    }

    public function removeFromCompare(int $productId): void
    {
        $ids = session()->get('compared_product_ids', []);
        $ids = array_values(array_filter($ids, fn (int $id) => $id !== $productId));
        session()->put('compared_product_ids', $ids);
        $this->comparedProductIds = $ids;
    }

    public function clearCompare(): void
    {
        session()->put('compared_product_ids', []);
        $this->comparedProductIds = [];
    }

    public function addToCompare(int $productId): void
    {
        $ids = session()->get('compared_product_ids', []);

        if (in_array($productId, $ids, true)) {
            return;
        }

        if (count($ids) >= 3) {
            return;
        }

        $ids[] = $productId;
        session()->put('compared_product_ids', $ids);
        $this->comparedProductIds = $ids;
    }

    public function getProductsProperty(): Collection
    {
        if (empty($this->comparedProductIds)) {
            return collect();
        }

        return Product::whereIn('id', $this->comparedProductIds)
            ->where('is_active', true)
            ->orderByRaw('CASE id '.implode(' ', array_map(
                fn (int $id, int $i) => "WHEN {$id} THEN {$i}",
                $this->comparedProductIds,
                array_keys($this->comparedProductIds),
            )).' END')
            ->get();
    }

    /** @return array<int, array{label: string, values: array<int, string>, allSame: bool}> */
    public function getSpecRowsProperty(): array
    {
        $products = $this->products;

        if ($products->isEmpty()) {
            return [];
        }

        $rows = [
            $this->buildRow('Name', $products, fn (Product $p) => $p->name),
            $this->buildRow('Line', $products, fn (Product $p) => $p->line),
            $this->buildRow('Tray Type', $products, fn (Product $p) => $p->tray_size),
            $this->buildRow('Tray Count', $products, fn (Product $p) => $p->number_of_trays),
            $this->buildRow('Power Supply', $products, fn (Product $p) => ucfirst((string) $p->power_supply)),
            $this->buildRow('Electric Power', $products, fn (Product $p) => $this->formatValue($p->electric_power, 'kW')),
            $this->buildRow('Consumption', $products, fn (Product $p) => $this->formatValue($p->consumption_kwh, 'kWh')),
            $this->buildRow('CO2 Emission', $products, fn (Product $p) => $this->formatValue($p->co2_emission, 'kg/h')),
            $this->buildRow('Width', $products, fn (Product $p) => $this->formatValue($p->width, 'mm')),
            $this->buildRow('Depth', $products, fn (Product $p) => $this->formatValue($p->depth, 'mm')),
            $this->buildRow('Height', $products, fn (Product $p) => $this->formatValue($p->height, 'mm')),
            $this->buildRow('Weight', $products, fn (Product $p) => $this->formatValue($p->weight, 'kg')),
            $this->buildRow('Energy Star', $products, fn (Product $p) => $p->energy_star_certified ? 'Yes' : 'No'),
            $this->buildRow('Digital Interface', $products, fn (Product $p) => ucfirst((string) ($p->panel ?: $p->control_type))),
        ];

        if ($this->showOnlyDifferences) {
            $rows = array_filter($rows, fn (array $row) => ! $row['allSame']);
        }

        return array_values($rows);
    }

    public function render()
    {
        return view('livewire.product-comparator')
            ->layout('layouts.app', ['title' => 'Compare Ovens']);
    }

    /**
     * @return array{label: string, values: array<int, string>, allSame: bool}
     */
    private function buildRow(string $label, Collection $products, callable $extractor): array
    {
        $values = $products->map($extractor)->map(fn ($v) => $v !== null && $v !== '' ? (string) $v : '--')->values()->toArray();

        return [
            'label' => $label,
            'values' => $values,
            'allSame' => count(array_unique($values)) === 1,
        ];
    }

    private function formatValue(mixed $value, string $unit): string
    {
        if ($value === null || $value === '' || $value === 0 || $value === '0') {
            return '--';
        }

        return number_format((float) $value, 2).' '.$unit;
    }
}
