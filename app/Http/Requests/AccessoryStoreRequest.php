<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessoryStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:accessories,slug'],
            'sku' => ['required', 'string', 'max:100', 'unique:accessories,sku'],
            'description' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'accessory_type' => ['nullable', 'string', 'max:100'],
            'width' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'depth' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'height' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'weight' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'voltage' => ['nullable', 'string', 'max:100'],
            'electric_power' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'min_flow' => ['nullable', 'numeric', 'between:-99.99,99.99'],
            'max_flow' => ['nullable', 'numeric', 'between:-99.99,99.99'],
            'quantity' => ['required', 'integer'],
            'price' => ['nullable', 'numeric', 'between:-9999999999.99,9999999999.99'],
            'is_active' => ['required'],
            'sort_order' => ['required', 'integer'],
        ];
    }
}
