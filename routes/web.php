<?php

use App\Http\Controllers\Admin\EmpoweringLives\MainSliderController;
use App\Http\Controllers\Admin\Home\ContentSectionController;
use App\Http\Controllers\Admin\Home\FeatureCardController;
use App\Http\Controllers\Admin\Home\ImpactController;
use App\Http\Controllers\Admin\Home\MissionSlideController;
use App\Http\Controllers\Admin\Home\SliderController;
use App\Http\Controllers\Admin\HomeController;
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

        Route::prefix('home')->group(function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('sliders', SliderController::class);
            Route::resource('sections', ContentSectionController::class);
            Route::resource('feature-cards', FeatureCardController::class);
            Route::resource('impacts', ImpactController::class);
            Route::resource('mission-slides', MissionSlideController::class);
        });

        Route::prefix('empowering-lives')->group(function () {
            Route::resource('main_sliders', MainSliderController::class);
        });
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
