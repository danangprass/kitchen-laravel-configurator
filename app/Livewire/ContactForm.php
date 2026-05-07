<?php

namespace App\Livewire;

use App\Models\Inquiry;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * CSRF protection is handled natively by Livewire — every component request
 * includes a signed checksum, so no separate CSRF token is needed here.
 */
class ContactForm extends Component
{
    public const ALLOWED_CATEGORIES = [
        'Sales Support',
        'Service Support',
        'Cooking Support',
        'General Inquiry',
    ];

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
            'category' => ['required', 'in:'.implode(',', self::ALLOWED_CATEGORIES)],
            'message' => ['required', 'string'],
        ];
    }

    public function selectCategory(string $category): void
    {
        if (! in_array($category, self::ALLOWED_CATEGORIES, true)) {
            return;
        }

        $this->category = $category;
    }

    public function submit(): void
    {
        $this->ensureIsNotRateLimited();

        $validated = $this->validate();

        Inquiry::create($validated);

        RateLimiter::hit($this->throttleKey());

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'company', 'country', 'category', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form')
            ->layout('layouts.app');
    }

    /**
     * Throttle submissions — max 3 per minute per IP + email combination.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 3)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());

            $this->addError('email', trans('auth.throttle', ['seconds' => $seconds]));

            throw new ValidationException(
                validator: validator([], []),
                response: null,
                errorBag: $this->getErrorBag(),
            );
        }
    }

    protected function throttleKey(): string
    {
        return mb_strtolower($this->email).'|'.request()->ip();
    }
}
