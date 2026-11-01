@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Daftar Laporan Kejadian</h2>
    <!-- Hanya tampil jika role pelapor -->
    @if(auth()->user()->role === 'pelapor')
        <a href="{{ route('laporan.create') }}" style="background: blue; color: white; padding: 10px; text-decoration: none; border-radius: 5px;">+ Buat Laporan Baru</a>
    @endif
</div>

@if(session('success'))
    <div style="color: green; margin: 10px 0; font-weight: bold;">{{ session('success') }}</div>
@endif

<!-- Form Search & Filter -->
<form action="{{ route('laporan.index') }}" method="GET" style="margin: 20px 0; padding: 15px; border: 1px solid #ccc; background: #f9f9f9;">
    <strong>Filter & Pencarian:</strong><br><br>
    
    <label for="sekolah_id">Sekolah:</label>
    <select name="sekolah_id" id="sekolah_id">
        <option value="">-- Semua Sekolah --</option>
        @foreach($sekolahs as $sekolah)
            <option value="{{ $sekolah->id }}" @selected(request('sekolah_id') == $sekolah->id)>
                {{ $sekolah->nama_sekolah }}
            </option>
        @endforeach
    </select>

    <label for="search" style="margin-left: 15px;">Keluhan:</label>
    <input type="text" name="search" id="search" placeholder="Cari kata kunci..." value="{{ request('search') }}">

    <button type="submit" style="margin-left: 10px;">Cari</button>
    <a href="{{ route('laporan.index') }}" style="margin-left: 10px;">Reset</a>
</form>

<!-- Tabel Data -->
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead style="background-color: #eee;">
        <tr>
            <th>ID</th>
            <th>Tanggal Distribusi</th>
            <th>Sekolah</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($laporans as $laporan)
            <tr>
                <td>#{{ $laporan->id }}</td>
                <td>{{ $laporan->distribusi->tanggal_distribusi }}</td>
                <td>{{ $laporan->sekolah->nama_sekolah }}</td>
                <td>{{ Str::limit($laporan->keluhan, 50) }}</td>
                <td>
                    <strong>{{ $laporan->status }}</strong>
                </td>
                <td>
                    <!-- Business Rule: Edit hanya boleh jika status Menunggu Tinjauan -->
                    @if($laporan->status === 'Menunggu Tinjauan' && auth()->user()->role === 'pelapor')
                        <a href="{{ route('laporan.edit', $laporan->id) }}">Edit / Perbaiki</a>
                    @else
                        <span style="color: gray;">Terkunci</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada laporan ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination (Mempertahankan parameter filter) -->
<div style="margin-top: 20px;">
    {{ $laporans->links() }}
</div>
@endsection