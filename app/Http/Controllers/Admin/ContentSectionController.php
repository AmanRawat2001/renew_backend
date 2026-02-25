<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContentSectionRequest;
use App\Http\Requests\UpdateContentSectionRequest;
use App\Models\ContentSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContentSectionController extends Controller
{
    public function index(): View
    {
        $sections = ContentSection::ordered()->paginate(10);

        return view('pages.admin.content-section.index', compact('sections'));
    }

    public function create(): View
    {
        return view('pages.admin.content-section.create');
    }

    public function store(StoreContentSectionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContentSection::create($validated);

        return redirect()->route('admin.sections.index')->with('success', 'Content section created successfully');
    }

    public function edit(ContentSection $section): View
    {
        return view('pages.admin.content-section.edit', compact('section'));
    }

    public function update(UpdateContentSectionRequest $request, ContentSection $section): RedirectResponse
    {
        $validated = $request->validated();

        $section->update($validated);

        return redirect()->route('admin.sections.index')->with('success', 'Content section updated successfully');
    }
}
