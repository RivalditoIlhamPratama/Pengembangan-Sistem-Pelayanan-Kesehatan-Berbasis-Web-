@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5"> <!-- Tambah mt-5 agar lebih ke bawah -->
        <div class="card p-4 shadow-sm">
            <h1 class="mb-4 fw-bold">Data Pengguna</h1>

            <!-- Pencarian dan Tombol Tambah -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group w-25">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <a href="{{ url('/admin/pengguna/create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>

            <!-- Tabel Data Pengguna -->
            <div class="table-responsive pt-4"> <!-- Tambahkan pt-4 supaya tabel turun -->
                <table class="table table-striped table-bordered table-hover mb-5"> <!-- Tambah mb-5 -->
                    <thead class="table-light">
                        <tr class="text-center">
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
                                    {{ $user->name }}
                                </td>
                                <td>{{ $user->username ?? 'N/A' }}</td>
                                <td>{{ $user->email ?? 'N/A' }}</td>
                                <td>
                                    <span
                                        class="badge {{ strtolower($user->role) == 'dokter' ? 'bg-primary' : 'bg-secondary' }} text-white">
                                        {{ $user->role ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editModal" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-username="{{ $user->username }}"
                                        data-email="{{ $user->email }}" data-role="{{ $user->role }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>

    <!-- Modal Edit Pengguna -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="edit-name">
                        </div>
                        <div class="mb-3">
                            <label for="edit-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit-username">
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email">
                        </div>
                        <div class="mb-3">
                            <label for="edit-role" class="form-label">Role</label>
                            <select class="form-select" id="edit-role">
                                <option value="Admin">Admin</option>
                                <option value="Dokter">Dokter</option>
                                <option value="Klinik">Klinik</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
