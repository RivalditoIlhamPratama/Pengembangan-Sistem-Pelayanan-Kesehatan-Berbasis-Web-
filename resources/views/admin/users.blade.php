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
            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
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
                    @foreach($users as $user)
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">
                            {{ $user->name }}
                        </td>
                        <td>{{ $user->username ?? 'N/A' }}</td>
                        <td>{{ $user->email ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ strtolower($user->role) == 'dokter' ? 'bg-primary' : 'bg-secondary' }} text-white">
                                {{ $user->role ?? 'N/A' }}
                            </span>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    
                    @endforeach
                </tbody>
            </table>

            
        </div>
    </div>
</div>
@endsection
