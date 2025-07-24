@extends('layouts.klinik')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-4">Profil Klinik</h4>

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('klinik.update_profil') }}">
            @csrf
            <input type="hidden" name="idKlinik" value="{{ $klinik->idKlinik }}">

            <div class="mb-3">
                <label class="form-label">Nama Klinik</label>
                <input type="text" class="form-control" name="namaKlinik" value="{{ old('namaKlinik', $klinik->namaKlinik) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $klinik->user->username) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $klinik->user->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Klinik</label>
                <textarea class="form-control" name="alamatKlinik">{{ old('alamatKlinik', $klinik->alamatKlinik) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru (Opsional)</label>
                <input type="password" class="form-control" name="password">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
            </div>

            <a href="{{ route('klinik.dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Update Profil</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush
