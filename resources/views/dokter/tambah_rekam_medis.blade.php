@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Tambah Rekam Medis</h2>

        <!-- Form Tambah Rekam Medis -->
        <form action="#" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">No RM</label>
                    <input type="text" class="form-control" placeholder="No RM">
                </div>
                <div class="col-md-4">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" placeholder="NIK">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" placeholder="Nama Pasien">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" placeholder="Nama Dokter">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-label">Suhu</label>
                    <input type="text" class="form-control" placeholder="Suhu">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tekanan Darah</label>
                    <input type="text" class="form-control" placeholder="Tekanan Darah">
                </div>
                <div class="col-md-2">
                    <label class="form-label">RR</label>
                    <input type="text" class="form-control" placeholder="RR">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Nadi</label>
                    <input type="text" class="form-control" placeholder="Nadi">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tinggi Badan</label>
                    <input type="text" class="form-control" placeholder="Tinggi Badan">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Berat Badan</label>
                    <input type="text" class="form-control" placeholder="Berat Badan">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea class="form-control" rows="3" placeholder="Diagnosa"></textarea>
            </div>

            <!-- Tombol Simpan & Batal -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('dokter.rekam_medis') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
