<?php

use App\Http\Controllers\RekapController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Route khusus untuk Pemantau/Koordinator mengubah status
    Route::patch('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.update_status');
    
    // Route Halaman Rekap Sederhana
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
});