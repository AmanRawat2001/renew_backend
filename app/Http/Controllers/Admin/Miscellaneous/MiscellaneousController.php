<?php

namespace App\Http\Controllers\Admin\Miscellaneous;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MiscellaneousController extends Controller
{
    public function index()
    {
        return view('pages.admin.miscellaneous.index');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        // Get original name
        $fileName = $file->getClientOriginalName();

        // Store with original name
        $path = $file->storeAs('miscellaneous', $fileName, 'public');

        $url = Storage::disk('public')->url($path);

        return redirect()->back()->with([
            'success' => 'File uploaded successfully',
            'url' => $url,
        ]);
    }
}
