@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-4">Profil</h4>

      

        <form method="POST" action="{{ route('admin.updateProfile') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="namaAdmin" value="{{ $admin->namaAdmin }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $admin->email }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select" name="jenisKelamin">
                    <option value="Laki-laki" {{ $admin->jenisKelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $admin->jenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">No HP</label>
                <input type="text" class="form-control" name="noHp" value="{{ $admin->noHp }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamatAdmin">{{ $admin->alamatAdmin }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru (opsional)</label>
                <input type="password" class="form-control" name="password">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
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