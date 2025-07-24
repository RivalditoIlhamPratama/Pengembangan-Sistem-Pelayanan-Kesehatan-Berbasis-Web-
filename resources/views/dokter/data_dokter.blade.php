@extends('layouts.dokter')

@section('content')
    <div class="container mt-5">
        <div class="card p-4 shadow-sm">
            <h4 class="fw-bold mb-4">Profil Dokter</h4>



            {{-- Notifikasi error --}}
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validasi error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="d-flex flex-column align-items-center mb-4">
                <img src="{{ $dokter->gambarProfil ? asset('storage/' . $dokter->gambarProfil) : asset('default-profile.png') }}"
                     class="rounded-circle shadow"
                     width="150"
                     height="150"
                     alt="Foto Dokter">
                <h5 class="mt-3">{{ $dokter->namaDokter }}</h5>
            </div>
            
            
            <form method="POST" action="{{ route('dokter.data_dokter.update') }}" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="idDokter" value="{{ $dokter->idDokter }}">

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" name="namaDokter" value="{{ old('namaDokter', $dokter->namaDokter) }}">
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username', $dokter->user->username) }}">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $dokter->user->email) }}">
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenisKelamin">
                        <option value="Laki-Laki" {{ old('jenisKelamin', $dokter->jenisKelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenisKelamin', $dokter->jenisKelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tglLahir" value="{{ old('tglLahir', $dokter->tglLahir) }}">
                </div>

                <!-- No Telepon -->
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" class="form-control" name="noTelepon" value="{{ old('noTelepon', $dokter->noTelepon) }}">
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamatDokter">{{ old('alamatDokter', $dokter->alamatDokter) }}</textarea>
                </div>

                <!-- Password Baru -->
                <div class="mb-3">
                    <label class="form-label">Password Baru (opsional)</label>
                    <input type="password" class="form-control" name="password">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti password.</small>
                </div>
                <div class="mb-3">
                    <label for="gambarProfil" class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" id="gambarProfil" name="gambarProfil" accept="image/*">
                    <small class="form-text text-muted">Ukuran maksimal gambar 2MB (jpg, jpeg, png).</small>

                    @if($dokter->gambarProfil)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $dokter->gambarProfil) }}" alt="Foto Lama" width="100" class="rounded">
                        </div>
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary">Update Profil</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush

