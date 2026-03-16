<?php

namespace App\Http\Requests\ImpactStory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_id' => 'exists:impact_story_sections,id',
            'name' => 'string|max:255',
            'designation' => 'string|max:255',
            'location' => 'string|max:255',
            'description' => 'string',
            'sort_order' => 'integer|min:0',
            'status' => 'boolean',
        ];
    }
}
