@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Dokter</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Dokter -->
        <div class="table-responsive">
            <table id="dokterTable" class="table table-striped table-bordered table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Dokter</th>
                        <th>Spesialis</th>
                        <th>Jenis Kelamin</th>
                        <th>Jadwal</th>
                        <th>No Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle text-center">
                        <td>1</td>
                        <td class="text-start">{{ $dokter->namaDokter }}</td>
                        <td>{{ $dokter->spesialis }}</td>
                        <td>{{ $dokter->jenisKelamin }}</td>
                        <td>{{ $dokter->jadwalPraktek ?? '-' }}</td>
                        <td>{{ $dokter->noTelepon ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                                data-id="{{ $dokter->idDokter }}"
                                data-nama="{{ $dokter->namaDokter }}"
                                data-spesialis="{{ $dokter->spesialis }}"
                                data-kelamin="{{ $dokter->jenisKelamin }}"
                                data-jadwal="{{ $dokter->jadwalPraktek ?? '' }}"
                                data-telepon="{{ $dokter->noTelepon ?? '' }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL FORM EDIT -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST" action="{{ route('dokter.data_dokter.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">ID Dokter</label>
                            <input type="text" class="form-control" id="editId" name="idDokter" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Dokter</label>
                            <input type="text" class="form-control" id="editNama" name="namaDokter" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="editSpesialis" name="spesialis" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="editKelamin" name="jenisKelamin" required>
                                <option value="Laki Laki">Laki Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <select class="form-control" id="editHari" name="hariPraktek" required>
                                <option value="">Pilih Hari</option>
                                @foreach($hari as $h)
                                    <option value="{{ $h->namaHari }}">{{ $h->namaHari }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam</label>
                            <select class="form-control" id="editJam" name="jamPraktek" required>
                                <option value="">Pilih Jam</option>
                                @foreach($waktu as $w)
                                    <option value="{{ $w->jamMulai }} - {{ $w->jamSelesai }}">{{ $w->jamMulai }} - {{ $w->jamSelesai }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="editTelepon" name="noTelepon">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript untuk Edit -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function() {
            document.getElementById("editId").value = this.getAttribute("data-id");
            document.getElementById("editNama").value = this.getAttribute("data-nama");
            document.getElementById("editSpesialis").value = this.getAttribute("data-spesialis");
            // Set select value dynamically based on data-kelamin attribute
            document.getElementById("editKelamin").value = this.getAttribute("data-kelamin");
            // Parse jadwalPraktek string to set hari and jam selects
            let jadwal = this.getAttribute("data-jadwal");
            if (jadwal) {
                let parts = jadwal.split(' ');
                if (parts.length >= 2) {
                    document.getElementById("editHari").value = parts[0];
                    document.getElementById("editJam").value = parts.slice(1).join(' ');
                } else {
                    document.getElementById("editHari").value = jadwal;
                    document.getElementById("editJam").value = '';
                }
            } else {
                document.getElementById("editHari").value = '';
                document.getElementById("editJam").value = '';
            }
            document.getElementById("editTelepon").value = this.getAttribute("data-telepon");
        });
    });
});
</script>

@endsection
