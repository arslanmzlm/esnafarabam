<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberFormat;

class RegisterRequest extends FormRequest
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
        } catch (\Throwable $th) {
        }

        return [
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:3|max:255|unique:users,email',
            'phone' => 'required|phone:TR|unique:users,phone',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'tax_identity' => 'required|string|min:3|max:255|unique:profiles,tax_identity',
            'password' => ['required', 'confirmed', new Password(5)],
        ];
    }
}
