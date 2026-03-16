<?php

namespace App\Http\Requests\MissionSlider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'required|string',
            'external_link' => 'nullable|url',
            'sequence' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
