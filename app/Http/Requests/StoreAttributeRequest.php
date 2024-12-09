<?php

namespace App\Http\Requests;

use App\Enums\AttributeInput;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreAttributeRequest extends FormRequest
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
            'attribute_category_id' => 'required|exists:attribute_categories,id',
            'input' => ['required', new Enum(AttributeInput::class)],
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'values' => 'nullable|array',
            'values.*.id' => 'nullable|exists:attribute_values,id',
            'values.*.value' => 'required|string|max:255',
            'required' => 'nullable|boolean',
        ];
    }
}
