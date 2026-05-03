<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:products,slug'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'description' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'max:100'],
            'panel' => ['nullable', 'string', 'max:100'],
            'power_supply' => ['nullable', 'string', 'max:100'],
            'width' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'depth' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'height' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'weight' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'number_of_trays' => ['nullable', 'integer'],
            'tray_size' => ['nullable', 'string', 'max:50'],
            'distance_between_trays' => ['nullable', 'integer'],
            'voltage' => ['nullable', 'string', 'max:100'],
            'electric_power' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'frequency' => ['nullable', 'string', 'max:50'],
            'consumption_kwh' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'co2_emission' => ['nullable', 'numeric', 'between:-999999.99,999999.99'],
            'energy_star_certified' => ['required'],
            'price' => ['nullable', 'numeric', 'between:-9999999999.99,9999999999.99'],
            'is_active' => ['required'],
            'sort_order' => ['required', 'integer'],
        ];
    }
}
