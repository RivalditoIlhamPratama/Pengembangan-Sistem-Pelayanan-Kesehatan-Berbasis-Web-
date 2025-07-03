@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Laporan Klinik</h2>

            <!-- Tombol Export -->
            <!-- Tombol Export -->
            <div class="mb-4 d-flex justify-content-end gap-2">
                <a href="{{ url('/export-pdf') }}" target="_blank" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ url('/export-excel') }}" target="_blank" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>


            <!-- Pencarian -->
            <div class="d-flex justify-content-end mb-4">
                <div class="input-group w-25">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama pasien...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Tabel Data Laporan Klinik -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="laporanTable">
                    <thead class="table-light text-center">
                        <tr>
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
                        @foreach ($laporan as $lap)
                            <tr class="align-middle text-center">
                                <td>{{ $lap->idLaporan }}</td>
                                <td><strong class="text-primary">{{ $lap->klinik->namaKlinik }}</strong></td>
                                <td class="fw-bold">
                                    {{ optional($lap->rekam_medis)->tanggalPeriksa
                                        ? \Carbon\Carbon::parse($lap->rekam_medis->tanggalPeriksa)->format('d-m-Y')
                                        : $lap->created_at->format('d-m-Y') ?? '-' }}
                                </td>

                                <td class="nama-pasien">
                                    {{ optional($lap->rekam_medis)->namaPasien ?? ($lap->namaPasien ?? '-') }}
                                </td>

                                <td>
                                    {{ optional($lap->rekam_medis)->tindakan ?? ($lap->deskripsi_tindakan ?? '-') }}
                                </td>

                                <td class="fw-bold">
                                    {{ optional(optional($lap->rekam_medis)->dokter)->namaDokter ??
                                        (optional(optional($lap->rekam_medis)->staffrekammedis)->namaStaff ?? ($lap->namaDokter ?? '-')) }}
                                </td>


                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $lap->idLaporan }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>

                            <!-- Modal Detail (tidak berubah) -->
                            <div class="modal fade" id="modalDetail{{ $lap->idLaporan }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $lap->idLaporan }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $lap->idLaporan }}">Detail Laporan
                                                Klinik</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p><strong>Klinik:</strong> {{ $lap->klinik->namaKlinik }}</p>
                                            <p><strong>Tanggal Tindakan:</strong>
                                                {{ optional($lap->rekam_medis)->tanggalPeriksa
                                                    ? \Carbon\Carbon::parse($lap->rekam_medis->tanggalPeriksa)->format('d-m-Y')
                                                    : '-' }}
                                            </p>

                                            <p><strong>Nama Pasien:</strong>
                                                {{ optional($lap->rekam_medis)->namaPasien ?? ($lap->namaPasien ?? '-') }}
                                            </p>
                                            <p><strong>Alamat Pasien:</strong>
                                                {{ optional($lap->rekam_medis)->alamatPasien ?? ($lap->alamatPasien ?? '-') }}
                                            </p>
                                            <p><strong>Usia / Jenis Kelamin:</strong>
                                                {{ optional($lap->rekam_medis)->usiaPasien ?? '-' }} /
                                                {{ optional($lap->rekam_medis)->jenisKelamin ?? '-' }}
                                            </p>
                                            <p><strong>Diagnosa:</strong>
                                                {{ optional($lap->rekam_medis)->diagnosaMedis ?? ($lap->diagnosaMedis ?? '-') }}
                                            </p>
                                            <p><strong>Deskripsi Tindakan:</strong> {{ $lap->deskripsi_tindakan ?? '-' }}
                                            </p>
                                            <p><strong>Tindakan:</strong>
                                                {{ optional($lap->rekam_medis)->tindakan ?? '-' }}</p>
                                            <p><strong>Resep Obat:</strong>
                                                {{ optional($lap->rekam_medis)->resepObat ?? '-' }}</p>
                                            <p><strong>Dokter / Petugas:</strong>
                                                {{ optional(optional($lap->rekam_medis)->dokter)->namaDokter ??
                                                    (optional(optional($lap->rekam_medis)->staffrekammedis)->namaStaff ?? ($lap->namaDokter ?? '-')) }}

                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection

        @section('scripts')
            <script>
                document.getElementById('searchInput').addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#laporanTable tbody tr');

                    rows.forEach(function(row) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchValue) ? '' : 'none';
                    });
                });
            </script>
        @endsection
