<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLaporanRequest;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with(['sekolah', 'distribusi']);

        // Filter berdasarkan Sekolah
        if ($request->filled('sekolah_id')) {
            $query->where('sekolah_id', $request->sekolah_id);
        }

        // Pencarian berdasarkan keluhan
        if ($request->filled('search')) {
            $query->where('keluhan', 'like', '%' . $request->search . '%');
        }

        // Membatasi Pelapor hanya melihat datanya sendiri
        if (auth()->user()->role === 'pelapor') {
            $query->where('user_id', auth()->id());
        }

        // Pagination 10 data dengan mempertahankan parameter filter
        $laporans = $query->latest()->paginate(10)->withQueryString();
        $sekolahs = Sekolah::all();

        return view('laporan.index', compact('laporans', 'sekolahs'));
    }

    public function create()
    {
        $sekolahs = Sekolah::all();
        return view('laporan.create', compact('sekolahs'));
    }

    public function store(StoreLaporanRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('path_bukti')) {
            // Mengelola file menggunakan Laravel Storage
            $data['path_bukti'] = $request->file('path_bukti')->store('bukti_laporan', 'public');
        }

        Laporan::create($data);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function edit(Laporan $laporan)
    {
        // Authorization: Cegah modifikasi melalui manipulasi URL/ID
        if ($laporan->user_id !== auth()->id() && auth()->user()->role === 'pelapor') {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Business Rule: Cegah perubahan jika laporan sudah tidak berstatus Menunggu Tinjauan
        if ($laporan->status !== 'Menunggu Tinjauan' && auth()->user()->role === 'pelapor') {
            abort(403, 'Laporan yang sudah diproses tidak dapat diubah.');
        }

        $sekolahs = Sekolah::all();
        return view('laporan.edit', compact('laporan', 'sekolahs'));
    }
}