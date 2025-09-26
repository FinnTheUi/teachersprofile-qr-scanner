<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\OfficeController as AdminOfficeController;
use App\Http\Controllers\QrScanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('landing');
});

// Admin routes (protected)


// Public QR scanner
Route::get('/scan', [QrScanController::class, 'showForm'])->name('scan.form');
Route::post('/scan', [QrScanController::class, 'scan'])->name('scan.qr');

// Public profile view (view-only)
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Auth routes
Auth::routes();

// Dashboard routes
Route::middleware(['auth'])->group(function () {
    // Common dashboard redirect
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'redirect'])->name('home');
    
    // Teacher routes
    Route::prefix('teacher')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Teacher\DashboardController::class, 'index'])->name('teacher.dashboard');
        Route::get('/profile', [\App\Http\Controllers\Teacher\ProfileController::class, 'edit'])->name('teacher.profile.edit');
        Route::put('/profile', [\App\Http\Controllers\Teacher\ProfileController::class, 'update'])->name('teacher.profile.update');
        Route::get('/download-qr', [\App\Http\Controllers\Teacher\ProfileController::class, 'downloadQr'])->name('teacher.download-qr');
    });
    
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::put('/users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
        Route::resource('profiles', AdminProfileController::class)->names([
            'index' => 'admin.profiles.index',
            'create' => 'admin.profiles.create',
            'store' => 'admin.profiles.store',
            'show' => 'admin.profiles.show',
            'edit' => 'admin.profiles.edit',
            'update' => 'admin.profiles.update',
            'destroy' => 'admin.profiles.destroy'
        ]);
        Route::resource('offices', AdminOfficeController::class)->names([
            'index' => 'admin.offices.index',
            'create' => 'admin.offices.create',
            'store' => 'admin.offices.store',
            'show' => 'admin.offices.show',
            'edit' => 'admin.offices.edit',
            'update' => 'admin.offices.update',
            'destroy' => 'admin.offices.destroy'
        ]);
        Route::get('profiles/{profile}/download-qr', [AdminProfileController::class, 'downloadQr'])->name('admin.profiles.download-qr');
    });
});