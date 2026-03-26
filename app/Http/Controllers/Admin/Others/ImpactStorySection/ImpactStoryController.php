<?php

namespace App\Http\Controllers\Admin\Others\ImpactStorySection;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImpactStory\StoreRequest;
use App\Http\Requests\ImpactStory\UpdateRequest;
use App\Models\ImpactStory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ImpactStoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $stories = ImpactStory::orderBy('sort_order', 'asc')->paginate(10);

        return view('pages.admin.impact_story_sections.stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.impact_story_sections.stories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('impact_stories', 'public');
        }

        ImpactStory::create($validated);

        return redirect()->route('admin.impact_stories.index')->with('success', 'Impact story created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImpactStory $impact_story): View
    {
        return view('pages.admin.impact_story_sections.stories.edit', compact('impact_story'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ImpactStory $impact_story): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($impact_story->image) {
                Storage::disk('public')->delete($impact_story->image);
            }
            $validated['image'] = $request->file('image')->store('impact_stories', 'public');
        }

        $impact_story->update($validated);

        return redirect()->route('admin.impact_stories.index')->with('success', 'Impact story updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImpactStory $impact_story): RedirectResponse
    {
        if ($impact_story->image && Storage::disk('public')->exists($impact_story->image)) {
            Storage::disk('public')->delete($impact_story->image);
        }

        $impact_story->delete();

        return redirect()->route('admin.impact_stories.index')->with('success', 'Impact story deleted successfully');
    }
}
