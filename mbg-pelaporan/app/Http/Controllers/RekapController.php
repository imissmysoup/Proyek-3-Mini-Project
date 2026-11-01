<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        // Authorization: Hanya untuk komunitas
        if (auth()->user()->role === 'pelapor') {
            abort(403, 'Anda tidak memiliki akses ke halaman rekap.');
        }

        $query = Laporan::with(['sekolah', 'distribusi']);

        if ($request->filled('sekolah_id')) {
            $query->where('sekolah_id', $request->sekolah_id);
        }

        // 3 Informasi Ringkasan Sederhana
        $totalLaporan = (clone $query)->count();
        $sedangDiproses = (clone $query)->whereIn('status', ['Menunggu Tinjauan', 'Diproses'])->count();
        $sudahSelesai = (clone $query)->whereIn('status', ['Diteruskan', 'Selesai'])->count();

        // Tabel Rekap Aktual
        $rekapData = $query->latest()->get();
        $sekolahs = Sekolah::all();

        return view('rekap.index', compact('totalLaporan', 'sedangDiproses', 'sudahSelesai', 'rekapData', 'sekolahs'));
    }
}