@extends('layouts.app')

@section('content')
<h2>Edit Laporan #{{ $laporan->id }}</h2>

<form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="sekolah_id">Sekolah</label>
        <select name="sekolah_id" id="sekolah_id" required>
            <option value="">-- Pilih Sekolah --</option>
            @foreach($sekolahs as $sekolah)
                <option value="{{ $sekolah->id }}" @selected($laporan->sekolah_id == $sekolah->id)>
                    {{ $sekolah->nama_sekolah }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="distribusi_id">Tanggal Distribusi</label>
        <select name="distribusi_id" id="distribusi_id" required>
            <option value="">-- Pilih Distribusi --</option>
            @foreach($distribusis as $distribusi)
                <option value="{{ $distribusi->id }}" @selected($laporan->distribusi_id == $distribusi->id)>
                    {{ $distribusi->tanggal_distribusi }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="keluhan">Detail Keluhan</label>
        <textarea name="keluhan" id="keluhan" rows="4" required>{{ $laporan->keluhan }}</textarea>
    </div>

    <div>
        <label for="path_bukti">Bukti Pendukung (JPG/PNG/PDF maks 2MB, kosongkan jika tidak ingin mengganti)</label>
        <input type="file" name="path_bukti" id="path_bukti" accept=".jpg,.jpeg,.png,.pdf">
        @if($laporan->path_bukti)
            <p>Bukti saat ini: <a href="{{ asset('storage/' . $laporan->path_bukti) }}" target="_blank">Lihat File</a></p>
        @endif
    </div>

    <button type="submit">Simpan Perubahan</button>
    <a href="{{ route('laporan.index') }}">Batal</a>
</form>

<script>
    document.getElementById('sekolah_id').addEventListener('change', function() {
        const sekolahId = this.value;
        const distribusiSelect = document.getElementById('distribusi_id');

        distribusiSelect.innerHTML = '<option value="">Memuat data...</option>';

        if (!sekolahId) {
            distribusiSelect.innerHTML = '<option value="">-- Pilih Sekolah Terlebih Dahulu --</option>';
            return;
        }

        fetch(`/sekolah/${sekolahId}/distribusi`)
            .then(response => response.json())
            .then(data => {
                distribusiSelect.innerHTML = '<option value="">-- Pilih Distribusi --</option>';
                data.forEach(item => {
                    distribusiSelect.innerHTML += `<option value="${item.id}">${item.tanggal_distribusi}</option>`;
                });
            })
            .catch(error => {
                console.error('Error fetching distribusi:', error);
                distribusiSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            });
    });
</script>
@endsection