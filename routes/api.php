<?php

use App\Http\Controllers\API\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/home', [HomeController::class, 'home']);
Route::get('/empowering-lives', [HomeController::class, 'empowering_lives']);
Route::get('/accelerating-innovation', [HomeController::class, 'accelerating_innovation']);
Route::get('/powering-education', [HomeController::class, 'powering_education']);
Route::get('/publications', [HomeController::class, 'publications']);
Route::get('/about-us', [HomeController::class, 'about_us']);
