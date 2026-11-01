<?php

use App\Http\Controllers\LaporanController;
use App\Models\Distribusi;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Route CRUD Laporan
    Route::resource('laporan', LaporanController::class);
    
    // Endpoint Asynchronous untuk fetch() daftar distribusi
    Route::get('/sekolah/{sekolah}/distribusi', function ($sekolah) {
        $distribusi = Distribusi::where('sekolah_id', $sekolah)->get();
        return response()->json($distribusi);
    })->name('distribusi.by_sekolah');
});