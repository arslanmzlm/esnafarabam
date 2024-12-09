<?php

namespace App\Http\Requests;

use App\Enums\ItemState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class EvaluateItemRequest extends FormRequest
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
            'state' => ['required', new Enum(ItemState::class)],
            'note' => 'nullable|string',
            'approved_photos' => 'array',
            'approved_photos.*' => 'exists:item_photos,id',
            'rejected_photos' => 'array',
            'rejected_photos.*' => 'exists:item_photos,id',
            'deleted_photos' => 'array',
            'deleted_photos.*' => 'exists:item_photos,id',
        ];
    }
}
