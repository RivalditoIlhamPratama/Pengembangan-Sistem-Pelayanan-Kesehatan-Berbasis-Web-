@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Form Tambah Pengguna</h2>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="name" placeholder="Masukkan nama pengguna">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Masukkan username">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email (Opsional)</label>
                <input type="email" class="form-control" id="email" placeholder="Masukkan email">
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role">
                    <option selected disabled>Pilih Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Dokter">Dokter</option>
                    <option value="Klinik">Klinik</option>
                </select>
            </div>

            <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>

        </form>
    </div>
</div>
@endsection
