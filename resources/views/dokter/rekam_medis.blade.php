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
                <a href="{{route('dokter.tambah_rekam_medis')}}" class="btn btn-primary">
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
                <a href="{{route('dokter.tambah_rekam_medis')}}" class="btn btn-primary">
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
                        <td>{{ $rekam->rr }}</td>
                        <td>{{ $rekam->nadi }}</td>
                        <td>{{ $rekam->suhu }}</td>
                        <td>{{ $rekam->tinggiBadan }}</td>
                        <td>{{ $rekam->beratBadan }}</td>
                        <td>{{ $rekam->diagnosaMedis }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-info detail-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal"
                                    data-id="{{ $rekam->noRm }}"
                                    data-nama="{{ $rekam->namaPasien }}"
                                    data-alamat="{{ $rekam->alamatPasien }}"
                                    data-kelamin="{{ $rekam->jenisKelamin }}"
                                    data-usia="{{ $rekam->usiaPasien }}"
                                    data-agama="{{ $rekam->agamaPasien }}"
                                    data-pernikahan="{{ $rekam->statusPernikahan }}"
                                    data-nik="{{ $rekam->NIK }}"
                                    data-tanggal="{{ $rekam->tanggalPeriksa }}"
                                    data-penulis="{{ optional($rekam->dokter)->namaDokter ?? optional($rekam->staffrekammedis)->namaStaff }}"
                                    data-tekananDarah="{{ $rekam->tekananDarah }}"
                                    data-rr="{{ $rekam->rr }}"
                                    data-nadi="{{ $rekam->nadi }}"
                                    data-suhu="{{ $rekam->suhu }}"
                                    data-tinggi="{{ $rekam->tinggiBadan }}"
                                    data-berat="{{ $rekam->beratBadan }}"
                                    data-riwayat="{{ $rekam->riwayatPenyakit }}"
                                    data-diagnosa="{{ $rekam->diagnosaMedis }}"
                                    data-obat="{{ $rekam->resepObat }}">
                                    <i class="fas fa-eye"></i> Detail
                                </button>
                                <!-- Edit Button -->
                                <a href="{{ route('dokter.rekam_medis.edit', $rekam->idRekamMedis) }}" class="btn btn-sm btn-warning"
                                    data-alamat="{{ $rekam->alamatPasien }}"
                                    data-kelamin="{{ $rekam->jenisKelamin }}"
                                    data-riwayat="{{ $rekam->riwayatPenyakit }}"
                                    data-obat="{{ $rekam->resepObat }}"
                                    data-pernikahan="{{ $rekam->statusPernikahan }}"
                                    data-agama="{{ $rekam->agamaPasien }}"
                                    data-usia="{{ $rekam->usiaPasien }}">
                                    <i class="fas fa-edit"></i> Edit
                                 </a>
                                <!-- Delete Button -->
                                <form action="{{ route('dokter.rekam_medis.delete', $rekam->idRekamMedis) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekam medis ini?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@include('dokter.edit_rekam_medis')
<!-- MODAL DETAIL REKAM MEDIS -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Resume Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printArea">
                <!-- Print Layout -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <img src="{{ asset('assets/11.png') }}" alt="Puskesmas Logo" style="max-width: 100px;">
                    <div class="text-center ms-3">
                        <h5 class="mb-0">PEMERINTAH KABUPATEN PROBOLINGGO DINAS KESEHATAN </h5>
                        <h5 class="mb-0">PUSKESMAS KRAKSAAN</h5>
                        <p>Jl. Mayjend Sungkono No.10, Patokan, Kec. Kraksaan, Kabupaten Probolinggo, Jawa Timur 67282</p>
                    </div>
                    <img src="{{ asset('assets/dinas.png') }}" alt="Second Logo" style="max-width: 55px;">
                </div>
                <div class="text-center mb-4">
                    <hr>
                    <h4>Formulir Identitas Pasien</h4>
                    <p><strong>No RM:</strong> <span id="detailNo"></span></p>
                </div>
                <!-- Tabel A: Identitas Pasien -->
                <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                    <colgroup>
                        <col style="width: 22%;">
                        <col style="width: 60%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th colspan="2">A. Identitas Pasien</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Nama Pasien :</strong></td>
                            <td id="detailPasien"></td>
                        </tr>
                        <tr>
                            <td><strong>NIK Pasien :</strong></td>
                            <td id="detailNikPasien"></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat Pasien :</strong></td>
                            <td id="detailAlamat"></td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kelamin :</strong></td>
                            <td id="detailKelamin"></td>
                        </tr>
                        <tr>
                            <td><strong>Usia :</strong></td>
                            <td id="detailUsia"></td>
                        </tr>
                        <tr>
                            <td><strong>Agama :</strong></td>
                            <td id="detailAgama"></td>
                        </tr>
                        <tr>
                            <td><strong>Status Pernikahan :</strong></td>
                            <td id="detailStatusNikah"></td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Periksa :</strong></td>
                            <td id="detailDate"></td>
                        </tr>
                        <tr>
                            <td><strong>Penanggung Jawab :</strong></td>
                            <td id="detailPenanggungJawab"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tabel B: Pemeriksaan Fisik -->
                <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                    <colgroup>
                        <col style="width: 22%;">
                        <col style="width: 60%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th colspan="2">B. Pemeriksaan Fisik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Tekanan Darah :</strong></td>
                            <td id="detailTD"></td>
                        </tr>
                        <tr>
                            <td><strong>RR :</strong></td>
                            <td id="detailRR"></td>
                        </tr>
                        <tr>
                            <td><strong>Nadi :</strong></td>
                            <td id="detailNadi"></td>
                        </tr>
                        <tr>
                            <td><strong>Suhu :</strong></td>
                            <td id="detailSuhu"></td>
                        </tr>
                        <tr>
                            <td><strong>Tinggi Badan :</strong></td>
                            <td id="detailTB"></td>
                        </tr>
                        <tr>
                            <td><strong>Berat Badan :</strong></td>
                            <td id="detailBB"></td>
                        </tr>
                    </tbody>
                </table>
                <!-- Tabel C: Pemeriksaan & Tindakan -->
                <table class="table table-bordered" style="table-layout: fixed; width: 100%;">
                    <colgroup>
                        <col style="width: 22%;">
                        <col style="width: 60%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th colspan="2">C. Pemeriksaan dan Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Riwayat Penyakit :</strong></td>
                            <td id="detailRiwayat"></td>
                        </tr>
                        <tr>
                            <td><strong>Diagnosa Medis :</strong></td>
                            <td id="detailDiagnosa"></td>
                        </tr>
                        <tr>
                            <td><strong>Resep Obat :</strong></td>
                            <td id="detailResepObat"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <button id="printDetail" class="btn btn-primary print:hidden">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
// PDF EXPORT FILTERED
document.getElementById("exportPdf").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Data Rekam Medis", 14, 10);

    const headers = [];
    document.querySelectorAll("#rekamMedisTable thead th").forEach((th, index) => {
        // Skip kolom aksi terakhir
        if (index < 11) headers.push(th.innerText);
    });

    const data = [];
    document.querySelectorAll("#rekamMedisTable tbody tr").forEach((row) => {
        if (row.style.display !== "none") {
            const rowData = [];
            row.querySelectorAll("td").forEach((cell, index) => {
                if (index < 11) rowData.push(cell.innerText.trim()); // skip aksi
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
    doc.save(Data_Rekam_Medis_${today}.pdf);
});

// EXCEL EXPORT FILTERED
document.getElementById("exportExcel").addEventListener("click", function () {
    const wb = XLSX.utils.book_new();
    const wsData = [];

    const headerCells = document.querySelectorAll("#rekamMedisTable thead th");
    const headers = Array.from(headerCells).slice(0, 11).map(cell => cell.innerText.trim()); // Skip aksi
    wsData.push(headers);

    document.querySelectorAll("#rekamMedisTable tbody tr").forEach((row) => {
        if (row.style.display !== "none") {
            const rowData = [];
            row.querySelectorAll("td").forEach((cell, index) => {
                if (index < 11) rowData.push(cell.innerText.trim());
            });
            wsData.push(rowData);
        }
    });

    const ws = XLSX.utils.aoa_to_sheet(wsData);
    XLSX.utils.book_append_sheet(wb, ws, "Data Rekam Medis");

    const today = new Date().toISOString().slice(0, 10);
    XLSX.writeFile(wb, Data_Rekam_Medis_${today}.xlsx);
});




document.addEventListener("DOMContentLoaded", function() {
document.querySelectorAll(".detail-btn").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById("detailNo").innerText = this.getAttribute("data-id");
        document.getElementById("detailPasien").innerText = this.getAttribute("data-nama");
        document.getElementById("detailNikPasien").innerText = this.getAttribute("data-nik");
        document.getElementById("detailAlamat").innerText = this.getAttribute("data-alamat");
        document.getElementById("detailKelamin").innerText = this.getAttribute("data-kelamin");
        document.getElementById("detailUsia").innerText = this.getAttribute("data-usia");
        document.getElementById("detailAgama").innerText = this.getAttribute("data-agama");
        document.getElementById("detailStatusNikah").innerText = this.getAttribute("data-pernikahan");
        document.getElementById("detailDate").innerText = this.getAttribute("data-tanggal");
        const penulisName = this.getAttribute("data-penulis");
        document.getElementById("detailPenanggungJawab").innerText = penulisName;
        document.getElementById("detailTD").innerText = this.getAttribute("data-tekananDarah");
        document.getElementById("detailRR").innerText = this.getAttribute("data-rr");
        document.getElementById("detailNadi").innerText = this.getAttribute("data-nadi");
        document.getElementById("detailSuhu").innerText = this.getAttribute("data-suhu");
        document.getElementById("detailTB").innerText = this.getAttribute("data-tinggi");
        document.getElementById("detailBB").innerText = this.getAttribute("data-berat");
        document.getElementById("detailRiwayat").innerText = this.getAttribute("data-riwayat");
        document.getElementById("detailDiagnosa").innerText = this.getAttribute("data-diagnosa");
        document.getElementById("detailResepObat").innerText = this.getAttribute("data-obat");
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("rekamMedisTable").getElementsByTagName("tbody")[0];
        const searchButton = document.querySelector('.btn-outline-secondary');

        function filterTable() {
            const searchText = searchInput.value.toLowerCase();
            const rows = table.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const rowText = rows[i].innerText.toLowerCase();
                if (rowText.includes(searchText)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        // Trigger saat tombol klik
        searchButton.addEventListener("click", function() {
            filterTable();
        });

        // Opsional: Kalau mau auto filter sambil ngetik langsung (tanpa klik tombol)
        // searchInput.addEventListener("keyup", filterTable);
    });
    </script>


<!-- PDF: jsPDF dan autoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<!-- Excel: SheetJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

@endsection
