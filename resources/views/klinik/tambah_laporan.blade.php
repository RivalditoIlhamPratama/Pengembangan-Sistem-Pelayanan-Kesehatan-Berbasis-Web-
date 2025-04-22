@extends('layouts.klinik')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-4 fw-bold">Tambah Laporan Klinik</h4>

        <form action="#" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Klinik</label>
                    <input type="text" class="form-control" placeholder="Klinik">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" placeholder="Nama Pasien">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" placeholder="Nama Dokter">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tindakan</label>
                    <input type="text" class="form-control" placeholder="Tindakan">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea class="form-control" rows="3" placeholder="Diagnosa"></textarea>
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
@endsection
