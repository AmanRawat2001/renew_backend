<?php

namespace App\Http\Requests\FeatureCard;

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
            'title' => 'required|string|max:500',
            'description' => 'required|string|max:1000',
            'sequence' => 'required|integer|min:0|max:999',
            'is_active' => 'nullable|boolean',
        ];
    }
}
