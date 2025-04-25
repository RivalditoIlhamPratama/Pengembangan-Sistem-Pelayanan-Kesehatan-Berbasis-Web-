
<!-- MODAL EDIT REKAM MEDIS -->
<div class="modal fade" id="editRekamModal" tabindex="-1" aria-labelledby="editRekamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editRekamForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editRekamModalLabel">Edit Rekam Medis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editNoRm" class="form-label">No RM</label>
                        <input type="text" class="form-control" id="editNoRm" name="noRm" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaPasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="editNamaPasien" name="namaPasien" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAlamatPasien" class="form-label">Alamat Pasien</label>
                        <input type="text" class="form-control" id="editAlamatPasien" name="alamatPasien" required>
                    </div>
                    <div class="mb-3">
                        <label for="editJenisKelaminPasien" class="form-label">Jenis Kelamin Pasien</label>
                        <input type="text" class="form-control" id="editJenisKelaminPasien" name="jenisKelamin" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNIK" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="editNIK" name="NIK" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTanggalPeriksa" class="form-label">Tanggal Periksa</label>
                        <input type="date" class="form-control" id="editTanggalPeriksa" name="tanggalPeriksa" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTekananDarah" class="form-label">Tekanan Darah</label>
                        <input type="text" class="form-control" id="editTekananDarah" name="tekananDarah" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRR" class="form-label">RR</label>
                        <input type="text" class="form-control" id="editRR" name="RR" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNadi" class="form-label">Nadi</label>
                        <input type="text" class="form-control" id="editNadi" name="nadi" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSuhu" class="form-label">Suhu</label>
                    <div class="input-group">
                        <input name="suhu" id="editSuhu" type="number" class="form-control text-left" placeholder="Suhu" step="1" required >
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="editTinggiBadan" class="form-label">Tinggi Badan</label>
                    <div class="input-group">
                        <input name="tinggiBadan" id="editTinggiBadan" type="number" class="form-control text-left" placeholder="Tinggi Badan"  min="0" step="1"  required>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="editBeratBadan" class="form-label">Berat Badan</label>
                        <div class="input-group">
                            <input name="beratBadan" id="editBeratBadan" type="number" class="form-control text-left" placeholder="Berat Badan"  min="0" step="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editRiwayatPenyakit" class="form-label">Riwayat Penyakit</label>
                        <textarea class="form-control" id="editRiwayatPenyakit" name="riwayatPenyakit" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editDiagnosaMedis" class="form-label">Diagnosa Medis</label>
                        <textarea class="form-control" id="editDiagnosaMedis" name="diagnosaMedis" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Rekam Medis</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function() {
    // Existing detail modal code...

    // Edit modal population
            document.querySelectorAll(".btn-warning").forEach(button => {
                button.addEventListener("click", function(event) {
                    event.preventDefault();
                    const row = this.closest("tr");
                    const id = this.getAttribute("href").split('/').pop();

                    // Set form action URL
                    const form = document.getElementById("editRekamForm");
                    form.action = `/dokter/rekam_medis/update/${id}`;

                    // Populate form fields
                    document.getElementById("editId").value = id;
                    document.getElementById("editNoRm").value = row.querySelector("td:nth-child(1)").innerText.trim();
                    document.getElementById("editNamaPasien").value = row.querySelector("td:nth-child(2)").innerText.trim();
                    document.getElementById("editAlamatPasien").value = this.getAttribute("data-alamat");
                    document.getElementById("editJenisKelaminPasien").value = this.getAttribute("data-kelamin");
                    document.getElementById("editNIK").value = row.querySelector("td:nth-child(5)").innerText.trim();
                    // Convert date from d-m-Y to Y-m-d for input[type=date]
                    let dateText = row.querySelector("td:nth-child(4)").innerText.trim();
                    let parts = dateText.split("-");
                    if(parts.length === 3) {
                        let formattedDate = parts[2] + "-" + parts[1].padStart(2, '0') + "-" + parts[0].padStart(2, '0');
                        document.getElementById("editTanggalPeriksa").value = formattedDate;
                    } else {
                        document.getElementById("editTanggalPeriksa").value = "";
                    }
                    document.getElementById("editTekananDarah").value = row.querySelector("td:nth-child(5)").innerText.trim();
                    document.getElementById("editRR").value = row.querySelector("td:nth-child(6)").innerText.trim();
                    document.getElementById("editNadi").value = row.querySelector("td:nth-child(7)").innerText.trim();
                    document.getElementById("editSuhu").value = row.querySelector("td:nth-child(8)").innerText.trim();
                    document.getElementById("editTinggiBadan").value = row.querySelector("td:nth-child(9)").innerText.trim();
                    document.getElementById("editBeratBadan").value = row.querySelector("td:nth-child(10)").innerText.trim();
                    document.getElementById("editRiwayatPenyakit").value = this.getAttribute("data-riwayat");
                    document.getElementById("editDiagnosaMedis").value = row.querySelector("td:nth-child(11)").innerText.trim();
                    // Show modal
                    var editModal = new bootstrap.Modal(document.getElementById('editRekamModal'));
                    editModal.show();
                });
            });
});
</script>
