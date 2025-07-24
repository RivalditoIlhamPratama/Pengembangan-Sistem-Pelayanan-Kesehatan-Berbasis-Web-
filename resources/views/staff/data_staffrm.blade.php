@extends('layouts.staff')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-4">Profil Staff Rekam Medis</h4>

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
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

        <form id="formUpdate" method="POST" action="{{ route('staff.update_profil') }}">
            @csrf
            <input type="hidden" name="idStaffRm" value="{{ $staff->idStaffRm }}">

            <div class="mb-3">
                <label class="form-label">Nama Staff</label>
                <input type="text" class="form-control" name="namaStaff" value="{{ old('namaStaff', $staff->namaStaff) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username', $staff->user->username) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $staff->user->email) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jenisKelamin">
                    <option value="Laki-Laki" {{ old('jenisKelamin', $staff->jenisKelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenisKelamin', $staff->jenisKelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control" name="noHp" value="{{ old('noHp', $staff->noHp) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamatStaff">{{ old('alamatStaff', $staff->alamatStaff) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru (Opsional)</label>
                <input type="password" class="form-control" name="password">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
            </div>

            <a href="{{ route('stafrekammedis.dashboard') }}" class="btn btn-secondary mb-3">
                <i class="ri-arrow-left-line"></i> Kembali
            </a>

            {{-- Tombol langsung submit --}}
            <button type="submit" class="btn btn-primary">Update Profil</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Notifikasi sukses setelah update
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
