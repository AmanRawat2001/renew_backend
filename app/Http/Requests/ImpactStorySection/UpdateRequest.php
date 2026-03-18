<?php

namespace App\Http\Requests\ImpactStorySection;

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
            'title' => 'string|max:255',
            'external_url' => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
            'status' => 'boolean',
            'page' => ['required', new Enum(SitePage::class)],
        ];
    }
}
