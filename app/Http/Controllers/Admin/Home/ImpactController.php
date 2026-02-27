<?php

namespace App\Http\Controllers\Admin\Home;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Impact\StoreRequest;
use App\Http\Requests\Impact\UpdateRequest;
use App\Models\Impact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ImpactController extends Controller
{
    public function index(): View
    {
        $impacts = Impact::where('page', SitePage::HOME->value)->orderBy('sequence', 'asc')->paginate(12);

        return view('pages.admin.home.impact.index', compact('impacts'));
    }

    public function create(): View
    {
        return view('pages.admin.home.impact.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Impact::create($validated);

        return redirect()->route('admin.impacts.index')->with('success', 'Impact card created successfully');
    }

    public function edit(Impact $impact): View
    {
        return view('pages.admin.home.impact.edit', compact('impact'));
    }

    public function update(UpdateRequest $request, Impact $impact): RedirectResponse
    {
        $validated = $request->validated();
        $impact->update($validated);

        return redirect()->route('admin.impacts.index')->with('success', 'Impact card updated successfully');
    }
}
