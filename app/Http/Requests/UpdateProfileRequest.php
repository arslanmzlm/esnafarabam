<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use libphonenumber\PhoneNumberFormat;

class UpdateProfileRequest extends FormRequest
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
        $user = $this->user();

        try {
            if ($phone = $this->input('company_phone')) {
                $this->merge(['company_phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }
        } catch (\Throwable $th) {
        }

        $profile_id = $user->profile ? $user->profile->id : 0;

        return [
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'company' => 'nullable|string|min:3|max:255',
            'company_phone' => 'nullable|phone:TR',
            'address' => 'nullable|string|min:3|max:255',
            'tax_identity' => "nullable|string|min:3|max:255|unique:profiles,tax_identity,{$profile_id}",
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
        ];
    }
}
