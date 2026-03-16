<?php

namespace App\Http\Controllers\Admin\Others\FeatureCard;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureCard\StoreRequest;
use App\Http\Requests\FeatureCard\UpdateRequest;
use App\Models\FeatureCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FeatureCardController extends Controller
{
    public function index(): View
    {
        $query = FeatureCard::where('page', '!=', SitePage::HOME->value);
        if (request()->filled('site_page')) {
            $query->where('page', request('site_page'));
        }
        $cards = $query->orderBy('page', 'asc')->paginate(12)->withQueryString();

        return view('pages.admin.program.feature-card.index', compact('cards'));
    }

    public function create(): View
    {
        return view('pages.admin.program.feature-card.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('other_feature_cards', 'public');
        }

        $validated['page'] = $request->input('page', SitePage::HOME->value);
        FeatureCard::create($validated);

        return redirect()->route('admin.other_feature_cards.index')->with('success', 'Feature card created successfully');
    }

    public function edit(FeatureCard $other_feature_card): View
    {
        return view('pages.admin.program.feature-card.edit', compact('other_feature_card'));
    }

    public function update(UpdateRequest $request, FeatureCard $other_feature_card): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($other_feature_card->image) {
                Storage::disk('public')->delete($other_feature_card->image);
            }
            $validated['image'] = $request->file('image')->store('other_feature_cards', 'public');
        }

        $validated['page'] = $request->input('page', SitePage::HOME->value);
        $other_feature_card->update($validated);

        return redirect()->route('admin.other_feature_cards.index')->with('success', 'Feature card updated successfully');
    }
}
