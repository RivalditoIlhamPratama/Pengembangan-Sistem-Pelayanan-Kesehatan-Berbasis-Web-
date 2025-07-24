@extends('layouts.staff')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Tambah Rekam Medis</h2>

        <!-- Form Tambah Rekam Medis -->
        <form action="{{ route('stafrekammedis.rekam_medis.submit') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">No RM</label>
                    <input name="noRm" type="text" class="form-control" placeholder="No RM" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">NIK</label>
                    <input name="NIK" type="text" class="form-control" placeholder="NIK" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Pasien</label>
                    <input name="namaPasien" type="text" class="form-control" placeholder="Nama Pasien" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Periksa</label>
                    <input name="tanggalPeriksa" type="date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Staff Rekam Medis</label>
                    <input type="text"  class="form-control" value="{{ $staff->namaStaff }}" readonly />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Alamat Pasien</label>
                    <input name="alamatPasien" type="text" class="form-control" placeholder="Alamat Pasien" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="Laki laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-label">Suhu</label>
                    <div class="input-group">
                        <input name="suhu" id="suhuInput" type="number" class="form-control text-center" placeholder="Suhu"  min="0" max="100" step="1" required >
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tekanan Darah</label>
                    <input name="tekananDarah" type="text" class="form-control" placeholder="Tekanan Darah" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">RR</label>
                    <input name="RR" type="text" class="form-control" placeholder="RR" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Nadi</label>
                    <input name="nadi" type="text" class="form-control" placeholder="Nadi" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input name="tinggiBadan" id="tinggiBadan" type="number" class="form-control text-center" placeholder="Tinggi Badan"  min="0" max="100" step="1"  required>

                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Berat Badan</label>
                    <div class="input-group">
                        <input name="beratBadan" id="beratBadan" type="number" class="form-control text-center" placeholder="Berat Badan"  min="0" max="100" step="1" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Riwayat Penyakit</label>
                <textarea name="riwayatPenyakit" class="form-control" rows="3" placeholder="riwayatPenyakit" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosaMedis" class="form-control" rows="3" placeholder="Diagnosa" required></textarea>
            </div>

            <!-- Tombol Simpan & Batal -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('stafrekammedis.dashboard') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
