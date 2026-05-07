<?php

namespace App\Livewire;

use App\Models\Dealer;
use Livewire\Component;

class DealerLocator extends Component
{
    public string $typeFilter = '';

    public string $levelFilter = '';

    public function getDealersProperty()
    {
        return Dealer::query()
            ->where('is_active', true)
            ->when($this->typeFilter, fn ($q) => $q->where('type', $this->typeFilter))
            ->when($this->levelFilter, fn ($q) => $q->where('service_level', $this->levelFilter))
            ->orderBy('name')
            ->get();
    }

    public function getDealerTypesProperty(): array
    {
        return Dealer::types();
    }

    public function getServiceLevelsProperty(): array
    {
        return Dealer::serviceLevels();
    }

    public function updatedTypeFilter(): void
    {
        $this->dispatch('filters-updated');
    }

    public function updatedLevelFilter(): void
    {
        $this->dispatch('filters-updated');
    }

    public function resetFilters(): void
    {
        $this->typeFilter = '';
        $this->levelFilter = '';
        $this->dispatch('filters-updated');
    }

    public function render()
    {
        return view('livewire.dealer-locator', [
            'dealers' => $this->dealers,
        ]);
    }
}
