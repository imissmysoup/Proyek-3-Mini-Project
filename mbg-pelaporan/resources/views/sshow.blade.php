@extends('layouts.app')

@section('content')
<h2>Detail Laporan #{{ $laporan->id }}</h2>

@if(session('error'))
    <div style="color: red; font-weight: bold;">{{ session('error') }}</div>
@endif
@if(session('success'))
    <div style="color: green; font-weight: bold;">{{ session('success') }}</div>
@endif

<div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
    <p><strong>Sekolah:</strong> {{ $laporan->sekolah->nama_sekolah }}</p>
    <p><strong>Tanggal Distribusi:</strong> {{ $laporan->distribusi->tanggal_distribusi }}</p>
    <p><strong>Status Saat Ini:</strong> {{ $laporan->status }}</p>
    <p><strong>Keluhan:</strong> <br>{{ $laporan->keluhan }}</p>
    
    @if($laporan->path_bukti)
        <p><strong>Bukti:</strong> <a href="{{ asset('storage/' . $laporan->path_bukti) }}" target="_blank">Lihat File</a></p>
    @endif
</div>

<!-- Form Peninjauan khusus Pemantau & Koordinator -->
@if(auth()->user()->role !== 'pelapor')
    <div style="background: #f0f8ff; padding: 15px; border: 1px solid #add8e6;">
        <h3>Tindak Lanjut & Peninjauan</h3>
        <form action="{{ route('laporan.update_status', $laporan->id) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <label for="status">Ubah Status:</label>
            <select name="status" id="status">
                <option value="Menunggu Tinjauan" @selected($laporan->status === 'Menunggu Tinjauan')>Menunggu Tinjauan</option>
                <option value="Diproses" @selected($laporan->status === 'Diproses')>Diproses</option>
                <option value="Diteruskan" @selected($laporan->status === 'Diteruskan')>Diteruskan</option>
                <option value="Selesai" @selected($laporan->status === 'Selesai')>Selesai</option>
            </select>
            <br><br>
            <label for="catatan_pemantau">Catatan:</label><br>
            <textarea name="catatan_pemantau" rows="3" style="width: 100%;">{{ $laporan->catatan_pemantau }}</textarea>
            <br><br>
            <button type="submit">Simpan Pembaruan</button>
        </form>
    </div>
@endif

<br>
<a href="{{ route('laporan.index') }}">Kembali ke Daftar</a>
@endsection