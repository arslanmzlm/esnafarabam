<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
        /** @var Brand $brand */
        $brand = $this->route('brand');

        return [
            'active' => 'nullable|boolean',
            'name' => "required|string|max:255|unique:brands,name,{$brand->id}",
            'title' => "required|string|max:255|unique:brands,title,{$brand->id}",
            'slug' => "nullable|string|max:255|unique:brands,slug,{$brand->id}",
            'logo' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
        ];
    }
}
