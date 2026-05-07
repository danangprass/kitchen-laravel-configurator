<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialsPage extends Component
{
    public $featuredTestimonials;

    public $testimonials;

    public $industries;

    public $selectedIndustry = '';

    public $submitForm = false;

    public $submitName = '';

    public $submitCompany = '';

    public $submitQuote = '';

    public $submitRating = 5;

    public $submitted = false;

    public function mount()
    {
        $this->loadTestimonials();
        $this->industries = Testimonial::query()
            ->active()
            ->whereNotNull('industry')
            ->distinct()
            ->orderBy('industry')
            ->pluck('industry');
    }

    public function selectIndustry(string $industry): void
    {
        $this->selectedIndustry = $industry;
        $this->loadTestimonials();
    }

    public function updatedSelectedIndustry()
    {
        $this->loadTestimonials();
    }

    public function toggleSubmitForm()
    {
        $this->submitForm = ! $this->submitForm;
        $this->resetSubmitForm();
    }

    public function submitTestimonial()
    {
        $this->validate([
            'submitName' => 'required|max:255',
            'submitCompany' => 'nullable|max:255',
            'submitQuote' => 'required|min:20|max:1000',
            'submitRating' => 'required|integer|between:1,5',
        ]);

        Testimonial::create([
            'customer_name' => $this->submitName,
            'company' => $this->submitCompany,
            'quote' => strip_tags($this->submitQuote),
            'rating' => $this->submitRating,
            'is_active' => false,
        ]);

        $this->submitted = true;
        $this->submitForm = false;
    }

    public function render()
    {
        return view('livewire.testimonials-page')
            ->layout('layouts.home');
    }

    private function loadTestimonials(): void
    {
        $query = Testimonial::query()->active()->orderBy('sort_order');

        if ($this->selectedIndustry) {
            $query->where('industry', $this->selectedIndustry);
        }

        $this->featuredTestimonials = (clone $query)->featured()->get();
        $this->testimonials = (clone $query)
            ->where('is_featured', false)
            ->get();
    }

    private function resetSubmitForm(): void
    {
        $this->submitName = '';
        $this->submitCompany = '';
        $this->submitQuote = '';
        $this->submitRating = 5;
        $this->submitted = false;
    }
}
