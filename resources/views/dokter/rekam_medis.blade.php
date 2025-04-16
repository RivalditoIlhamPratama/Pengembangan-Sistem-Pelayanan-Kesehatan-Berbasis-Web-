@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Rekam Medis</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($rekammedis->isEmpty())
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                <button id="exportPdf" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button id="exportExcel" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>
            <p>Tidak ada data rekam medis.</p>
        @else
        <!-- Pencarian dan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div>
                <a href="#" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                <button id="exportPdf" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button id="exportExcel" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>
        <table id="rekamMedisTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>NIK</th>
                        <th>Tanggal Periksa</th>
                        <th>Tekanan Darah</th>
                        <th>RR</th>
                        <th>Nadi</th>
                        <th>Suhu</th>
                        <th>Tinggi Badan</th>
                        <th>Berat Badan</th>
                        <th>Diagnosa Medis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekammedis as $rekam)
                    <tr>
                        <td>{{ $rekam->noRm }}</td>
                        <td>{{ $rekam->namaPasien }}</td>
                        <td>{{ $rekam->NIK }}</td>
                        <td>{{ \Carbon\Carbon::parse($rekam->tanggalPeriksa)->format('d-m-Y') }}</td>
                        <td>{{ $rekam->tekananDarah }}</td>
                        <td>{{ $rekam->RR }}</td>
                        <td>{{ $rekam->nadi }}</td>
                        <td>{{ $rekam->suhu }}</td>
                        <td>{{ $rekam->tinggiBadan }}</td>
                        <td>{{ $rekam->beratBadan }}</td>
                        <td>{{ $rekam->diagnosaMedis }}</td>
                        <td>
                            <button class="btn btn-sm btn-info detail-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                data-id="{{ $rekam->noRm }}"
                                data-nama="{{ $rekam->namaPasien }}"
                                data-spesialis="{{ $rekam->NIK }}"
                                data-tanggal="{{ $rekam->tanggalPeriksa }}"
                                data-tekananDarah="{{ $rekam->tekananDarah ?? '' }}"
                                data-rr="{{ $rekam->RR ?? '' }}"
                                data-nadi="{{ $rekam->nadi ?? '' }}"
                                data-suhu="{{ $rekam->suhu ?? '' }}"
                                data-tinggi="{{ $rekam->tinggiBadan ?? '' }}"
                                data-berat="{{ $rekam->beratBadan ?? '' }}"
                                data-diagnosa="{{ $rekam->diagnosaMedis ?? '' }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<!-- MODAL DETAIL REKAM MEDIS -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Resume Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printArea">
                <div class="text-center mb-4">
                    <h3>Puskesmas kraksaan</h3>
                    <p>Jl. Mayjend Sungkono No.10, Patokan, Kec. Kraksaan, Kabupaten Probolinggo, Jawa Timur 67282</p>
                    <hr>
                    <h4>Resume Medis</h4>
                </div>
                <p><strong>Nomor MR:</strong> <span id="detailNo"></span></p>
                <p><strong>Nama:</strong> <span id="detailPasien"></span></p>
                <p><strong>Dokter:</strong> <span id="detailDokter"></span></p>
                <p><strong>Tanggal Pemeriksaan:</strong> <span id="detailDate"></span></p>
                <hr>
                <h5>Hasil Lab</h5>
                <p><strong>Tekanan Darah:</strong> <span id="detailTD"></span></p>
                <p><strong>RR:</strong> <span id="detailRR"></span></p>
                <p><strong>Suhu:</strong> <span id="detailSuhu"></span></p>
                <p><strong>Nadi:</strong> <span id="detailNadi"></span></p>
                <p><strong>Tinggi Badan:</strong> <span id="detailTB"></span></p>
                <p><strong>Berat Badan:</strong> <span id="detailBB"></span></p>
                <p><strong>Diagnosa:</strong> <span id="detailDiagnosa"></span></p>
                <button id="printDetail" class="btn btn-primary mt-3">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>
document.getElementById("exportPdf").addEventListener("click", function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Data Rekam Medis", 14, 10);
    doc.autoTable({ html: "#rekamMedisTable" });

    doc.save("Data_Rekam_Medis.pdf");
});

document.getElementById("exportExcel").addEventListener("click", function() {
    let table = document.getElementById("rekamMedisTable");
    let wb = XLSX.utils.book_new();
    let ws = XLSX.utils.table_to_sheet(table);

    XLSX.utils.book_append_sheet(wb, ws, "Data Rekam Medis");
    XLSX.writeFile(wb, "Data_Rekam_Medis.xlsx");
});


document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".detail-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("detailNo").innerText = this.getAttribute("data-id");
            document.getElementById("detailPasien").innerText = this.getAttribute("data-nama");
            document.getElementById("detailDokter").innerText = this.getAttribute("data-spesialis");
            document.getElementById("detailDate").innerText = this.getAttribute("data-tanggal"); // Catatan: ini nama atributnya aneh, lihat poin 3
            document.getElementById("detailTD").innerText = this.getAttribute("data-tekananDarah");
            document.getElementById("detailRR").innerText = this.getAttribute("data-rr");
            document.getElementById("detailNadi").innerText = this.getAttribute("data-nadi");
            document.getElementById("detailSuhu").innerText = this.getAttribute("data-suhu");
            document.getElementById("detailTB").innerText = this.getAttribute("data-tinggi");
            document.getElementById("detailBB").innerText = this.getAttribute("data-berat");
            document.getElementById("detailDiagnosa").innerText = this.getAttribute("data-diagnosa");
        });
    });
});

document.getElementById("printDetail").addEventListener("click", function() {
    let printContents = document.getElementById("printArea").innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // Reload to reset the view
});

</script>

@endsection
