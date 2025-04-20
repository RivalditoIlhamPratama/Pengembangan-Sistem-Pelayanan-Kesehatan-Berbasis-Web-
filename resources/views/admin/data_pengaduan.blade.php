@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Pengaduan</h2>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        @if($pengaduan->isEmpty())
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
            <p>Tidak ada data Pengaduan.</p>
        @else
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
                    @foreach($pengaduan as $aduan)
                    <tr>
                        <td>{{ $aduan->idPengaduan }}</td>
                        <td>{{ ($aduan->pasien)->namaPasien ?? 'N/A' }}</td>
                        <td>{{ $aduan->jenisPengaduan }}</td>
                        <td>{{ $aduan->isiPengaduan }}</td>
                        <td>{{ $aduan->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d-m-Y') }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
