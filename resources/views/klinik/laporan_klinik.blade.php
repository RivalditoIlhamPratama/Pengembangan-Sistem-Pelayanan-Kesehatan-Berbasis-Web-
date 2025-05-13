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
                <button id="exportPdf" class="btn btn-danger d-flex align-items-center gap-1">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </button>
                <button id="exportExcel" class="btn btn-success d-flex align-items-center gap-1">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table id="rekamMedisTable" class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pasien</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Diagnosa</th>
                        <th>Nama Klinik</th>
                        <th>Nama Dokter</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan as $lap)
                        <tr>
                            <td>{{$lap->idLaporan}}</td>
                            <td>{{$lap->rekam_medis->tanggalPeriksa}}</td>
                            <td>{{$lap->rekam_medis->namaPasien}}</td>
                            <td>{{$lap->rekam_medis->NIK}}</td>
                            <td>{{$lap->rekam_medis->alamatPasien}}</td>
                            <td>{{$lap->rekam_medis->diagnosaMedis}}</td>
                            <td>{{optional($lap->rekam_medis->dokter)->namaDokter ?? optional($lap->rekam_medis->staffrekammedis)->namaStaff ?? ''}}</td>
                            <td>{{$lap->klinik->namaKlinik}}</td>
                            <td>
                            <button class="btn btn-sm btn-info detail-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                data-id="{{$lap->idLaporan}}"
                                data-nama="{{$lap->rekam_medis->namaPasien}}"
                                data-nik="{{$lap->rekam_medis->NIK}}"
                                data-alamat="{{$lap->rekam_medis->alamatPasien}}"
                                data-diagnosa="{{$lap->rekam_medis->diagnosaMedis}}"
                                data-klinik="{{$lap->klinik->namaKlinik}}"
                                data-dokter="{{optional($lap->rekam_medis->dokter)->namaDokter ?? optional($lap->rekam_medis->staffrekammedis)->namaStaff ?? ''}}"
                                data-tanggal="{{$lap->rekam_medis->tanggalPeriksa}}">
                                <i class="fas fa-info-circle"></i> Detail
                            </button>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL DETAIL Laporan Tindakan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Laporan Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printArea">
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
                    <h4>Formulir Laporan Tindakan</h4>
                    <p><strong>No Laporan:</strong> <span id="detailId"></span></p>
                    <p><strong>Tanggal Laporan:</strong> <span id="detailTanggal"></span></p>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">A. Laporan Tindakan Klinik</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Nama Pasien :</strong></td>
                            <td id="detailNama"></td>
                        </tr>
                        <tr>
                            <td><strong>NIK :</strong></td>
                            <td id="detailNik"></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat :</strong></td>
                            <td id="detailAlamat"></td>
                        </tr>
                        <tr>
                            <td><strong>Diagnosa :</strong></td>
                            <td id="detailDiagnosa"></td>
                        </tr>
                        <tr>
                            <td><strong>Nama Klinik :</strong></td>
                            <td id="detailKlinik"></td>
                        </tr>
                        <tr>
                            <td><strong>Nama Dokter :</strong></td>
                            <td id="detailDokter"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <button id="printDetail" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<script>
// Modifying table and export functionality
document.querySelectorAll(".detail-btn").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById("detailId").innerText = this.getAttribute("data-id");
        document.getElementById("detailNama").innerText = this.getAttribute("data-nama");
        document.getElementById("detailNik").innerText = this.getAttribute("data-nik");
        document.getElementById("detailAlamat").innerText = this.getAttribute("data-alamat");
        document.getElementById("detailDiagnosa").innerText = this.getAttribute("data-diagnosa");
        document.getElementById("detailKlinik").innerText = this.getAttribute("data-klinik");
        document.getElementById("detailDokter").innerText = this.getAttribute("data-dokter");
        document.getElementById("detailTanggal").innerText = this.getAttribute("data-tanggal");
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

// Export PDF
document.getElementById("exportPdf").addEventListener("click", function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text("Laporan Tindakan Klinik", 14, 10);
    doc.autoTable({
        html: "#rekamMedisTable",
        startY: 20,
        theme: 'striped',
        headStyles: { fillColor: [22, 160, 133] },
        bodyStyles: { fontSize: 10 }
    });

    doc.save("Laporan_Tindakan.pdf");
});

// Export Excel
document.getElementById("exportExcel").addEventListener("click", function() {
    let table = document.getElementById("rekamMedisTable");
    let wb = XLSX.utils.book_new();
    let ws = XLSX.utils.table_to_sheet(table);

    XLSX.utils.book_append_sheet(wb, ws, "Laporan Tindakan");
    XLSX.writeFile(wb, "Laporan_Tindakan.xlsx");
});
</script>

@endsection
