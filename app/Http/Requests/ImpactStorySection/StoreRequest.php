<?php

namespace App\Http\Requests\ImpactStorySection;

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

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'main_image' => 'required|image',
            'sort_order' => 'required|integer|min:0',
            'status' => 'boolean',
            'page' => ['required', new Enum(SitePage::class)],
        ];
    }
}
