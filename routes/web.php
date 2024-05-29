<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\DocumentController;

Route::get('documents', [DocumentController::class, 'index'])->name('documents.index')->middleware('auth');
Route::post('documents', [DocumentController::class, 'store'])->name('documents.store')->middleware('auth');
Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy')->middleware('auth');

Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::resource('recipes', RecipeController::class)->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
