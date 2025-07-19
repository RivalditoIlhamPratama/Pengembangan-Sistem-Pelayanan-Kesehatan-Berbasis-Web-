@extends('layouts.klinik')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-4 fw-bold">Tambah Laporan Klinik</h4>

            <form action="{{ route('klinik.laporan.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="Klinik_id" value="{{ $klinik->idKlinik ?? '' }}" />
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="Klinik_id" class="form-label fw-semibold text-muted">Klinik</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-dark"><i class="fas fa-clinic-medical"></i></span>
                            <input type="text" class="form-control bg-white text-dark" id="Klinik_id"
                                value="{{ $klinik->namaKlinik ?? 'Nama Klinik' }}" readonly>
                        </div>
                    </div>

                    <!--
<div class="col-md-6">
    <label for="RekamMedis_id" class="form-label">Rekam Medis</label>
    <select name="RekamMedis_id" id="RekamMedis_id" class="form-control">
        <option value="">Sesuai Rekam Medis</option>
        @foreach ($rekammedis as $rekam)
            <option value="{{ $rekam->idRekamMedis }}" data-namapasien="{{ $rekam->namaPasien }}"
                data-namadokter="{{ optional($rekam->dokter)->namaDokter }}"
                data-diagnosa="{{ $rekam->diagnosaMedis }}" data-nik="{{ $rekam->NIK }}"
                data-alamat="{{ $rekam->alamatPasien }}" dapta-tindakan="{{ $rekam->tindakan }}">
                {{ $rekam->namaPasien }}
            </option>
        @endforeach
    </select>
</div>
-->

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="namaDokter" class="form-label">Nama Dokter</label>
                        <input type="text" id="namaDokter" name="namaDokter" class="form-control" placeholder="Masukkan nama dokter" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Nama Pasien</label>
                        <input type="text" id="namaPasien" name="namaPasien" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">NIK Pasien</label>
                        <input type="text" class="form-control" id="NIK" name="NIK" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Alamat Pasien</label>
                        <input type="text" id="alamatPasien" name="alamatPasien" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Diagnosa Medis</label>
                        <input type="text" id="diagnosa" name="diagnosaMedis" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tindakan Medis</label>
                        <input type="text" id="tindakan" name="tindakan" class="form-control">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                    <a href="{{ route('klinik.laporan') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
    @vite('resources/js/rekammedis-select.js')
@endsection


