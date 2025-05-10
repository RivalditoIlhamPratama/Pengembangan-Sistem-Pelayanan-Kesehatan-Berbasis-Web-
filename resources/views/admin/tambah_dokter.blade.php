@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4">Form Tambah Dokter</h3>

        <form>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama dokter">
            </div>

            <div class="mb-3">
                <label for="spesialis" class="form-label">Spesialis</label>
                <input type="text" class="form-control" id="spesialis" placeholder="Contoh: Umum, Gigi, Anak, dll">
            </div>

            <div class="mb-3">
                <label for="jadwal" class="form-label">Jadwal Praktek</label>
                <input type="text" class="form-control" id="jadwal" placeholder="Contoh: Senin - Jumat, 07:00 - 14:00">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin">
                    <option>Laki-Laki</option>
                    <option>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
            </div>

            <div class="mb-3">
                <label for="telepon" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="telepon" placeholder="Contoh: 081234567890">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ url('/admin/dokter') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
