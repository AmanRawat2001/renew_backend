<?php

namespace App\Http\Requests\MissionSlider;

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
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'external_link' => 'nullable|url',
            'sequence' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
