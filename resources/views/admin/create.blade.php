@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Form Tambah Pengguna</h2>

            @if (session('success') && url()->previous() !== url()->current())
                <div class="alert alert-success" id="success-alert">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        const alert = document.getElementById('success-alert');
                        if (alert) alert.style.display = 'none';
                    }, 4000); // sembunyikan alert setelah 4 detik
                </script>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pengguna.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Pengguna</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama pengguna" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email (Opsional)</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email"
                        value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="Masukkan username" value="{{ old('username') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan password" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role" onchange="toggleKlinikSelect()">
                        <option selected disabled>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="dokter" {{ old('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
                        <option value="klinik" {{ old('role') == 'klinik' ? 'selected' : '' }}>Klinik</option>
                    </select>
                </div>

                <div class="mb-3" id="klinik-select" style="display: none;">
                    <label for="klinik_id" class="form-label">Pilih Klinik</label>
                    <select class="form-select" id="klinik_id" name="klinik_id">
                        <option selected disabled>Pilih Klinik</option>
                        @foreach ($kliniks as $klinik)
                            <option value="{{ $klinik->idKlinik }}"
                                {{ old('klinik_id') == $klinik->idKlinik ? 'selected' : '' }}>
                                {{ $klinik->namaKlinik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3" id="spesialis-select" style="display: none;">
                    <label for="spesialis" class="form-label">Spesialis</label>
                    <input type="text" class="form-control" name="spesialis" id="spesialis"
                        placeholder="Contoh: Umum, Gigi, Anak, dll">
                </div>

                <div class="mb-3" id="hari-select" style="display: none;">
                    <label for="hariPraktek" class="form-label">Hari Praktek</label>
                    <select id="hariPraktek" name="hariPraktek[]" multiple class="form-control" style="display:none;">
                        @foreach ($hari as $h)
                            <option value="{{ $h->idHari }}">
                                {{ $h->namaHari }}
                            </option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-3" id="jam-select" style="display: none;">
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

                <div class="mb-3" id="jenisKelamin-select" style="display: none;">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-control" id="jenisKelamin" name="jenisKelamin" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3" id="lahir-select" style="display: none;">
                    <label for="tglLahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tglLahir" id="tglLahir">
                </div>

                <div class="mb-3" id="alamat-select" style="display: none;">
                    <label for="alamatDokter" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamatDokter" name="alamatDokter" rows="2"
                        placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <div class="mb-3" id="telp-select" style="display: none;">
                    <label for="noTelepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="noTelepon" id="noTelepon"
                        placeholder="Contoh: 081234567890">
                </div>

                <div class="mb-3" id="gambar-select" style="display: none;">
                    <label for="gambarProfil" class="form-label">Foto</label>
                    <input type="file" id="gambarProfil" name="gambarProfil" accept="image/*" capture="environment">
                </div>

                <script>
                    function toggleKlinikSelect() {
                        const role = document.getElementById('role').value;
                        const klinikSelect = document.getElementById('klinik-select');
                        const spesialisSelect = document.getElementById('spesialis-select');
                        const hariSelect = document.getElementById('hari-select');
                        const jamSelect = document.getElementById('jam-select');
                        const jenisKelaminSelect = document.getElementById('jenisKelamin-select');
                        const lahirSelect = document.getElementById('lahir-select');
                        const alamatSelect = document.getElementById('alamat-select');
                        const telpSelect = document.getElementById('telp-select');
                        const gambarSelect = document.getElementById('gambar-select');
                
                        if (role === 'dokter') {
                            klinikSelect.style.display = 'block';
                            spesialisSelect.style.display = 'block';
                            hariSelect.style.display = 'block';
                            jamSelect.style.display = 'block';
                            jenisKelaminSelect.style.display = 'block';
                            lahirSelect.style.display = 'block';
                            alamatSelect.style.display = 'block';
                            telpSelect.style.display = 'block';
                            gambarSelect.style.display = 'block';
                        } else {
                            // SEMBUNYIKAN SEMUA FIELD TAMBAHAN
                            klinikSelect.style.display = 'none';
                            spesialisSelect.style.display = 'none';
                            hariSelect.style.display = 'none';
                            jamSelect.style.display = 'none';
                            jenisKelaminSelect.style.display = 'none';
                            lahirSelect.style.display = 'none';
                            alamatSelect.style.display = 'none';
                            telpSelect.style.display = 'none';
                            gambarSelect.style.display = 'none';
                
                            // KOSONGKAN NILAI-NILAI FIELD TAMBAHAN
                            document.getElementById('klinik_id').selectedIndex = 0;
                            document.getElementById('spesialis').value = '';
                            document.getElementById('jenisKelamin').value = '';
                            document.getElementById('tglLahir').value = '';
                            document.getElementById('alamatDokter').value = '';
                            document.getElementById('noTelepon').value = '';
                            document.getElementById('gambarProfil').value = '';
                            if (window.hariSelect) {
                                hariSelect.tomselect.clear(); // reset TomSelect
                            }
                        }
                    }
                
                    // Jalankan saat halaman dimuat
                    window.onload = toggleKlinikSelect;
                </script>
                


                <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>

            </form>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
        <script>
            const hariSelect = new TomSelect('#hariPraktek', {
                plugins: ['remove_button'],
                create: false,
                placeholder: 'Pilih hari praktek',
                searchField: ['text'],
                items: 3,
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

            // Clear any pre-selected items on page load
            hariSelect.clear(true);
        </script>
    @endpush
@endsection
