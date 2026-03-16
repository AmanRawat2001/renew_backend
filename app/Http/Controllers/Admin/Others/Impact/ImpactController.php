<?php

namespace App\Http\Controllers\Admin\Others\Impact;

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
        $query = Impact::where('page', '!=', SitePage::HOME->value);
        if (request()->filled('site_page')) {
            $query->where('page', request('site_page'));
        }
        $impacts = $query->orderBy('page')->paginate(12)->withQueryString();

        return view('pages.admin.program.other_impacts.index', compact('impacts'));
    }

    public function create(): View
    {
        return view('pages.admin.program.other_impacts.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['page'] = $request->input('page', SitePage::HOME->value);
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
        $validated['page'] = $request->input('page', SitePage::HOME->value);
        $other_impact->update($validated);

        return redirect()->route('admin.other_impacts.index')->with('success', 'Impact card updated successfully');
    }
}
