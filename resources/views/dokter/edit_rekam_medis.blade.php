@extends('layouts.dokter')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Rekam Medis</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.rekam_medis.update', $rekammedis->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="noRm" class="form-label">No RM</label>
            <input type="text" class="form-control" id="noRm" name="noRm" value="{{ old('noRm', $rekammedis->noRm) }}" required>
        </div>

        <div class="mb-3">
            <label for="namaPasien" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" id="namaPasien" name="namaPasien" value="{{ old('namaPasien', $rekammedis->namaPasien) }}" required>
        </div>

        <div class="mb-3">
            <label for="NIK" class="form-label">NIK</label>
            <input type="text" class="form-control" id="NIK" name="NIK" value="{{ old('NIK', $rekammedis->NIK) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamatPasien" class="form-label">Alamat Pasien</label>
            <input type="text" class="form-control" id="alamatPasien" name="alamatPasien" value="{{ old('alamatPasien', $rekammedis->alamatPasien) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggalPeriksa" class="form-label">Tanggal Periksa</label>
            <input type="date" class="form-control" id="tanggalPeriksa" name="tanggalPeriksa" value="{{ old('tanggalPeriksa', $rekammedis->tanggalPeriksa) }}" required>
        </div>

        <div class="mb-3">
            <label for="tekananDarah" class="form-label">Tekanan Darah</label>
            <input type="text" class="form-control" id="tekananDarah" name="tekananDarah" value="{{ old('tekananDarah', $rekammedis->tekananDarah) }}" required>
        </div>

        <div class="mb-3">
            <label for="RR" class="form-label">RR</label>
            <input type="text" class="form-control" id="RR" name="RR" value="{{ old('RR', $rekammedis->RR) }}" required>
        </div>

        <div class="mb-3">
            <label for="nadi" class="form-label">Nadi</label>
            <input type="text" class="form-control" id="nadi" name="nadi" value="{{ old('nadi', $rekammedis->nadi) }}" required>
        </div>

        <div class="mb-3">
            <label for="suhu" class="form-label">Suhu</label>
            <input type="text" class="form-control" id="suhu" name="suhu" value="{{ old('suhu', $rekammedis->suhu) }}" required>
        </div>

        <div class="mb-3">
            <label for="tinggiBadan" class="form-label">Tinggi Badan</label>
            <input type="text" class="form-control" id="tinggiBadan" name="tinggiBadan" value="{{ old('tinggiBadan', $rekammedis->tinggiBadan) }}" required>
        </div>

        <div class="mb-3">
            <label for="beratBadan" class="form-label">Berat Badan</label>
            <input type="text" class="form-control" id="beratBadan" name="beratBadan" value="{{ old('beratBadan', $rekammedis->beratBadan) }}" required>
        </div>

        <div class="mb-3">
            <label for="diagnosaMedis" class="form-label">Diagnosa Medis</label>
            <textarea class="form-control" id="diagnosaMedis" name="diagnosaMedis" rows="3" required>{{ old('diagnosaMedis', $rekammedis->diagnosaMedis) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Rekam Medis</button>
        <a href="{{ route('dokter.rekam_medis') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
