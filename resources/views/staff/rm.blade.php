@extends('layouts.staff')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Rekam Medis</h2>

        <!-- Pencarian dan Tombol Ekspor -->
        <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="input-group w-25">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari data...">
        <button class="btn btn-outline-secondary" type="button">
            <i class="fas fa-search"></i>
        </button>
        </div>

        <!-- Tombol Ekspor -->
        <div>
            <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        <button id="exportPdf" class="btn btn-danger me-2">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
        <button id="exportExcel" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </button>
        </div>
        </div>


        <!-- Tabel Data Rekam Medis -->
        <div class="table-responsive">
            <table id="rekamMedisTable" class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIK</th>
                        <th>Date</th>
                        <th>Nama Pasien</th>
                        <th>Nama Dokter</th>
                        <th>Suhu</th>
                        <th>TD</th>
                        <th>Nadi</th>
                        <th>TB</th>
                        <th>BB</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $rekamMedis = [
                            ['RM01', '351237128', '2025-01-10', 'Tn. P', 'Dr. Maya Rahma', '38.0°C', '140/90 mmHg', '80 bpm', '160 cm', '70 kg', 'Hipertensi'],
                            ['RM02', '351237129', '2025-01-12', 'Ny. Q', 'Dr. Alamsyah Teguh', '37.5°C', '130/85 mmHg', '78 bpm', '165 cm', '65 kg', 'Flu'],
                        ];
                    @endphp

                    @foreach($rekamMedis as $data)
                    <tr class="align-middle text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data[1] }}</td>
                        <td><strong>{{ $data[2] }}</strong></td>
                        <td>{{ $data[3] }}</td>
                        <td>{{ $data[4] }}</td>
                        <td>{{ $data[5] }}</td>
                        <td>{{ $data[6] }}</td>
                        <td>{{ $data[7] }}</td>
                        <td>{{ $data[8] }}</td>
                        <td>{{ $data[9] }}</td>
                        <td><strong>{{ $data[10] }}</strong></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
