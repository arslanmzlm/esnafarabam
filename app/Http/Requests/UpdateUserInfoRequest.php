<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use libphonenumber\PhoneNumberFormat;

class UpdateUserInfoRequest extends FormRequest
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
            if ($phone = $this->input('phone')) {
                $this->merge(['phone' => phone($phone, 'TR', PhoneNumberFormat::E164)]);
            }
        } catch (\Throwable $th) {
        }

        return [
            'username' => "nullable|string|min:3|max:255|unique:users,username,{$user->id}",
            'email' => "required|string|email|max:255|unique:users,email,{$user->id}",
            'phone' => "required|phone:TR|unique:users,phone,{$user->id}",
        ];
    }
}
