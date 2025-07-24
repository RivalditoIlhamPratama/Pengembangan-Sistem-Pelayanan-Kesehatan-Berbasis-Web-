@extends('layouts.klinik')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4 fw-bold">Edit Laporan Tindakan</h3>
        <form action="{{ route('klinik.laporan.update', $laporan->idLaporan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Pasien</label>
                <input type="text" name="namaPasien" class="form-control" value="{{ $laporan->namaPasien }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="NIK" class="form-control" value="{{ $laporan->NIK }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamatPasien" class="form-control" required>{{ $laporan->alamatPasien }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <input type="text" name="diagnosaMedis" class="form-control" value="{{ $laporan->diagnosaMedis }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Dokter</label>
                <input type="text" name="namaDokter" class="form-control" value="{{ $laporan->namaDokter }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tindakan Medis</label>
                <input type="text" name="deskripsi_tindakan" class="form-control" value="{{ $laporan->deskripsi_tindakan }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('klinik.laporan') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush