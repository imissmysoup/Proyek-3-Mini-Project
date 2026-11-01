@extends('layouts.app')

@section('content')
<h2>Buat Laporan Baru</h2>

<!-- Wajib menyertakan enctype untuk file upload -->
<form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div>
        <label for="sekolah_id">Sekolah</label>
        <select name="sekolah_id" id="sekolah_id" required>
            <option value="">-- Pilih Sekolah --</option>
            @foreach($sekolahs as $sekolah)
                <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="distribusi_id">Tanggal Distribusi</label>
        <!-- Opsi distribusi akan diisi otomatis oleh JavaScript -->
        <select name="distribusi_id" id="distribusi_id" required>
            <option value="">-- Pilih Sekolah Terlebih Dahulu --</option>
        </select>
    </div>

    <div>
        <label for="keluhan">Detail Keluhan</label>
        <textarea name="keluhan" id="keluhan" rows="4" required></textarea>
    </div>

    <div>
        <label for="path_bukti">Bukti Pendukung (JPG/PNG/PDF maks 2MB)</label>
        <input type="file" name="path_bukti" id="path_bukti" accept=".jpg,.jpeg,.png,.pdf">
    </div>

    <button type="submit">Kirim Laporan</button>
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

        // Asynchronous request mengambil daftar distribusi
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