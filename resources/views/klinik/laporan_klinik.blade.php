@extends('layouts.klinik')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Laporan Tindakan</h2>

        <!-- Pencarian + Tombol -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
            <!-- Pencarian -->
            <div class="input-group w-25 mb-2 mb-md-0">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex gap-2">
                <a href="{{ route('klinik.laporan.tambah') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>


                <button class="btn btn-danger d-flex align-items-center gap-1">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button class="btn btn-success d-flex align-items-center gap-1">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama pasien</th>
                        <th>Nama Dokter</th>
                        <th>Tindakan</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle text-center">
                        <td>1</td>
                        <td>Senin 12:00</td>
                        <td class="text-start">Dr Alamsyah Tegu</td>
                        <td>Samsul</td>
                        <td>Operasi</td>
                        <td>sakit pinggang</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
