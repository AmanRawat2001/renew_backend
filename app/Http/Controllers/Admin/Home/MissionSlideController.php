<?php

namespace App\Http\Controllers\Admin\Home;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MissionSlider\StoreRequest;
use App\Http\Requests\MissionSlider\UpdateRequest;
use App\Models\MissionSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MissionSlideController extends Controller
{
    public function index(): View
    {
        $slides = MissionSlide::where('page', SitePage::HOME->value)->ordered()->paginate(12);

        return view('pages.admin.home.mission_slider.index', compact('slides'));
    }

    public function create(): View
    {
        return view('pages.admin.home.mission_slider.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('mission_sliders', 'public');
        }

        MissionSlide::create($validated);

        return redirect()->route('admin.mission_sliders.index')->with('success', 'Mission slide created successfully');
    }

    public function edit(MissionSlide $mission_slider): View
    {
        return view('pages.admin.home.mission_slider.edit', compact('mission_slider'));
    }

    public function update(UpdateRequest $request, MissionSlide $mission_slider): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($mission_slider->image && Storage::disk('public')->exists($mission_slider->image)) {
                Storage::disk('public')->delete($mission_slider->image);
            }
            $validated['image'] = $request->file('image')->store('mission_sliders', 'public');
        } else {
            // If no new image, remove it from validated array to keep existing
            unset($validated['image']);
        }
        $validated['page'] = SitePage::HOME->value;
        $mission_slider->update($validated);

        return redirect()->route('admin.mission_sliders.index')->with('success', 'Mission slide updated successfully');
    }
}
