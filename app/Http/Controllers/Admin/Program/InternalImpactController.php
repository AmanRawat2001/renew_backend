<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Impact\StoreRequest;
use App\Http\Requests\Impact\UpdateRequest;
use App\Models\Impact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InternalImpactController extends Controller
{
    public function index(): View
    {
        $impacts = Impact::where('page', '!=', SitePage::HOME->value)->orderBy('sequence', 'asc')->paginate(12);

        return view('pages.admin.program.other_impacts.index', compact('impacts'));
    }

    public function create(): View
    {
        return view('pages.admin.program.other_impacts.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Impact::create($validated);

        return redirect()->route('admin.other_impacts.index')->with('success', 'Impact card created successfully');
    }

    public function edit(Impact $other_impact): View
    {
        return view('pages.admin.program.other_impacts.edit', compact('other_impact'));
    }

    public function update(UpdateRequest $request, Impact $other_impact): RedirectResponse
    {
        $validated = $request->validated();
        $other_impact->update($validated);

        return redirect()->route('admin.other_impacts.index')->with('success', 'Impact card updated successfully');
    }
}
