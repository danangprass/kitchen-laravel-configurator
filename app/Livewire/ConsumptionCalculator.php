<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Component;

class ConsumptionCalculator extends Component
{
    public int $step = 1;

    /** @var int[] */
    public array $selectedProductIds = [];

    public string $usageMode = 'medium';

    public string $energySource = 'electric';

    private const USAGE_HOURS = [
        'light' => 4,
        'medium' => 8,
        'heavy' => 12,
    ];

    private const ENERGY_COST_PER_KWH = [
        'electric' => 0.12,
        'gas' => 0.08,
    ];

    private const MAX_SELECTIONS = 4;

    public function mount(): void
    {
        $this->step = 1;
    }

    public function toggleProduct(int $id): void
    {
        if (in_array($id, $this->selectedProductIds, true)) {
            $this->selectedProductIds = array_values(array_diff($this->selectedProductIds, [$id]));
        } elseif (count($this->selectedProductIds) < self::MAX_SELECTIONS) {
            $this->selectedProductIds[] = $id;
        }
    }

    public function removeProduct(int $id): void
    {
        $this->selectedProductIds = array_values(array_diff($this->selectedProductIds, [$id]));
    }

    public function nextStep(): void
    {
        if ($this->step < 4) {
            $this->step++;
        }
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step >= 1 && $step <= 4) {
            $this->step = $step;
        }
    }

    public function restart(): void
    {
        $this->step = 1;
        $this->selectedProductIds = [];
        $this->usageMode = 'medium';
        $this->energySource = 'electric';
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductsProperty(): Collection
    {
        return Product::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * @return Collection<int, Product>
     */
    public function getSelectedProductsProperty(): Collection
    {
        return Product::whereIn('id', $this->selectedProductIds)
            ->orderBy('sort_order')
            ->get();
    }

    public function getHoursPerDayProperty(): int
    {
        return self::USAGE_HOURS[$this->usageMode] ?? 8;
    }

    public function getCostPerKwhProperty(): float
    {
        return self::ENERGY_COST_PER_KWH[$this->energySource] ?? 0.12;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getResultsProperty(): array
    {
        $hoursPerDay = $this->hoursPerDay;
        $costPerKwh = $this->costPerKwh;
        $results = [];

        foreach ($this->selectedProducts as $product) {
            $kwhPerDay = $this->calculateKwhPerDay($product, $hoursPerDay);
            $co2PerDay = $this->calculateCo2PerDay($product, $kwhPerDay);
            $monthlyCost = $this->calculateMonthlyCost($kwhPerDay, $costPerKwh);

            $results[] = [
                'product' => $product,
                'kwh_per_day' => round($kwhPerDay, 2),
                'co2_per_day' => round($co2PerDay, 2),
                'monthly_cost' => round($monthlyCost, 2),
                'hours_per_day' => $hoursPerDay,
                'cost_per_kwh' => $costPerKwh,
                'energy_source' => $this->energySource,
            ];
        }

        return $results;
    }

    private function calculateKwhPerDay(Product $product, int $hoursPerDay): float
    {
        if ($this->energySource === 'electric') {
            $baseKwh = (float) ($product->consumption_kwh ?? $product->electric_power ?? 0);

            return $baseKwh * $hoursPerDay;
        }

        $gasKw = (float) ($product->max_gas_power ?? $product->electric_power ?? 0);

        return $gasKw * $hoursPerDay;
    }

    private function calculateCo2PerDay(Product $product, float $kwhPerDay): float
    {
        $co2PerKwh = (float) ($product->co2_emission ?? 0);

        return $co2PerKwh * $kwhPerDay;
    }

    private function calculateMonthlyCost(float $kwhPerDay, float $costPerKwh): float
    {
        return $kwhPerDay * 30 * $costPerKwh;
    }

    public function render()
    {
        return view('livewire.consumption-calculator', [
            'usageModeLabels' => [
                'light' => 'Light (4 hrs/day)',
                'medium' => 'Medium (8 hrs/day)',
                'heavy' => 'Heavy (12 hrs/day)',
            ],
            'energySourceLabels' => [
                'electric' => 'Electric ($0.12/kWh)',
                'gas' => 'Gas ($0.08/kWh)',
            ],
        ])->layout('layouts.app');
    }
}
