<?php

namespace App\Observers;

use App\Models\Laporan;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class LaporanObserver
{
    public function updated(Laporan $laporan): void
    {
        // Hanya mencatat jika yang berubah adalah statusnya
        if ($laporan->isDirty('status')) {
            AuditLog::create([
                'laporan_id' => $laporan->id,
                'user_id' => Auth::id(), // Menyimpan ID user yang mengubah status
                'old_status' => $laporan->getOriginal('status'),
                'new_status' => $laporan->status,
            ]);
        }
    }
}