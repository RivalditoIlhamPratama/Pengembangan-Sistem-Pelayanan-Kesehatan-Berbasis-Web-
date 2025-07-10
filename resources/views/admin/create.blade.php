@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Form Tambah Pengguna</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pengguna.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email (Opsional)</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Masukkan username" value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password" required>
                </div>
                
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" onchange="toggleKlinikSelect()">
                        <option selected disabled>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="dokter" {{ old('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                        <option value="klinik" {{ old('role') == 'klinik' ? 'selected' : '' }}>Klinik</option>
                    </select>
                </div>

                <div class="mb-3" id="klinik-select" style="display: none;">
                    <label for="klinik_id" class="form-label">Pilih Klinik</label>
                    <select class="form-select" id="klinik_id" name="klinik_id">
                        <option selected disabled>Pilih Klinik</option>
                        @foreach ($kliniks as $klinik)
                            <option value="{{ $klinik->idKlinik }}"
                                {{ old('klinik_id') == $klinik->idKlinik ? 'selected' : '' }}>
                                {{ $klinik->namaKlinik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <script>
                    function toggleKlinikSelect() {
                        var roleSelect = document.getElementById('role');
                        var klinikSelect = document.getElementById('klinik-select');
                        if (roleSelect.value === 'dokter') {
                            klinikSelect.style.display = 'block';
                        } else {
                            klinikSelect.style.display = 'none';
                            document.getElementById('klinik_id').value = '';
                        }
                    }
                    // Call on page load to set initial state
                    window.onload = function() {
                        toggleKlinikSelect();
                    };
                </script>

                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>
@endsection
