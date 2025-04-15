@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Dokter</h2>

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
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label class="form-label">ID Dokter</label>
                        <input type="text" class="form-control" id="editId" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" id="editNama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialis</label>
                        <input type="text" class="form-control" id="editSpesialis">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="editKelamin">
                            <option value="Laki Laki">Laki Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jadwal</label>
                        <input type="text" class="form-control" id="editJadwal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="editTelepon">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Edit -->
<script>
document.querySelectorAll(".edit-btn").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById("editId").value = this.getAttribute("data-id");
        document.getElementById("editNama").value = this.getAttribute("data-nama");
        document.getElementById("editSpesialis").value = this.getAttribute("data-spesialis");
        document.getElementById("editKelamin").value = this.getAttribute("data-kelamin");
        document.getElementById("editJadwal").value = this.getAttribute("data-jadwal");
        document.getElementById("editTelepon").value = this.getAttribute("data-telepon");
    });
});
</script>

@endsection
