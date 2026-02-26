<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImpactRequest;
use App\Http\Requests\UpdateImpactRequest;
use App\Models\Impact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImpactController extends Controller
{
    public function index(): View
    {
        $impacts = Impact::orderBy('sequence', 'asc')->paginate(12);

        return view('pages.admin.impact.index', compact('impacts'));
    }

    public function create(): View
    {
        return view('pages.admin.impact.create');
    }

    public function store(StoreImpactRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Impact::create($validated);

        return redirect()->route('admin.impacts.index')->with('success', __('Impact card created successfully'));
    }

    public function edit(Impact $impact): View
    {
        return view('pages.admin.impact.edit', compact('impact'));
    }

    public function update(UpdateImpactRequest $request, Impact $impact): RedirectResponse
    {
        $validated = $request->validated();
        $impact->update($validated);

        return redirect()->route('admin.impacts.index')->with('success', __('Impact card updated successfully'));
    }
}
