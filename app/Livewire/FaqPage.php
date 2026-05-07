<?php

namespace App\Livewire;

use App\Models\Faq;
use Livewire\Component;

class FaqPage extends Component
{
    public string $searchQuery = '';

    public string $activeCategory = 'All';

    public array $expandedFaqs = [];

    public function toggleFaq(int $faqId): void
    {
        if (in_array($faqId, $this->expandedFaqs, true)) {
            $this->expandedFaqs = array_values(array_diff($this->expandedFaqs, [$faqId]));
        } else {
            $this->expandedFaqs[] = $faqId;
        }
    }

    public function setCategory(string $category): void
    {
        $allowedCategories = ['All', 'Products', 'Ordering', 'Shipping', 'Warranty', 'General'];

        if (! in_array($category, $allowedCategories, true)) {
            return;
        }

        $this->activeCategory = $category;
        $this->expandedFaqs = [];
    }

    public function updatingSearchQuery(): void
    {
        $this->expandedFaqs = [];
    }

    public function render()
    {
        $categories = ['All', 'Products', 'Ordering', 'Shipping', 'Warranty', 'General'];

        $faqs = Faq::query()
            ->active()
            ->when($this->activeCategory !== 'All', function ($query) {
                $query->byCategory($this->activeCategory);
            })
            ->when($this->searchQuery !== '', function ($query) {
                $escapedSearch = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $this->searchQuery);

                $query->where(function ($q) use ($escapedSearch) {
                    $q->where('question', 'like', '%'.$escapedSearch.'%')
                        ->orWhere('answer', 'like', '%'.$escapedSearch.'%');
                });
            })
            ->orderBy('sort_order')
            ->get();

        return view('livewire.faq-page', compact('faqs', 'categories'))
            ->layout('layouts.home');
    }
}
