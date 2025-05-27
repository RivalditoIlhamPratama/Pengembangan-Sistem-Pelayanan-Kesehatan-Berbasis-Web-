@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h3 class="mb-4">Form Tambah Dokter</h3>

            <form action="{{ route('admin.data_dokter.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="namaDokter" class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" name="namaDokter" id="namaDokter"
                        placeholder="Masukkan nama dokter">
                </div>

                <div class="mb-3">
                    <label for="spesialis" class="form-label">Spesialis</label>
                    <input type="text" class="form-control" name="spesialis" id="spesialis"
                        placeholder="Contoh: Umum, Gigi, Anak, dll">
                </div>

                <div class="mb-3">
                    <label class="form-label">Hari Praktek</label>
                    <select class="form-select" name="hariPraktek" required>
                        <option value="">Pilih Hari</option>
                        @foreach ($hari as $h)
                            <option value="{{ $h->idHari }}">
                                {{ $h->namaHari }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Praktek</label>
                    <select class="form-select" name="jamPraktek" required>
                        <option value="">Pilih Jam</option>
                        @foreach ($waktu as $w)
                            @php $jam = $w->jamMulai . ' - ' . $w->jamSelesai; @endphp
                            <option value="{{ $w->idWaktu }}">
                                {{ $jam }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tglLahir" id="tglLahir">
                </div>

                <div class="mb-3">
                    <label for="alamatDokter" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamatDokter" name="alamatDokter" rows="2"
                        placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="mb-3">
                    <label for="noTelepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="noTelepon" id="noTelepon"
                        placeholder="Contoh: 081234567890">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.data_dokter') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
