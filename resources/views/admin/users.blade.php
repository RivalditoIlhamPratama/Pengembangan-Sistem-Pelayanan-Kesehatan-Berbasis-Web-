@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h1 class="mb-4 fw-bold">Data Pengguna</h1>

            <!-- Pencarian dan Tambah -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group w-25">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>

            <!-- Tabel -->
            <div class="table-responsive pt-4">
                <table class="table table-striped table-bordered table-hover mb-5">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($users as $user)
                            <tr class="align-middle text-center">
                                <td>{{ $no++ }}</td>
                                <td class="text-start">
                                    @if ($user->role == 'admin' && $user->admin)
                                        {{ $user->admin->first()->namaAdmin ?? $user->name }}
                                    @elseif ($user->role == 'dokter' && $user->dokter)
                                        {{ $user->dokter->first()->namaDokter ?? $user->name }}
                                    @elseif ($user->role == 'pasien' && $user->pasien)
                                        {{ $user->pasien->namaPasien ?? $user->name }}
                                    @elseif ($user->role == 'stafrekammedis' && $user->stafrekammedis)
                                        {{ $user->stafrekammedis->first()->namaStaff ?? $user->name }}
                                    @elseif ($user->role == 'klinik' && $user->klinik)
                                        {{ $user->klinik->namaKlinik ?? $user->name }}
                                    @else
                                        {{ $user->name }}
                                    @endif
                                </td>
                                <td>{{ $user->username ?? 'N/A' }}</td>
                                <td>
                                    @if ($user->role == 'klinik' && $user->klinik)
                                        {{ $user->klinik->email ?? 'N/A' }}
                                    @else
                                        {{ $user->email ?? 'N/A' }}
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge {{ strtolower($user->role) == 'dokter' ? 'bg-primary' : 'bg-secondary' }} text-white">
                                        {{ $user->role ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $user->id_user }}"
                                        data-name="@if ($user->role == 'admin' && $user->admin) {{ $user->admin->first()->namaAdmin ?? $user->name }}@elseif ($user->role == 'dokter' && $user->dokter){{ $user->dokter->first()->namaDokter ?? $user->name }}@elseif ($user->role == 'pasien' && $user->pasien){{ $user->pasien->namaPasien ?? $user->name }}@elseif ($user->role == 'stafrekammedis' && $user->stafrekammedis){{ $user->stafrekammedis->first()->namaStaff ?? $user->name }}@elseif ($user->role == 'klinik' && $user->klinik){{ $user->klinik->namaKlinik ?? $user->name }}@else{{ $user->name }} @endif"
                                        data-username="{{ $user->username }}"
                                        data-email="@if ($user->role == 'klinik' && $user->klinik) {{ $user->klinik->email ?? $user->email }}@else{{ $user->email }} @endif"
                                        data-role="{{ $user->role }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.pengguna.destroy', $user->id_user) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus pengguna ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.pengguna.update') }}" id="editUserForm" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit-id">
                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" id="edit-name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="edit-username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-email">
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Role</label>
                        <select class="form-select" name="role" id="edit-role" required>
                            <option value="admin">Admin</option>
                            <option value="dokter">Dokter</option>
                            <option value="klinik">Klinik</option>
                            <option value="pasien">Pasien</option>
                            <option value="stafrekammedis">Staf Rekam Medis</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.addEventListener("click", function(event) {
                if (event.target.closest(".edit-btn")) {
                    const btn = event.target.closest(".edit-btn");
                    console.log("Edit button clicked:", btn);
                    document.getElementById('edit-id').value = btn.dataset.id;
                    document.getElementById('edit-name').value = btn.dataset.name;
                    document.getElementById('edit-username').value = btn.dataset.username;
                    document.getElementById('edit-email').value = btn.dataset.email;
                    document.getElementById('edit-role').value = btn.dataset.role;
                }
            });
        });
    </script>
@endpush
