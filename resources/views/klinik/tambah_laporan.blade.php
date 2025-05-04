@extends('layouts.klinik')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-4 fw-bold">Tambah Laporan Klinik</h4>

        <form action="{{ route('klinik.laporan.submit') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="Klinik_id" class="form-label">Klinik</label>
                    <select name="Klinik_id" id="Klinik_id" class="form-control" required>
                        <option value="">Pilih Klinik</option>
                        @foreach($kliniks as $klinik)
                            <option value="{{ $klinik->idKlinik }}">{{ $klinik->namaKlinik ?? 'Nama Klinik' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="RekamMedis_id" class="form-label">Rekam Medis</label>
                    <select name="RekamMedis_id" id="RekamMedis_id" class="form-control" required>
                        <option value="">Pilih Rekam Medis</option>
                        @foreach($rekammedis as $rekam)
                            <option
                                value="{{ $rekam->idRekamMedis }}"
                                data-namapasien="{{ $rekam->namaPasien }}"
                                data-namadokter="{{ optional($rekam->dokter)->namaDokter }}"
                                data-diagnosa="{{ $rekam->diagnosaMedis }}"
                            >
                                {{ $rekam->namaPasien }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-3">
                        <label class="form-label">Nama Pasien</label>
                        <input type="text" id="namaPasien" class="form-control" readonly>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" id="namaDokter" class="form-control" readonly>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Diagnosa</label>
                        <input type="text" id="diagnosa" class="form-control" readonly>
                    </div>
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

