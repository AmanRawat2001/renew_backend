<?php

namespace App\Http\Controllers\Admin\Others\ImpactStorySection;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImpactStorySection\StoreRequest;
use App\Http\Requests\ImpactStorySection\UpdateRequest;
use App\Models\ImpactStorySection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImpactStorySectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sections = ImpactStorySection::orderBy('page', 'asc')->paginate(10);

        return view('pages.admin.impact_story_sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.admin.impact_story_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ImpactStorySection::create($validated);

        return redirect()->route('admin.impact_story_sections.index')->with('success', 'Impact story section created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImpactStorySection $impact_story_section): View
    {
        return view('pages.admin.impact_story_sections.edit', compact('impact_story_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ImpactStorySection $impact_story_section): RedirectResponse
    {
        $validated = $request->validated();

        $impact_story_section->update($validated);

        return redirect()->route('admin.impact_story_sections.index')->with('success', 'Impact story section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImpactStorySection $impact_story_section): RedirectResponse
    {
        $impact_story_section->delete();

        return redirect()->route('admin.impact_story_sections.index')->with('success', 'Impact story section deleted successfully');
    }
}
