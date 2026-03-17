<?php

namespace App\Http\Controllers\Admin\Footer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Footer\StoreRequest;
use App\Http\Requests\Footer\UpdateRequest;
use App\Models\Footer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FooterController extends Controller
{
    public function index(): View
    {
        $footers = Footer::orderBy('sequence')->paginate(12);

        return view('pages.admin.footer.index', compact('footers'));
    }

    public function create(): View
    {
        return view('pages.admin.footer.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        dd($request->all());
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('footers', 'public');
        }

        Footer::create($validated);

        return redirect()->route('admin.footers.index')->with('success', 'Footer item created successfully');
    }

    public function edit(Footer $footer): View
    {
        return view('pages.admin.footer.edit', compact('footer'));
    }

    public function update(UpdateRequest $request, Footer $footer): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($footer->image) {
                Storage::disk('public')->delete($footer->image);
            }
            $validated['image'] = $request->file('image')->store('footers', 'public');
        }

        $footer->update($validated);

        return redirect()->route('admin.footers.index')->with('success', 'Footer item updated successfully');
    }

    public function destroy(Footer $footer): RedirectResponse
    {
        if ($footer->image) {
            Storage::disk('public')->delete($footer->image);
        }

        $footer->delete();

        return redirect()->route('admin.footers.index')->with('success', 'Footer item deleted successfully');
    }
}
