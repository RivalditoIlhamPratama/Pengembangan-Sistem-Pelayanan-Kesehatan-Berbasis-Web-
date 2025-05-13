document.addEventListener("DOMContentLoaded", function () {
    const rekamSelect = document.getElementById("RekamMedis_id");
    const namaPasienInput = document.getElementById("namaPasien");
    const namaDokterInput = document.getElementById("namaDokter");
    const NIKInput = document.getElementById("NIK");
    const alamatPasienInput = document.getElementById("alamatPasien");
    const diagnosaInput = document.getElementById("diagnosa");

    rekamSelect.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        namaPasienInput.value =
            selectedOption.getAttribute("data-namapasien") || "";
        namaDokterInput.value =
            selectedOption.getAttribute("data-namadokter") || "";
        diagnosaInput.value =
            selectedOption.getAttribute("data-diagnosa") || "";
        NIKInput.value = selectedOption.getAttribute("data-nik") || "";
        alamatPasienInput.value =
            selectedOption.getAttribute("data-alamat") || "";
    });

    // Trigger change event on page load if a value is selected
    if (rekamSelect.value) {
        rekamSelect.dispatchEvent(new Event("change"));
    }
});
