<?php

use App\Http\Controllers\Admin\AboutUs\AboutUsController;
use App\Http\Controllers\Admin\ACE2026\Ace2026Controller;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\GetInvolved\GetInvolvedController;
use App\Http\Controllers\Admin\Home\ContentSectionController;
use App\Http\Controllers\Admin\Home\FeatureCardController;
use App\Http\Controllers\Admin\Home\HomeController;
use App\Http\Controllers\Admin\Home\ImpactController;
use App\Http\Controllers\Admin\Home\MissionSlideController;
use App\Http\Controllers\Admin\Home\SliderController;
use App\Http\Controllers\Admin\Others\ContentSection\ContentSectionController as OthersContentSectionController;
use App\Http\Controllers\Admin\Others\FeatureCard\FeatureCardController as OthersFeatureCardController;
use App\Http\Controllers\Admin\Others\Impact\ImpactController as OthersImpactController;
use App\Http\Controllers\Admin\Others\ImpactStorySection\ImpactStoryController;
use App\Http\Controllers\Admin\Others\ImpactStorySection\ImpactStorySectionController;
use App\Http\Controllers\Admin\Others\MainSlider\MainSliderController;
use App\Http\Controllers\Admin\Others\MissionSlider\MissionSliderController as OtherMissionSliderController;
use App\Http\Controllers\Admin\Program\ProgramController;
use App\Http\Controllers\Admin\Publication\PublicationController;
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

        Route::prefix('other')->group(function () {
            Route::get('empowering', [ProgramController::class, 'empowering'])->name('program.empowering');
            Route::get('accelerating-innovation', [ProgramController::class, 'accelerating'])->name('program.innovation');
            Route::get('powering-education', [ProgramController::class, 'powering'])->name('program.education');
            Route::get('ace-2026', [Ace2026Controller::class, 'index'])->name('program.ace_2026');
            Route::get('climate-solutions', [ProgramController::class, 'climate'])->name('program.climate_solutions');
            Route::resource('main_sliders', MainSliderController::class);
            Route::resource('other_sections', OthersContentSectionController::class);
            Route::resource('other_impacts', OthersImpactController::class);
            Route::resource('other_mission_sliders', OtherMissionSliderController::class);
            Route::resource('other_feature_cards', OthersFeatureCardController::class);
            Route::resource('impact_story_sections', ImpactStorySectionController::class);
            Route::resource('impact_stories', ImpactStoryController::class);
        });

        Route::get('/publications', [PublicationController::class, 'index'])->name('publications');
        Route::get('/about-us', [AboutUsController::class, 'index'])->name('about_us');
        Route::get('/get-involved', [GetInvolvedController::class, 'index'])->name('get_involved');
    });

});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
