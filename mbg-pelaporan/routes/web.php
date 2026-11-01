<?php

use App\Http\Controllers\RekapController;

Route::middleware('auth')->group(function () {
    // [Route yang sudah ada sebelumnya...]
    
    // Route khusus untuk Pemantau/Koordinator mengubah status
    Route::patch('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.update_status');
    
    // Route Halaman Rekap Sederhana
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
});