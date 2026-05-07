<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingForm extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $company_name = '';

    public string $address = '';

    public string $preferred_date_start = '';

    public string $preferred_date_end = '';

    public string $oven_interest = '';

    public int|string $meals_per_day = '';

    public bool $submitted = false;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'preferred_date_start' => ['required', 'date'],
            'preferred_date_end' => ['required', 'date', 'after_or_equal:preferred_date_start'],
            'oven_interest' => ['required', 'string', 'max:255'],
            'meals_per_day' => ['required', 'integer', 'min:1'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();

        Booking::create($validated);

        session()->flash('booking_submitted', true);
        $this->submitted = true;
        $this->resetExcept('submitted');
    }

    public function render()
    {
        return view('livewire.booking-form')
            ->layout('layouts.home');
    }
}
