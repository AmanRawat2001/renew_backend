<?php

namespace App\Http\Requests\ContentSection;

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
            'section_key' => 'required|string|unique:content_sections,section_key|max:255',
            'title' => 'required|string|max:500',
            'subtitle' => 'nullable|string|max:500',
            'description' => 'required|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'section_key.required' => 'Section key is required',
            'section_key.unique' => 'This section key already exists',
            'section_key.string' => 'Section key must be a string',
            'section_key.max' => 'Section key cannot exceed 255 characters',
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
