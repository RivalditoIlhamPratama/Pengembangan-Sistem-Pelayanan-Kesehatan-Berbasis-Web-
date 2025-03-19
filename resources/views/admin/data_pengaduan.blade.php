@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Pengaduan</h2>

        <!-- Pencarian -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>

        <!-- Tabel Data Pengaduan -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pengadu</th>
                        <th>Jenis Pengaduan</th>
                        <th>Isi Pengaduan</th>
                        <th>No Telepon</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach([
                        ['Bima Yuna Saptaji', 'Pelayanan', 'Pelayanan Kurang Baik...', '081234234223', '2025-01-15'],
                        ['Bima Yuna Saptaji', 'Pelayanan', 'Pelayanan Kurang Baik...', '081234234223', '2025-01-15'],
                        ['Bima Yuna Saptaji', 'Pelayanan', 'Pelayanan Kurang Baik...', '081234234223', '2025-01-15'],
                        ['Bima Yuna Saptaji', 'Pelayanan', 'Pelayanan Kurang Baik...', '081234234223', '2025-01-15'],
                        ['Bima Yuna Saptaji', 'Pelayanan', 'Pelayanan Kurang Baik...', '081234234223', '2025-01-15'],
                    ] as $pengaduan)
                    <tr class="align-middle text-center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $pengaduan[0] }}</td>
                        <td><span class="badge bg-primary text-white">{{ $pengaduan[1] }}</span></td>
                        <td class="text-start">{{ $pengaduan[2] }}</td>
                        <td>{{ $pengaduan[3] }}</td>
                        <td><strong>{{ $pengaduan[4] }}</strong></td>
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
