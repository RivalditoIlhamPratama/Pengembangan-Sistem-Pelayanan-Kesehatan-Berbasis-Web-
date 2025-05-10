@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Dokter</h2>

        <!-- Pencarian dan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <a href="{{ url('/admin/dokter/tambah') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Dokter
            </a>
            
        </div>

        <!-- Tabel Data Dokter -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialis</th>
                        <th>Jadwal Praktek</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">Siti Jamila, Amd. Keb</td>
                        <td>Spesialis</td>
                        <td>Senin & Rabu, 08:00 - 11:00</td>
                        <td>Laki-Laki</td>
                        <td>2002-04-16</td>
                        <td class="text-start">Jl. Example No.1</td>
                        <td>08123456780</td>
                        <td>
                            <a href="{{ url('/admin/dokter/edit') }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">drg. Dwi Wahyudi</td>
                        <td>Spesialis</td>
                        <td>Selasa & Kamis, 09:00 - 12:00</td>
                        <td>Perempuan</td>
                        <td>2002-04-16</td>
                        <td class="text-start">Jl. Example No.2</td>
                        <td>08123456781</td>
                        <td>
                            <a href="{{ url('/admin/dokter/edit') }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">dr. Heni Rahmawati</td>
                        <td>Spesialis</td>
                        <td>Senin - Jumat, 07:00 - 13:00</td>
                        <td>Laki-Laki</td>
                        <td>2002-04-16</td>
                        <td class="text-start">Jl. Example No.3</td>
                        <td>08123456782</td>
                        <td>
                            <a href="{{ url('/admin/dokter/edit') }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">dr. Fathullah Huda</td>
                        <td>Spesialis</td>
                        <td>Jumat, 08:00 - 10:30</td>
                        <td>Perempuan</td>
                        <td>2002-04-16</td>
                        <td class="text-start">Jl. Example No.4</td>
                        <td>08123456783</td>
                        <td>
                            <a href="{{ url('/admin/dokter/edit') }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
