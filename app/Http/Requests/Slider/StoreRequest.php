<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:1000',
            'sub_title' => 'required|string|max:1000',
            'image' => 'image|required',
            'sequence' => 'required|integer|min:1|max:999',
            'is_active' => 'nullable|boolean',
        ];
    }
}
