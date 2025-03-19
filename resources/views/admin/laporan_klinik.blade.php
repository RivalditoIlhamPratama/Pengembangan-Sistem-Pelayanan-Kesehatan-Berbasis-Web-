@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Laporan Klinik</h2>

        <!-- Pencarian -->
        <div class="d-flex justify-content-end mb-4">
            <div class="input-group w-25">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Tabel Data Laporan Klinik -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Klinik</th>
                        <th>Tanggal Tindakan</th>
                        <th>Nama Pasien</th>
                        <th>Deskripsi Tindakan</th>
                        <th>Dokter</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach(range(1,5) as $i)
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td><strong class="text-primary">Umum</strong></td>
                        <td class="fw-bold">2025-01-15</td>
                        <td>Ibnu Abdi Muslim</td>
                        <td>Pemeriksaan Fisik</td>
                        <td class="fw-bold">DR Hargianto</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
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
