@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Rekam Medis</h2>


        <!-- Pencarian dan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div>
                <a href="{{ route('dokter.tambah_rekam_medis') }}" class="btn btn-primary">
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
                            ['RM01', '315237128', '2025-01-10', 'Tn. A', 'Dr. Maya Rahma', '36.8°C', '120/80 mmHg', '75 bpm', '170 cm', '65 kg', 'Sehat'],
                            ['RM02', '315237129', '2025-01-11', 'Ny. B', 'Dr. Alamsyah Teguh', '37.5°C', '130/85 mmHg', '78 bpm', '165 cm', '60 kg', 'Flu'],
                            ['RM03', '315237130', '2025-02-01', 'Tn. C', 'Dr. Hargianto', '39.2°C', '140/90 mmHg', '82 bpm', '175 cm', '80 kg', 'Demam'],
                            ['RM04', '315237131', '2025-02-05', 'Ny. D', 'Dr. Sheila Aqillah', '37.0°C', '125/85 mmHg', '76 bpm', '160 cm', '58 kg', 'Hipertensi'],
                            ['RM05', '315237132', '2025-03-01', 'Tn. E', 'Dr. Bima Saptaji', '38.5°C', '135/80 mmHg', '80 bpm', '168 cm', '72 kg', 'Diabetes'],
                            ['RM06', '315237133', '2025-03-10', 'Tn. F', 'Dr. Maya Rahma', '36.9°C', '120/85 mmHg', '74 bpm', '172 cm', '66 kg', 'Sehat'],
                            ['RM07', '315237134', '2025-03-15', 'Ny. G', 'Dr. Alamsyah Teguh', '37.8°C', '128/86 mmHg', '79 bpm', '163 cm', '62 kg', 'Tonsilitis'],
                        ];
                    @endphp

                    @foreach($rekamMedis as $data)
                    <tr class="align-middle text-center">
                        <td>{{ $data[0] }}</td>
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
                            <button class="btn btn-sm btn-info detail-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal"
                                data-no="{{ $data[0] }}" data-nik="{{ $data[1] }}" data-date="{{ $data[2] }}"
                                data-pasien="{{ $data[3] }}" data-dokter="{{ $data[4] }}" data-suhu="{{ $data[5] }}"
                                data-td="{{ $data[6] }}" data-nadi="{{ $data[7] }}" data-tb="{{ $data[8] }}"
                                data-bb="{{ $data[9] }}" data-diagnosa="{{ $data[10] }}">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
</script>

@endsection


