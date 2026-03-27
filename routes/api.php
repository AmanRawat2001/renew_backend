<?php

use App\Http\Controllers\API\AboutUsController;
use App\Http\Controllers\API\AcceleratingInnovationController;
use App\Http\Controllers\API\Ace2026Controller;
use App\Http\Controllers\API\ClimateSolutionsController;
use App\Http\Controllers\API\EmpoweringLivesController;
use App\Http\Controllers\API\GetInvolvedController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\PoweringEducationController;
use App\Http\Controllers\API\PublicationsController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index']);
Route::get('/empowering-lives', [EmpoweringLivesController::class, 'index']);
Route::get('/accelerating-innovation', [AcceleratingInnovationController::class, 'index']);
Route::get('/powering-education', [PoweringEducationController::class, 'index']);
Route::get('/publications', [PublicationsController::class, 'index']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/get-involved', [GetInvolvedController::class, 'index']);
Route::get('/ace2026', [Ace2026Controller::class, 'index']);
Route::get('/climate-solutions', [ClimateSolutionsController::class, 'index']);
