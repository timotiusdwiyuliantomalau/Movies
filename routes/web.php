<?php

use App\Http\Controllers\FetchAPIController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[FetchAPIController::class,'for_you']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/for_you', function () {
    return view('for_you');
});

Route::get('/top_rated',[FetchAPIController::class,'top_rated']);
Route::get('/genres',[FetchAPIController::class,'genres']);
require __DIR__ . '/auth.php';