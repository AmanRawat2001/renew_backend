<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MissionSlider\StoreRequest;
use App\Http\Requests\MissionSlider\UpdateRequest;
use App\Models\MissionSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InternalMissionSlideController extends Controller
{
    public function index(): View
    {
        $slides = MissionSlide::where('page', '!=', SitePage::HOME->value)->ordered()->paginate(12);

        return view('pages.admin.program.other_mission_sliders.index', compact('slides'));
    }

    public function create(): View
    {
        return view('pages.admin.program.other_mission_sliders.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('mission_sliders', 'public');
        }
        $validated['page'] = $request->input('page', SitePage::HOME->value);
        MissionSlide::create($validated);

        return redirect()->route('admin.other_mission_sliders.index')->with('success', 'Mission slide created successfully');
    }

    public function edit(MissionSlide $other_mission_slider): View
    {
        return view('pages.admin.program.other_mission_sliders.edit', compact('other_mission_slider'));
    }

    public function update(UpdateRequest $request, MissionSlide $other_mission_slider): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($other_mission_slider->image && Storage::disk('public')->exists($other_mission_slider->image)) {
                Storage::disk('public')->delete($other_mission_slider->image);
            }
            $validated['image'] = $request->file('image')->store('other_mission_sliders', 'public');
        } else {
            // If no new image, remove it from validated array to keep existing
            unset($validated['image']);
        }
        $validated['page'] = $request->input('page', SitePage::HOME->value);

        $other_mission_slider->update($validated);

        return redirect()->route('admin.other_mission_sliders.index')->with('success', 'Mission slide updated successfully');
    }
}
