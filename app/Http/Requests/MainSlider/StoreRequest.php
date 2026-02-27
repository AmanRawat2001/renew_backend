<?php

namespace App\Http\Requests\MainSlider;

use App\Enums\SliderPage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'image' => 'required|image',
            'page' => 'required' | Rule::in(array_column(SliderPage::cases(), 'value')),
            'sequence' => 'required|integer|min:1|max:999',
            'is_active' => 'nullable|boolean',
        ];
    }
}
