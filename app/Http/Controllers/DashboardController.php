<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $pages = config('admin-pages.pages');

        return view('dashboard', compact('pages'));
    }
}
