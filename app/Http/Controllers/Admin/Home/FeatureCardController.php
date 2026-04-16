<?php

namespace App\Http\Controllers\Admin\Home;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureCard\StoreRequest;
use App\Http\Requests\FeatureCard\UpdateRequest;
use App\Models\FeatureCard;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FeatureCardController extends Controller
{
    public function index(): View
    {
        $cards = FeatureCard::where('page', SitePage::HOME->value)->orderBy('sequence', 'asc')->paginate(12);

        return view('pages.admin.home.feature-card.index', compact('cards'));
    }

    public function create(): View
    {
        return view('pages.admin.home.feature-card.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageService = new ImageService();
            $validated['image'] = $imageService->storeOptimized(
                $request->file('image'),
                'feature-cards'
            );
        }

        FeatureCard::create($validated);

        return redirect()->route('admin.feature-cards.index')->with('success', 'Feature card created successfully');
    }

    public function edit(FeatureCard $featureCard): View
    {
        return view('pages.admin.home.feature-card.edit', compact('featureCard'));
    }

    public function update(UpdateRequest $request, FeatureCard $featureCard): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageService = new ImageService();
            if ($featureCard->image) {
                $imageService->delete($featureCard->image);
            }
            $validated['image'] = $imageService->storeOptimized(
                $request->file('image'),
                'feature-cards'
            );
        }

        $featureCard->update($validated);

        return redirect()->route('admin.feature-cards.index')->with('success', 'Feature card updated successfully');
    }
}
