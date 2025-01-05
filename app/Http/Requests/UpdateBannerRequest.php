<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'alt_title' => 'nullable|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'link_label' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:5120',
            'mobile_image' => 'nullable|image|max:5120',
            'alt' => 'nullable|string|max:255',
            'options' => 'nullable|array',
        ];
    }
}
