@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Dokter</h2>

            <!-- Pencarian dan Tombol Tambah -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- <div class="input-group w-25">
                    <input type="text" class="form-control" placeholder="Search">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div> -->
                <a href="{{ route('admin.data_dokter.tambah') }}" class="btn btn-primary">
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
                            <th>Foto</th> {{-- Tambahan --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dokter as $loopIndex => $dokters)
                            <tr class="text-center align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dokters->namaDokter }}</td>
                                <td>{{ $dokters->spesialis }}</td>
                                <td>
                                    @foreach ($dokters->jadwaldokters as $jadwal)
                                        @if ($jadwal->hari && $jadwal->waktu)
                                            {{ $jadwal->hari->namaHari }}<br>{{ $jadwal->waktu->jamMulai }} - {{ $jadwal->waktu->jamSelesai }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $dokters->jenisKelamin }}</td>
                                <td>{{ $dokters->tglLahir }}</td>
                                <td>{{ $dokters->alamatDokter }}</td>
                                <td>{{ $dokters->noTelepon }}</td>
                                <td>
                                    @if ($dokters->gambarProfil)
    <img src="{{ asset('storage/' . $dokters->gambarProfil) }}" alt="Foto Dokter" class="img-thumbnail" style="width: 80px;">
@else
    <span class="text-muted">Tidak ada</span>
@endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('admin.data_dokter.edit', $dokters->idDokter) }}"
                                            data-hari="{{ $dokters->jadwaldokters->first()->hari->idHari ?? '' }}"
                                            data-jam="{{ $dokters->jadwaldokters->first()->waktu->idWaktu ?? '' }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.data_dokter.delete', $dokters->idDokter) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus Data Dokter ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
