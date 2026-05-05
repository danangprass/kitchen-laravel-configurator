<?php

namespace App\Livewire;

use App\Models\HomepageSection;
use Livewire\Component;

class HomePage extends Component
{
    public $sections;

    public function mount()
    {
        $this->sections = HomepageSection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.home');
    }
}
