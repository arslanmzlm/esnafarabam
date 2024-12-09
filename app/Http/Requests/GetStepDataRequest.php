<?php

namespace App\Http\Requests;

use App\Enums\StepType;
use App\Models\VehicleType;
use Illuminate\Foundation\Http\FormRequest;

class GetStepDataRequest extends FormRequest
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
        $vehicleType = VehicleType::find($this->request->getInt('vehicle_type_id'));

        if ($vehicleType) {
            return match ($vehicleType->step_type) {
                StepType::BRAND => [
                    'vehicle_type_id' => 'nullable|required_with:brand_id,model|exists:vehicle_types,id',
                    'brand_id' => 'nullable|required_with:model|exists:brands,id',
                    'model' => 'nullable|exists:vehicles,model',
                ],
                default => [
                    'vehicle_type_id' => 'nullable|required_with:year,brand_id,series,model,submodel|exists:vehicle_types,id',
                    'year' => 'nullable|required_with:brand_id,series,model,submodel|exists:vehicles,year',
                    'brand_id' => 'nullable|required_with:series,model,submodel|exists:brands,id',
                    'series' => 'nullable|required_with:model,submodel|exists:vehicles,series',
                    'model' => 'nullable|required_with:submodel|exists:vehicles,model',
                    'submodel' => 'nullable|exists:vehicles,submodel',
                ],
            };
        }

        return [
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
        ];
    }
}
