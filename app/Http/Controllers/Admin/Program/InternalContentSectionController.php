<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContentSection\StoreRequest;
use App\Http\Requests\ContentSection\UpdateRequest;
use App\Models\ContentSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InternalContentSectionController extends Controller
{
    public function index(): View
    {
        $sections = ContentSection::where('page','!=', SitePage::HOME->value)->ordered()->paginate(10);

        return view('pages.admin.other_section.index', compact('sections'));
    }

    public function create(): View
    {
        return view('pages.admin.other_section.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        ContentSection::create($validated);

        return redirect()->route('admin.other_sections.index')->with('success', 'Content section created successfully');
    }

    public function edit(ContentSection $other_section): View
    {
        return view('pages.admin.other_section.edit', compact('other_section'));
    }

    public function update(UpdateRequest $request, ContentSection $other_section): RedirectResponse
    {
        $validated = $request->validated();
        $other_section->update($validated);

        return redirect()->route('admin.other_sections.index')->with('success', 'Content section updated successfully');
    }
}
