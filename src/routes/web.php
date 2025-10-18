<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Social Authentication Routes
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);
Route::get('/auth/github', [SocialiteController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [SocialiteController::class, 'handleGithubCallback']);

Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified', 'active'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->can('view dashboard');
    Route::get('/dashboard/advanced-forms', [DashboardController::class, 'advancedForm'])->name('dashboard.advanced-forms')->middleware('role:Admin');
    Route::get('/dashboard/tables', [DashboardController::class, 'tables'])->name('dashboard.tables')->middleware('role:Admin');

    // User Management
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('users/{user}/verify', [\App\Http\Controllers\UserController::class, 'verify'])->name('users.verify-email');
    Route::post('users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('users/{user}/activate', [\App\Http\Controllers\UserController::class, 'activate'])->name('users.activate');
    Route::post('users/{user}/deactivate', [\App\Http\Controllers\UserController::class, 'deactivate'])->name('users.deactivate');

    // Role Management
    Route::resource('roles', \App\Http\Controllers\RoleController::class);

    // Permission Management
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
});