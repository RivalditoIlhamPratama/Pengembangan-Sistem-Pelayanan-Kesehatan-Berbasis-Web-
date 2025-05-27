@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h3 class="mb-4">Form Edit Dokter</h3>

            <form id="editDataDokter" method="POST"
                action="{{ route('admin.data_dokter.update', ['id' => $dokter->idDokter]) }}">
                @csrf

                <input type="hidden" id="editId" name="id" value="{{ $dokter->idDokter }}">

                <div class="mb-3">
                    <label for="editNamaDokter" class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" id="editNamaDokter" name="namaDokter"
                        value="{{ old('namaDokter', $dokter->namaDokter) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editSpesialis" class="form-label">Spesialis</label>
                    <input type="text" class="form-control" id="editSpesialis" name="spesialis"
                        value="{{ old('spesialis', $dokter->spesialis) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editHariPraktek" class="form-label">Hari Praktek</label>
                    <select class="form-select" id="editHariPraktek" name="hariPraktek" required>
                        <option value="">Pilih Hari</option>
                        @foreach ($hari as $h)
                            <option value="{{ $h->idHari }}"
                                {{ old('hariPraktek', $dokter->jadwaldokters->first()->hari->idHari ?? '') == $h->idHari ? 'selected' : '' }}>
                                {{ $h->namaHari }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="editJamPraktek" class="form-label">Jam Praktek</label>
                    <select class="form-select" id="editJamPraktek" name="jamPraktek" required>
                        <option value="">Pilih Jam</option>
                        @foreach ($waktu as $w)
                            @php $jam = $w->jamMulai . ' - ' . $w->jamSelesai; @endphp
                            <option value="{{ $w->idWaktu }}"
                                {{ old('jamPraktek', $dokter->jadwaldokters->first()->waktu->idWaktu ?? '') == $w->idWaktu ? 'selected' : '' }}>
                                {{ $jam }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label for="editJenisKelaminDokter" class="form-label">Jenis Kelamin Dokter</label>
                    <select class="form-select" id="editJenisKelaminDokter" name="jenisKelamin" required>
                        <option value="" disabled>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki"
                            {{ old('jenisKelamin', $dokter->jenisKelamin) == 'Laki Laki' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ old('jenisKelamin', $dokter->jenisKelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="editTglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="editTglLahir" name="tglLahir"
                        value="{{ old('tglLahir', $dokter->tglLahir) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editAlamatDokter" class="form-label">Alamat Dokter</label>
                    <input type="text" class="form-control" id="editAlamatDokter" name="alamatDokter"
                        value="{{ old('alamatDokter', $dokter->alamatDokter) }}" required>
                </div>

                <div class="mb-3">
                    <label for="editNoTelepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="editNoTelepon" name="noTelepon"
                        value="{{ old('noTelepon', $dokter->noTelepon) }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.data_dokter') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Edit modal population for edit_dokter form
            document.querySelectorAll(".btn-warning").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const row = this.closest("tr");
                    const id = this.getAttribute("href").split('/').pop();

                    // Set form action URL for edit_dokter form
                    const form = document.getElementById("editDataDokter");
                    form.action = `/admin/data-dokter/update/${id}`;

                    // Populate form fields
                    document.getElementById("editId").value = id;
                    document.getElementById("editNamaDokter").value = row.querySelector(
                        "td:nth-child(2)").innerText.trim();
                    document.getElementById("editSpesialis").value = row.querySelector(
                        "td:nth-child(3)").innerText.trim();
                    document.getElementById("editTglLahir").value = row.querySelector(
                        "td:nth-child(5)").innerText.trim();
                    document.getElementById("editAlamatDokter").value = row.querySelector(
                        "td:nth-child(6)").innerText.trim();
                    document.getElementById("editNoTelepon").value = row.querySelector(
                        "td:nth-child(7)").innerText.trim();
                    document.getElementById("editHariPraktek").value = this.getAttribute(
                        "data-hari");
                    document.getElementById("editJamPraktek").value = this.getAttribute("data-jam");

                    // Populate jenis kelamin select
                    const kelamin = this.getAttribute("data-kelamin");
                    const selectKelamin = document.getElementById("editJenisKelaminDokter");
                    if (kelamin === "Laki laki" || kelamin === "Perempuan") {
                        selectKelamin.value = kelamin;
                    } else {
                        selectKelamin.value = "";
                    }

                    // Show modal
                    var editModal = new bootstrap.Modal(document.getElementById(
                        'editDataDokterModal'));
                    editModal.show();
                });
            });
        });
    </script>
@endsection
