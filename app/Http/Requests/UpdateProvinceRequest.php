<?php

namespace App\Http\Requests;

use App\Models\Province;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProvinceRequest extends FormRequest
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
        /** @var Province $province */
        $province = $this->route('province');

        return [
            'name' => 'required|string|max:255',
            'code' => "required|integer|between:0,255|unique:provinces,code,{$province->id}",
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ];
    }
}
