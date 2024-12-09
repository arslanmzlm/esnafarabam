<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemAttributeRequest extends FormRequest
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
            'values' => 'required|array',
            'values.*.id' => 'nullable|exists:vehicle_attributes,id',
            'values.*.attribute_id' => 'required|exists:attributes,id',
            'values.*.value' => 'nullable',
        ];
    }
}
