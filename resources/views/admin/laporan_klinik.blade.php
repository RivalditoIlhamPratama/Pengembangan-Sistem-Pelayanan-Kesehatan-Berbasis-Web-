@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Laporan Klinik</h2>

            <!-- Tombol Export -->
            <!-- Tombol Export -->
            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-4">
                {{-- Search --}}
                <form method="GET" action="{{ url('/admin/laporan-klinik') }}" class="d-flex w-25">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari nama pasien..."
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                {{-- Export Buttons --}}
                <div class="d-flex gap-2">
                    <a id="exportPdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <button id="exportExcel" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </button>
                </div>
            </div>




            <!-- Tabel Data Laporan Klinik -->
            <div class="table-responsive">
                <table id="laporanTable" class="table table-striped table-bordered table-hover" id="laporanTable">
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
                <h5 class="modal-title" id="modalLabel{{ $lap->idLaporan }}">Detail Laporan Klinik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div id="printArea{{ $lap->idLaporan }}">
                    <p><strong>Klinik:</strong> {{ $lap->klinik->namaKlinik }}</p>
                    <p><strong>Nama Pasien:</strong>
                        {{ optional($lap->rekam_medis)->namaPasien ?? ($lap->namaPasien ?? '-') }}
                    </p>
                    <p><strong>Alamat Pasien:</strong>
                        {{ optional($lap->rekam_medis)->alamatPasien ?? ($lap->alamatPasien ?? '-') }}
                    </p>
                    <p><strong>Diagnosa:</strong>
                        {{ optional($lap->rekam_medis)->diagnosaMedis ?? ($lap->diagnosaMedis ?? '-') }}
                    </p>
                    <p><strong>Deskripsi Tindakan:</strong> {{ $lap->deskripsi_tindakan ?? '-' }}</p>
                    <p><strong>Dokter / Petugas:</strong>
                        {{ optional(optional($lap->rekam_medis)->dokter)->namaDokter ??
                            (optional(optional($lap->rekam_medis)->staffrekammedis)->namaStaff ?? ($lap->namaDokter ?? '-')) }}
                    </p>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="printModalContent({{ $lap->idLaporan }})">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
            
        </div>
    </div>
</div>
<!-- End Modal -->

                        @endforeach
                    </tbody>
                </table>
                {{ $laporan->links('vendor.pagination.bootstrap-5') }}
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

            <script>
                document.getElementById("exportExcel").addEventListener("click", function() {
                    const wb = XLSX.utils.book_new();
                    const wsData = [];

                    const headerCells = document.querySelectorAll("#laporanTable thead th");
                    const headers = Array.from(headerCells).slice(0, 6).map(cell => cell.innerText.trim()); // Skip aksi
                    wsData.push(headers);

                    document.querySelectorAll("#laporanTable tbody tr").forEach((row) => {
                        if (row.style.display !== "none") {
                            const rowData = [];
                            row.querySelectorAll("td").forEach((cell, index) => {
                                if (index < 6) rowData.push(cell.innerText.trim());
                            });
                            wsData.push(rowData);
                        }
                    });

                    const ws = XLSX.utils.aoa_to_sheet(wsData);
                    XLSX.utils.book_append_sheet(wb, ws, "Data Laporan Klinik");

                    const today = new Date().toISOString().slice(0, 6);
                    XLSX.writeFile(wb, `Data_Laporan_Klinik_${today}.xlsx`);
                });

                document.getElementById("exportPdf").addEventListener("click", function() {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();

                    doc.text("Laporan Klinik", 14, 10);

                    const headers = [];
                    document.querySelectorAll("#laporanTable thead th").forEach((th, index) => {
                        // Skip kolom aksi terakhir
                        if (index < 6) headers.push(th.innerText);
                    });

                    const data = [];
                    document.querySelectorAll("#laporanTable tbody tr").forEach((row) => {
                        if (row.style.display !== "none") {
                            const rowData = [];
                            row.querySelectorAll("td").forEach((cell, index) => {
                                if (index < 6) rowData.push(cell.innerText.trim()); // skip aksi
                            });
                            data.push(rowData);
                        }
                    });

                    doc.autoTable({
                        head: [headers],
                        body: data,
                        startY: 20
                    });

                    const today = new Date().toISOString().slice(0, 10);
                    doc.save(`Data_Rekam_Medis_${today}.pdf`);
                });
            </script>
        

        <script>
            function printModalContent(id) {
                const content = document.getElementById('printArea' + id).innerHTML;
                const printWindow = window.open('', '', 'height=600,width=800');
        
                printWindow.document.write('<html><head><title>Cetak Detail Laporan</title>');
                printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
                printWindow.document.write('</head><body>');
                printWindow.document.write('<h4 class="text-center mb-4">Detail Laporan Klinik</h4>');
                printWindow.document.write('<div class="container">' + content + '</div>');
                printWindow.document.write('</body></html>');
        
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            }
        </script>
        
        @endsection
