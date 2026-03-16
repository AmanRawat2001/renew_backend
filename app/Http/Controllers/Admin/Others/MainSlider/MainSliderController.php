<?php

namespace App\Http\Controllers\Admin\Others\MainSlider;

use App\Enums\SitePage;
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
        $query = Slider::where('page', '!=', SitePage::HOME->value);
        if (request()->filled('site_page')) {
            $query->where('page', request('site_page'));
        }
        $sliders = $query->ordered()->paginate(12)->withQueryString();

        return view('pages.admin.program.main_sliders.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('pages.admin.program.main_sliders.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('main_sliders', 'public');
        }
        Slider::create($validated);

        return redirect()->route('admin.main_sliders.index')->with('success', 'Slider created successfully');
    }

    public function edit(Slider $main_slider): View
    {
        return view('pages.admin.program.main_sliders.edit', compact('main_slider'));
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

        $main_slider->update($validated);

        return redirect()->route('admin.main_sliders.index')->with('success', 'Slider updated successfully');
    }
}
