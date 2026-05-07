<?php

namespace App\Livewire;

use App\Models\HomepageSection;
use App\Models\NewsletterSubscriber;
use Livewire\Component;

class HomePage extends Component
{
    public $sections;

    public $email = '';

    public function mount()
    {
        $this->sections = HomepageSection::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function subscribe()
    {
        $this->validate(['email' => 'required|email']);

        NewsletterSubscriber::firstOrCreate(['email' => $this->email]);

        session()->flash('newsletter_subscribed', $this->email);
        $this->email = '';
    }

    public function render()
    {
        $allowedTypes = [
            'hero', 'product-slider', 'line-showcase', 'cta-banner',
            'value-props', 'blog-cards', 'newsletter', 'seo-text',
        ];

        return view('livewire.home-page', ['allowedTypes' => $allowedTypes])
            ->layout('layouts.home');
    }
}
