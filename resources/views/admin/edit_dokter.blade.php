@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Form Edit Dokter</h3>

        <form>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" id="nama" value="dr. Siti Jamila">
            </div>

            <div class="mb-3">
                <label for="spesialis" class="form-label">Spesialis</label>
                <input type="text" class="form-control" id="spesialis" value="Kebidanan">
            </div>

            <div class="mb-3">
                <label for="jadwal" class="form-label">Jadwal Praktek</label>
                <input type="text" class="form-control" id="jadwal" value="Senin & Rabu, 08:00 - 11:00">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin">
                    <option selected>Perempuan</option>
                    <option>Laki-Laki</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" value="1990-04-16">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" rows="2">Jl. Merpati No.12, Kraksaan</textarea>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="telepon" value="081234567890">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ url('/admin/dokter') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
