<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureCard\StoreRequest;
use App\Http\Requests\FeatureCard\UpdateRequest;
use App\Models\FeatureCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InternalFeatureCardController extends Controller
{
    public function index(): View
    {
        $cards = FeatureCard::where('page', '!=', SitePage::HOME->value)->orderBy('sequence', 'asc')->paginate(12);

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
