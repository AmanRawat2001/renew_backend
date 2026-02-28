<?php

use App\Http\Controllers\Admin\Home\ContentSectionController;
use App\Http\Controllers\Admin\Home\FeatureCardController;
use App\Http\Controllers\Admin\Home\ImpactController;
use App\Http\Controllers\Admin\Home\MissionSlideController;
use App\Http\Controllers\Admin\Home\SliderController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Program\InternalContentSectionController;
use App\Http\Controllers\Admin\Program\InternalFeatureCardController;
use App\Http\Controllers\Admin\Program\InternalImpactController;
use App\Http\Controllers\Admin\Program\InternalMainSliderController;
use App\Http\Controllers\Admin\Program\InternalMissionSlideController;
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
            Route::resource('mission_sliders', MissionSlideController::class);
        });

        Route::prefix('program')->group(function () {
            Route::resource('main_sliders', InternalMainSliderController::class);
            Route::resource('other_sections', InternalContentSectionController::class);
            Route::resource('other_impacts', InternalImpactController::class);
            Route::resource('other_mission_sliders', InternalMissionSlideController::class);
            Route::resource('other_feature_cards', InternalFeatureCardController::class);
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
