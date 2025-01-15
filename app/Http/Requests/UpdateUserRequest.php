<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use libphonenumber\PhoneNumberFormat;

class UpdateUserRequest extends FormRequest
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
        /** @var User $user */
        $user = $this->route('user');

        try {
            if ($phone = $this->input('phone')) {
                $this->merge(['phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }

            if ($phone = $this->input('company_phone')) {
                $this->merge(['company_phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }
        } catch (\Throwable $th) {
        }

        $profile_id = $user->profile ? $user->profile->id : 0;

        return [
            'username' => "nullable|string|min:3|max:255|unique:users,username,{$user->id}",
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'phone' => "required|phone:TR|unique:users,phone,{$user->id}",
            'password' => ['nullable', 'confirmed', new Password(5)],
            'name' => 'required|string|min:3|max:255',
            'surname' => 'required|string|min:3|max:255',
            'company' => 'nullable|string|min:3|max:255',
            'company_phone' => 'nullable|phone:TR',
            'address' => 'nullable|string|min:3|max:255',
            'tax_identity' => "nullable|string|min:3|max:255|unique:profiles,tax_identity,{$profile_id}",
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'role_id' => 'nullable|exists:roles,id',
        ];
    }
}
