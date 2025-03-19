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
            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        </div>

        <!-- Tabel Data Dokter -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialis</th>
                        <th>Jenis Kelamin</th>
                        <th>Jadwal</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach(range(1,6) as $i)
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td class="text-start">Dr Alamsyah Teguh</td>
                        <td>Umum</td>
                        <td>Laki Laki</td>
                        <td>Senin & Rabu, 08:00 - 12:00</td>
                        <td>081234234223</td>
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
