<?php

namespace App\Http\Controllers\Admin\Home;

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
        $cards = FeatureCard::ordered()->paginate(12);

        return view('pages.admin.feature-card.index', compact('cards'));
    }

    public function create(): View
    {
        return view('pages.admin.feature-card.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('feature-cards', 'public');
        }

        FeatureCard::create($validated);

        return redirect()->route('admin.feature-cards.index')->with('success', 'Feature card created successfully');
    }

    public function edit(FeatureCard $featureCard): View
    {
        return view('pages.admin.feature-card.edit', compact('featureCard'));
    }

    public function update(UpdateRequest $request, FeatureCard $featureCard): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($featureCard->image) {
                Storage::disk('public')->delete($featureCard->image);
            }
            $validated['image'] = $request->file('image')->store('feature-cards', 'public');
        }

        $featureCard->update($validated);

        return redirect()->route('admin.feature-cards.index')->with('success', 'Feature card updated successfully');
    }
}
