<?php

use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/{id}', 'show');
    Route::post('/jobs/create', 'store');
    Route::post('/jobs/{id}', 'edit');
    Route::delete('/jobs/{id}', 'destroy');
});

