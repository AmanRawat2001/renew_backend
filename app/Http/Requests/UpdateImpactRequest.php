<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImpactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'metric_number' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sequence' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
