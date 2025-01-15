<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'site_title' => 'required|string',
            'site_description' => 'required|string|max:511',
            'whatsapp_number' => 'required|phone:TR',
            'logo_default' => 'nullable|max:5120',
            'logo_favicon' => 'nullable|max:1024',
            'logo_dark' => 'nullable|max:5120',
            'logo_icon' => 'nullable|max:5120',
            'footer_description' => 'required|string|max:511',
            'footer_copyright' => 'required|string',
            'footer_end' => 'required|string',
        ];
    }
}
