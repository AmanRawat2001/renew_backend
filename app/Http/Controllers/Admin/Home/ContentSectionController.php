<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentSection\StoreRequest;
use App\Http\Requests\ContentSection\UpdateRequest;
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

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContentSection::create($validated);

        return redirect()->route('admin.sections.index')->with('success', 'Content section created successfully');
    }

    public function edit(ContentSection $section): View
    {
        return view('pages.admin.content-section.edit', compact('section'));
    }

    public function update(UpdateRequest $request, ContentSection $section): RedirectResponse
    {
        $validated = $request->validated();

        $section->update($validated);

        return redirect()->route('admin.sections.index')->with('success', 'Content section updated successfully');
    }
}
