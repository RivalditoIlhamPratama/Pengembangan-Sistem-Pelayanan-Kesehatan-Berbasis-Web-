@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h3 class="mb-4">Form Edit Dokter</h3>

            <form id="editDataDokter" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.data_dokter.update', ['id' => $dokter->idDokter]) }}">
                @csrf
                @method('PUT')

                <input type="hidden" id="editId" name="id" value="{{ $dokter->idDokter }}">

                <div class="mb-3">
                    <label for="editNamaDokter" class="form-label">Nama Dokter</label>
                    <input type="text" class="form-control" id="editNamaDokter" name="namaDokter"
                        value="{{ old('namaDokter', $dokter->namaDokter) }}" required>
                    @error('namaDokter')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="editSpesialis" class="form-label">Spesialis</label>
                    <input type="text" class="form-control" id="editSpesialis" name="spesialis"
                        value="{{ old('spesialis', $dokter->spesialis) }}" required>
                    @error('spesialis')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Hari Praktek --}}
                <div class="mb-3">
                    <label for="hariPraktek" class="form-label">Hari Praktek</label>
                    <select id="hariPraktek" name="hariPraktek[]" multiple class="form-control">
                        @foreach ($hari as $h)
                            <option value="{{ $h->idHari }}"
                                {{ in_array($h->idHari, old('hariPraktek', $dokter->jadwaldokters->pluck('Hari_id')->toArray())) ? 'selected' : '' }}>
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
                    @error('jamPraktek')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                    @error('jenisKelamin')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="editTglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="editTglLahir" name="tglLahir"
                        value="{{ old('tglLahir', $dokter->tglLahir) }}" required>
                    @error('tglLahir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="editAlamatDokter" class="form-label">Alamat Dokter</label>
                    <input type="text" class="form-control" id="editAlamatDokter" name="alamatDokter"
                        value="{{ old('alamatDokter', $dokter->alamatDokter) }}" required>
                    @error('alamatDokter')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="editNoTelepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="editNoTelepon" name="noTelepon"
                        value="{{ old('noTelepon', $dokter->noTelepon) }}">
                    @error('noTelepon')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="editGambarProfil" class="form-label">Foto Profil</label>
                    <img src="{{ asset('storage/' . $dokter->gambarProfil) }}" alt="Gambar Profil">
                    <input type="file" id="editGambarProfil" name="gambarProfil" accept="image/*" capture="environment">
                    @error('gambarProfil')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.data_dokter') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Initialize TomSelect with tag-like behavior
        new TomSelect('#hariPraktek', {
            plugins: ['remove_button'],
            create: false, // Disable creating new items
            placeholder: 'Pilih hari praktek',
            maxItems: 5, // Maximum number of selected items
            searchField: ['text'], // Enable search within the dropdown
            items: 3, // Number of items to display before scrolling
            render: {
                item: function(data, escape) {
                    return '<div class="p-1 bg-gray-300 rounded-full text-sm mr-1 mb-1 text-center">' +
                        escape(data.text) +
                        ' <span class="text-xs text-gray-600 cursor-pointer" onclick="this.parentElement.remove()">x</span></div>';
                },
                option: function(data, escape) {
                    return '<div class="p-2 hover:bg-gray-100">' + escape(data.text) + '</div>';
                }
            }
        });
    </script>
@endpush
