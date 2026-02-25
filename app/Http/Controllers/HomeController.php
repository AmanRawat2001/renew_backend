<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $sliders = Slider::active()->ordered()->get();

        return view('pages.admin.home', compact('sliders'));
    }
}
