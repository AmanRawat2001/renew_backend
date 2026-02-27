<?php

namespace App\Http\Controllers\Admin\EmpoweringLives;

use App\Enums\SliderPage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainSlider\StoreRequest;
use App\Http\Requests\MainSlider\UpdateRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MainSliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('page', SliderPage::EMPOWERING_LIVES->value)->ordered()->paginate(12);

        return view('pages.admin.main_sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('pages.admin.main_sliders.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('main_sliders', 'public');
        }
        $validated['page'] = SliderPage::EMPOWERING_LIVES->value;
        Slider::create($validated);

        return redirect()->route('admin.main_sliders.index')->with('success', 'Slider created successfully');
    }

    public function edit(Slider $main_slider): View
    {
        return view('pages.admin.main_sliders.edit', compact('main_slider'));
    }

    public function update(UpdateRequest $request, Slider $main_slider): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($main_slider->image) {
                Storage::disk('public')->delete($main_slider->image);
            }
            $validated['image'] = $request->file('image')->store('main_sliders', 'public');
        }

        $validated['page'] = SliderPage::EMPOWERING_LIVES->value;
        $main_slider->update($validated);

        return redirect()->route('admin.main_sliders.index')->with('success', 'Slider updated successfully');
    }
}
