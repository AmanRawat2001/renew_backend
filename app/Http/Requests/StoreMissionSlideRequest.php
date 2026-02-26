<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMissionSlideRequest extends FormRequest
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
            'sequence' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
