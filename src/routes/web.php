<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->can('view dashboard');
    Route::get('/dashboard/advanced-forms', [DashboardController::class, 'advancedForm'])->name('dashboard.advanced-forms')->middleware('role:Admin');
    Route::get('/dashboard/tables', [DashboardController::class, 'tables'])->name('dashboard.tables')->middleware('role:Admin');

    Route::resource('users', \App\Http\Controllers\UserController::class);
});