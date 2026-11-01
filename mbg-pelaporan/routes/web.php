<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapController;
use App\Models\Distribusi;

// Redirect awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Area Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Area Auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('laporan', LaporanController::class);
    Route::patch('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.update_status');
    Route::get('/sekolah/{sekolah}/distribusi', function ($sekolah) {
        $distribusi = Distribusi::where('sekolah_id', $sekolah)->get();
        return response()->json($distribusi);
    })->name('distribusi.by_sekolah');
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
});