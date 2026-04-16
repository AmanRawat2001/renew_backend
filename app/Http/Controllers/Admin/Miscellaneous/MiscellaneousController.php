<?php

namespace App\Http\Controllers\Admin\Miscellaneous;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        // Create directory if it doesn't exist
        $uploadDir = public_path('uploads/miscellaneous');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move file to public/uploads/miscellaneous
        $file->move($uploadDir, $fileName);

        $url = url('uploads/miscellaneous/' . $fileName);

        return redirect()->back()->with([
            'success' => 'File uploaded successfully',
            'url' => $url,
        ]);
    }
}
