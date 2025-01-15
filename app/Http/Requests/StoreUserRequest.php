<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberFormat;

class StoreUserRequest extends FormRequest
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
        try {
            if ($phone = $this->input('phone')) {
                $this->merge(['phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }

            if ($phone = $this->input('company_phone')) {
                $this->merge(['company_phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }
        } catch (\Throwable $th) {
        }

        return [
            'username' => 'nullable|string|min:3|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|phone:TR|unique:users,phone',
            'password' => ['required', 'confirmed', new Password(5)],
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'company' => 'nullable|string|min:3|max:255',
            'company_phone' => 'nullable|phone:TR',
            'address' => 'nullable|string|min:3|max:255',
            'tax_identity' => 'nullable|string|min:3|max:255|unique:profiles,tax_identity',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }
}
