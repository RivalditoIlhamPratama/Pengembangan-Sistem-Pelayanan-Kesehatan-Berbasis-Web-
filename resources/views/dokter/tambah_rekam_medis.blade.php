@extends('layouts.dokter')

@section('content')
<div class="container-fluid mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Tambah Rekam Medis</h2>

        <!-- Form Tambah Rekam Medis -->
        <form action="#" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">No RM</label>
                    <input type="text" class="form-control" placeholder="No RM">
                </div>
                <div class="col-md-4">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" placeholder="NIK">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" placeholder="Nama Pasien">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal Periksa</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text"  class="form-control" value="{{ $dokter->namaDokter }}" readonly />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2">
                    <label for="suhuInput" class="form-label mb-2">Suhu</label>
                    <div class="input-group">
                        <input id="suhuInput" type="number" class="form-control text-center" placeholder="Suhu" value="0" min="0" max="100" step="1" readonly>
                        <div class="d-flex flex-column-reverse p-1">
                            <button type="button" class="btn btn-outline-primary btn-suhu-arrow" onclick="changeValue(-1)" aria-label="Decrease Suhu">&#x25BC;</button>
                            <button type="button" class="btn btn-outline-primary btn-suhu-arrow" onclick="changeValue(1)" aria-label="Increase Suhu">&#x25B2;</button>
                        </div>
                    </div>

                    <style>
                        #suhuInput {
                            width: 100px;
                        }
                        .btn-suhu-arrow {
                            padding: 0.2rem 0.4rem;
                            font-size: 0.8rem;
                            line-height: 1;
                            width: 100%;
                            text-align: center;
                        }
                    </style>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tekanan Darah</label>
                    <input type="text" class="form-control" placeholder="Tekanan Darah">
                </div>
                <div class="col-md-2">
                    <label class="form-label">RR</label>
                    <input type="text" class="form-control" placeholder="RR">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Nadi</label>
                    <input type="text" class="form-control" placeholder="Nadi">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Tinggi Badan</label>
                    <input type="text" class="form-control" placeholder="Tinggi Badan">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Berat Badan</label>
                    <input type="text" class="form-control" placeholder="Berat Badan">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea class="form-control" rows="3" placeholder="Diagnosa"></textarea>
            </div>

            <!-- Tombol Simpan & Batal -->
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <a href="{{ route('dokter.rekam_medis') }}" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    function changeValue(delta) {
        const input = document.getElementById('suhuInput');
        let currentValue = parseInt(input.value) || 0;
        let newValue = currentValue + delta;
        if (newValue < parseInt(input.min)) {
            newValue = parseInt(input.min);
        }
        if (newValue > parseInt(input.max)) {
            newValue = parseInt(input.max);
        }
        input.value = newValue;
    }
</script>
