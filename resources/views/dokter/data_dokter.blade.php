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
                    @php 
                        $dokterList = [
                            ['1', 'Dr Alamsyah Teguh', 'Umum', 'Laki Laki', 'Senin & Rabu, 08:00 - 12:00', '081234234223'],
                        ];
                    @endphp

                    @foreach($dokterList as $dokter)
                    <tr class="align-middle text-center">
                        <td>{{ $dokter[0] }}</td>
                        <td class="text-start">{{ $dokter[1] }}</td>
                        <td>{{ $dokter[2] }}</td>
                        <td>{{ $dokter[3] }}</td>
                        <td>{{ $dokter[4] }}</td>
                        <td>{{ $dokter[5] }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editModal"
                                data-id="{{ $dokter[0] }}"
                                data-nama="{{ $dokter[1] }}"
                                data-spesialis="{{ $dokter[2] }}"
                                data-kelamin="{{ $dokter[3] }}"
                                data-jadwal="{{ $dokter[4] }}"
                                data-telepon="{{ $dokter[5] }}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
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
