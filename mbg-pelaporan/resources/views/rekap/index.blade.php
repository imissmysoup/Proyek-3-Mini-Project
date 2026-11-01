@extends('layouts.app')

@section('content')
<h2>Rekap Laporan</h2>

<div style="display: flex; gap: 1rem; margin: 20px 0;">
    <div style="flex: 1; border: 1px solid #ccc; padding: 15px;">
        <strong>Total Laporan</strong>
        <p style="font-size: 1.5rem; margin: 5px 0;">{{ $totalLaporan }}</p>
    </div>
    <div style="flex: 1; border: 1px solid #ccc; padding: 15px;">
        <strong>Sedang Diproses</strong>
        <p style="font-size: 1.5rem; margin: 5px 0;">{{ $sedangDiproses }}</p>
    </div>
    <div style="flex: 1; border: 1px solid #ccc; padding: 15px;">
        <strong>Sudah Selesai</strong>
        <p style="font-size: 1.5rem; margin: 5px 0;">{{ $sudahSelesai }}</p>
    </div>
</div>

<form action="{{ route('rekap.index') }}" method="GET" style="margin: 20px 0; padding: 15px; border: 1px solid #ccc; background: #f9f9f9;">
    <label for="sekolah_id">Sekolah:</label>
    <select name="sekolah_id" id="sekolah_id">
        <option value="">-- Semua Sekolah --</option>
        @foreach($sekolahs as $sekolah)
            <option value="{{ $sekolah->id }}" @selected(request('sekolah_id') == $sekolah->id)>
                {{ $sekolah->nama_sekolah }}
            </option>
        @endforeach
    </select>
    <button type="submit" style="margin-left: 10px;">Filter</button>
    <a href="{{ route('rekap.index') }}" style="margin-left: 10px;">Reset</a>
</form>

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead style="background-color: #eee;">
        <tr>
            <th>ID</th>
            <th>Tanggal Distribusi</th>
            <th>Sekolah</th>
            <th>Keluhan</th>
            <th>Status</th>
            <th>Catatan Pemantau</th>
        </tr>
    </thead>
    <tbody>
        @forelse($rekapData as $laporan)
            <tr>
                <td>#{{ $laporan->id }}</td>
                <td>{{ $laporan->distribusi->tanggal_distribusi }}</td>
                <td>{{ $laporan->sekolah->nama_sekolah }}</td>
                <td>{{ Str::limit($laporan->keluhan, 50) }}</td>
                <td><strong>{{ $laporan->status }}</strong></td>
                <td>{{ $laporan->catatan_pemantau ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data rekap.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection