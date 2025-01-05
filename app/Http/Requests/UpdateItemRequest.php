<?php

namespace App\Http\Requests;

use App\Models\Attribute;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:1|max:4294967295',
            'kilometer' => 'required|numeric|min:1|max:4294967295',
            'description' => 'nullable|string|min:3',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'neighborhood_id' => 'required|exists:neighborhoods,id',
            'attributes' => 'array',
            'attributes.*.id' => 'nullable|exists:item_attributes,id',
            'attributes.*.attribute_id' => 'nullable|exists:attributes,id',
            'attributes.*.value' => 'nullable',
            'photos' => 'array|max:15',
            'photos.*.id' => 'nullable|exists:item_photos,id',
            'photos.*.file' => 'nullable',
            'photos.*.order' => 'nullable|integer',
        ];

        $attributes = Attribute::all();
        $values = $this->get('attributes');

        if (!empty($values)) {
            foreach ($values as $index => $value) {
                $attribute = $attributes->find($value['attribute_id']);
                if ($attribute->required) {
                    $rules["attributes.{$index}.value"] = 'required';
                }
            }
        }

        return $rules;
    }
}
