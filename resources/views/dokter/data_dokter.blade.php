@extends('layouts.dokter')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h4 class="fw-bold mb-4">Profil Dokter</h4>
        <form method="POST" action="{{ route('dokter.data_dokter.update') }}">
            @csrf
            <div class="row">
                <!-- Icon Dokter -->
                <div class="col-md-4 text-center d-flex justify-content-center align-items-center">
                    <i class="ri-user-3-line" style="font-size: 100px; color: #6c757d;"></i>
                </div>

                <!-- Form Input -->
                <div class="col-md-8">
                    <input type="hidden" name="idDokter" value="{{ $dokter->idDokter }}">

                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <input type="text" class="form-control" name="namaDokter" value="{{ $dokter->namaDokter }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialis</label>
                        <input type="text" class="form-control" name="spesialis" value="{{ $dokter->spesialis }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hari Praktek</label>
                        <select class="form-select" name="hariPraktek">
                            <option value="">Pilih Hari</option>
                            @foreach($hari as $h)
                                <option value="{{ $h->namaHari }}" {{ strpos($dokter->jadwalPraktek, $h->namaHari) !== false ? 'selected' : '' }}>
                                    {{ $h->namaHari }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Praktek</label>
                        <select class="form-select" name="jamPraktek">
                            <option value="">Pilih Jam</option>
                            @foreach($waktu as $w)
                                @php $jam = $w->jamMulai . ' - ' . $w->jamSelesai; @endphp
                                <option value="{{ $jam }}" {{ strpos($dokter->jadwalPraktek, $jam) !== false ? 'selected' : '' }}>
                                    {{ $jam }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggalLahir" value="{{ $dokter->tanggalLahir ?? '' }}">
                    </div>

                    <div class="d-flex gap-2 mt-2">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
