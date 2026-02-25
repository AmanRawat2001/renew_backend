<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'sequence' => 'required|integer|min:1|max:999',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title cannot exceed 1000 characters',
            'sub_title.required' => 'Description is required',
            'sub_title.string' => 'Description must be a string',
            'sub_title.max' => 'Description cannot exceed 1000 characters',
            'sequence.required' => 'Sequence is required',
            'sequence.integer' => 'Sequence must be a number',
            'sequence.min' => 'Sequence must be at least 1',
            'sequence.max' => 'Sequence cannot exceed 999',
            'is_active.boolean' => 'Active status must be true or false',
        ];
    }
}
