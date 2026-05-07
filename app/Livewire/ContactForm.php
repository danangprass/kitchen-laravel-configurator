<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';

    public $email = '';

    public $phone = '';

    public $company = '';

    public $country = '';

    public $category = '';

    public $message = '';

    public $submitted = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'in:Sales Support,Service Support,Cooking Support,General Inquiry'],
            'message' => ['required', 'string'],
        ];
    }

    public function selectCategory(string $category): void
    {
        $this->category = $category;
    }

    public function submit(): void
    {
        $validated = $this->validate();

        Inquiry::create($validated);

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'company', 'country', 'category', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form')
            ->layout('layouts.app');
    }
}
