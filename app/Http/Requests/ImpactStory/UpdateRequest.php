<?php

namespace App\Http\Requests\ImpactStory;

use App\Enums\SitePage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;


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
            'name' => 'string|max:255',
            'designation' => 'string|max:255',
            'location' => 'string|max:255',
            'image' => 'nullable|image',
            'description' => 'string',
            'page' => ['required', new Enum(SitePage::class)],
            'sort_order' => 'integer|min:0',
            'status' => 'boolean',
        ];
    }
}
