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
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('profiles', AdminProfileController::class);
    Route::resource('offices', AdminOfficeController::class);
    Route::get('profiles/{profile}/download-qr', [AdminProfileController::class, 'downloadQr'])->name('admin.profiles.download-qr');
});

// Public QR scanner
Route::get('/scan', [QrScanController::class, 'showForm'])->name('scan.form');
Route::post('/scan', [QrScanController::class, 'scan'])->name('scan.qr');

// Public profile view (view-only)
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Auth routes
Auth::routes();