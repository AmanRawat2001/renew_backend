<?php

use App\Http\Controllers\Admin\ContentSectionController;
use App\Http\Controllers\Admin\FeatureCardController;
use App\Http\Controllers\Admin\ImpactController;
use App\Http\Controllers\Admin\MissionSlideController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirects
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');
Route::redirect('/register', '/login');
Route::redirect('/forgot-password', '/login');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::resource('sliders', SliderController::class);
        Route::resource('sections', ContentSectionController::class);
        Route::resource('feature-cards', FeatureCardController::class);
        Route::resource('impacts', ImpactController::class);
        Route::resource('mission-slides', MissionSlideController::class);

    });

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
