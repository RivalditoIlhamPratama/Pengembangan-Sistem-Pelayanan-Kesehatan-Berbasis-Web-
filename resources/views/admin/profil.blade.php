@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-4">Profil</h4>
        <form>
            <div class="row">
                <!-- Icon Admin -->
                <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                    <i class="ri-admin-line" style="font-size: 100px; color: #6c757d;"></i>
                </div>

                <!-- Form Input -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="Keza Felice">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="admin@web.app">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select">
                            <option selected>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input type="text" class="form-control" value="081234567890">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="2">Jl. Contoh Alamat No.123</textarea>
                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
