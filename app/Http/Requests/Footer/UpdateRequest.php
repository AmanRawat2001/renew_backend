<?php

namespace App\Http\Requests\Footer;

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
            'key' => 'required|string|unique:footers,key,' . $this->footer->id . '|max:255',
            'value' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sequence' => 'required|integer|min:0|max:999',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'key.unique' => 'This key already exists. Please use a unique key.',
            'key.required' => 'The key field is required.',
            'sequence.required' => 'The sequence field is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 5MB.',
        ];
    }
}
