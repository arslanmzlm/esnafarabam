<?php

namespace App\Http\Requests;

use App\Enums\StepType;
use App\Models\VehicleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateVehicleTypeRequest extends FormRequest
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
        /** @var VehicleType $vehicleType */
        $vehicleType = $this->route('vehicleType');

        return [
            'active' => 'nullable|boolean',
            'name' => "required|string|max:255|unique:vehicle_types,name,{$vehicleType->id}",
            'title' => "required|string|max:255|unique:vehicle_types,title,{$vehicleType->id}",
            'slug' => "nullable|string|max:255|unique:vehicle_types,slug,{$vehicleType->id}",
            'logo' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'step_type' => ['required', new Enum(StepType::class)],
        ];
    }
}
