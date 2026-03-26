<?php

namespace App\Http\Requests\ImpactStory;

use App\Enums\SitePage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'page' => ['required', new Enum(SitePage::class)],
            'sort_order' => 'required|integer|min:0',
            'status' => 'boolean',
        ];
    }
}
