<?php

namespace App\Http\Requests;

use App\Enums\Fuel;
use App\Enums\Gear;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreVehicleRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'active' => 'nullable|boolean',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'stock_code' => 'nullable|string|max:255',
            'year' => 'required|integer|max:9999',
            'series' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'submodel' => 'nullable|string|max:255',
            'gear' => ['required', new Enum(Gear::class)],
            'fuel' => ['required', new Enum(Fuel::class)],
            'engine_power' => 'required|integer|max:9999',
            'engine_size' => 'required|integer|max:9999',
        ];
    }
}
