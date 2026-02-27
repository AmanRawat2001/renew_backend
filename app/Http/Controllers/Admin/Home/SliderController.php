<?php

namespace App\Http\Controllers\Admin\Home;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreRequest;
use App\Http\Requests\Slider\UpdateRequest;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::HOME->value)->ordered()->paginate(12);

        return view('pages.admin.home.slider.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('pages.admin.home.slider.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }
        $validated['page'] = SitePage::HOME->value;
        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully');
    }

    public function edit(Slider $slider): View
    {
        return view('pages.admin.home.slider.edit', compact('slider'));
    }

    public function update(UpdateRequest $request, Slider $slider): RedirectResponse
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['page'] = SitePage::HOME->value;
        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully');
    }
}
