<?php

namespace App\Http\Controllers\Admin\Home;

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
        $slides = MissionSlide::orderBy('sequence', 'asc')->paginate(12);

        return view('pages.admin.mission-slide.index', compact('slides'));
    }

    public function create(): View
    {
        return view('pages.admin.mission-slide.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('mission-slides', 'public');
        }

        MissionSlide::create($validated);

        return redirect()->route('admin.mission-slides.index')->with('success', 'Mission slide created successfully');
    }

    public function edit(MissionSlide $missionSlide): View
    {
        return view('pages.admin.mission-slide.edit', compact('missionSlide'));
    }

    public function update(UpdateRequest $request, MissionSlide $missionSlide): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($missionSlide->image && Storage::disk('public')->exists($missionSlide->image)) {
                Storage::disk('public')->delete($missionSlide->image);
            }
            $validated['image'] = $request->file('image')->store('mission-slides', 'public');
        } else {
            // If no new image, remove it from validated array to keep existing
            unset($validated['image']);
        }

        $missionSlide->update($validated);

        return redirect()->route('admin.mission-slides.index')->with('success', 'Mission slide updated successfully');
    }
}
