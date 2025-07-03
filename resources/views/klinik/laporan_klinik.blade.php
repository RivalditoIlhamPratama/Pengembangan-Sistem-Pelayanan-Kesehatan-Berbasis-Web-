@extends('layouts.klinik')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Laporan Tindakan</h2>

            <!-- Pencarian + Tombol -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <!-- Pencarian -->
                <div class="input-group w-25 mb-2 mb-md-0">
                    <input type="text" id="customSearchInput" class="form-control" placeholder="Search">
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
                            <th>Nama Dokter</th>
                            <th>Nama Klinik</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $lap)
                            <tr>
                                <td>{{ $loop->iteration }}</td> {{-- Nomor urut --}}
                                <td>{{ $lap->created_at ? $lap->created_at->format('Y-m-d') : '' }}</td>
                                <td>{{ $lap->rekam_medis ? $lap->rekam_medis->namaPasien : $lap->namaPasien }}</td>
                                <td>{{ $lap->rekam_medis ? $lap->rekam_medis->NIK : $lap->NIK }}</td>
                                <td>{{ $lap->rekam_medis ? $lap->rekam_medis->alamatPasien : $lap->alamatPasien }}</td>
                                <td>{{ $lap->rekam_medis ? $lap->rekam_medis->diagnosaMedis : $lap->diagnosaMedis }}</td>
                                <td>{{ optional($lap->rekam_medis)->dokter ? optional($lap->rekam_medis->dokter)->namaDokter : $lap->namaDokter ?? '' }}</td>
                                <td>{{ $lap->klinik->namaKlinik }}</td>
                                <td class="text-center">
                                    <!-- Tombol Detail -->
                                    <button class="btn btn-sm btn-info detail-btn" data-bs-toggle="modal"
                                        data-bs-target="#detailModal"
                                        data-id="{{ $lap->idLaporan }}"
                                        data-nama="{{ $lap->rekam_medis ? $lap->rekam_medis->namaPasien : $lap->namaPasien }}"
                                        data-nik="{{ $lap->rekam_medis ? $lap->rekam_medis->NIK : $lap->NIK }}"
                                        data-alamat="{{ $lap->rekam_medis ? $lap->rekam_medis->alamatPasien : $lap->alamatPasien }}"
                                        data-diagnosa="{{ $lap->rekam_medis ? $lap->rekam_medis->diagnosaMedis : $lap->diagnosaMedis }}"
                                        data-klinik="{{ $lap->klinik->namaKlinik }}"
                                        data-dokter="{{ optional($lap->rekam_medis)->dokter ? optional($lap->rekam_medis->dokter)->namaDokter : $lap->namaDokter ?? '' }}"
                                        data-tanggal="{{ $lap->created_at ? $lap->created_at->format('Y-m-d') : '' }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                    
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('klinik.laporan.edit', $lap->idLaporan) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('klinik.laporan.hapus', $lap->idLaporan) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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
                            <p>Jl. Mayjend Sungkono No.10, Patokan, Kec. Kraksaan, Kabupaten Probolinggo, Jawa Timur 67282
                            </p>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deleteButtons = document.querySelectorAll("form[method='POST'] button[type='submit'].btn-danger");
        
            deleteButtons.forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    const form = this.closest("form");
        
                    Swal.fire({
                        title: 'Yakin, data akan dihapus?',
                        text: "Tindakan ini tidak dapat dibatalkan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
        </script>
        
        
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
document.getElementById("exportPdf").addEventListener("click", function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const logoKiri = new Image();
    const logoKanan = new Image();
    logoKiri.src = "/assets/11.png";
    logoKanan.src = "/assets/dinas.png";

    logoKiri.onload = () => {
        logoKanan.onload = () => {
            doc.addImage(logoKiri, "PNG", 10, 10, 25, 25);
            doc.addImage(logoKanan, "PNG", 170, 10, 25, 25);
            doc.setFontSize(12);
            doc.setFont(undefined, "bold");
            doc.text("PEMERINTAH KABUPATEN PROBOLINGGO DINAS KESEHATAN", 105, 15, { align: "center" });
            doc.text("PUSKESMAS KRAKSAAN", 105, 22, { align: "center" });

            doc.setFontSize(10);
            doc.setFont(undefined, "normal");
            doc.text("Jl. Mayjend Sungkono No.10, Patokan, Kec. Kraksaan, Kabupaten Probolinggo,", 105, 28, { align: "center" });
            doc.text("Jawa Timur 67282", 105, 33, { align: "center" });
            doc.setLineWidth(0.5);
            doc.line(10, 38, 200, 38);
            doc.setFontSize(12);
            doc.setFont(undefined, "bold");
            doc.text("Laporan Tindakan Klinik", 105, 45, { align: "center" });

            const tableHeaders = [["No", "Tanggal", "Nama Pasien", "NIK", "Alamat", "Diagnosa", "Nama Dokter", "Nama Klinik"]];

            // Ambil hanya baris yang masih terlihat (tidak tersembunyi karena filter)
            const visibleRows = Array.from(document.querySelectorAll("#rekamMedisTable tbody tr"))
                .filter(row => row.style.display !== "none")
                .map(row => {
                    const cells = row.querySelectorAll("td");
                    return [
                        cells[0]?.innerText || "",
                        cells[1]?.innerText || "",
                        cells[2]?.innerText || "",
                        cells[3]?.innerText || "",
                        cells[4]?.innerText || "",
                        cells[5]?.innerText || "",
                        cells[6]?.innerText || "",
                        cells[7]?.innerText || ""
                    ];
                });

                doc.autoTable({
    head: tableHeaders,
    body: visibleRows,
    startY: 55,
    theme: "striped",
    headStyles: {
        fillColor: [0, 120, 250],
        textColor: [255, 255, 255],
        halign: 'center',
        valign: 'middle'
    },
    bodyStyles: {
        fontSize: 10,
        halign: 'left'
    },
});

// Tambahkan nama & TTD di pojok kanan bawah
doc.setFontSize(10);
doc.setFont(undefined, "normal");

const pageHeight = doc.internal.pageSize.height;
doc.text("Kraksaan, " + new Date().toLocaleDateString('id-ID'), 150, pageHeight - 40);
doc.text("Petugas Klinik", 150, pageHeight - 33);
doc.text("( Nama Petugas Klinik )", 150, pageHeight - 20);
doc.line(150, pageHeight - 22, 200, pageHeight - 22);

doc.save("Laporan_Tindakan.pdf");

        };
    };
});



document.getElementById("exportExcel").addEventListener("click", function () {
    const table = document.getElementById("rekamMedisTable");
    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.table_to_sheet(table, { raw: true });

    // Cek range data untuk memastikan baris dan kolom
    const range = XLSX.utils.decode_range(ws['!ref']);
    for (let row = range.s.r + 1; row <= range.e.r; ++row) {
        const nikCellRef = XLSX.utils.encode_cell({ r: row, c: 3 }); // kolom ke-4 = NIK
        const cell = ws[nikCellRef];

        if (cell && typeof cell.v !== 'undefined') {
            cell.v = cell.v.toString(); // ubah ke string
            cell.t = 's'; // pastikan tipe string
        }
    }

    XLSX.utils.book_append_sheet(wb, ws, "Laporan Tindakan");
    XLSX.writeFile(wb, "Laporan_Tindakan.xlsx");
});

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.getElementById("customSearchInput");
            const tableRows = document.querySelectorAll("#rekamMedisTable tbody tr");

            searchInput.addEventListener("keyup", function() {
                const searchText = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    if (rowText.includes(searchText)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>



@endsection
