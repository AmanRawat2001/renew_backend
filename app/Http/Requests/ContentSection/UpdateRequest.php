<?php

namespace App\Http\Requests\ContentSection;

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
            'subtitle' => 'nullable|string|max:500',
            'description' => 'required|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'title.max' => 'Title cannot exceed 500 characters',
            'subtitle.string' => 'Subtitle must be a string',
            'subtitle.max' => 'Subtitle cannot exceed 500 characters',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'description.max' => 'Description cannot exceed 5000 characters',
        ];
    }
}
