<?php

use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContentSectionController;
use App\Http\Controllers\Admin\FeatureCardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirects
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

Route::redirect('/register', '/login')->name('register');
Route::redirect('/forgot-password', '/login')->name('password.request');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Admin Sliders CRUD
    Route::resource('admin/sliders', SliderController::class)->names('admin.sliders');
    // Admin Sections CRUD
    Route::resource('admin/sections', ContentSectionController::class)->names('admin.sections');
    // Admin Feature Cards CRUD
    Route::resource('admin/feature-cards', FeatureCardController::class)->names('admin.feature-cards');
});
/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
