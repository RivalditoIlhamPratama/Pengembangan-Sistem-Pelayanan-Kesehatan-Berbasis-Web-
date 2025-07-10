@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Pengaduan</h2>
            

            @if ($pengaduan->isEmpty())
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="input-group w-25">
                        <input type="text" class="form-control" placeholder="Search">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <p>Tidak ada data Pengaduan.</p>
            @else
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="input-group w-25">
                        <input type="text" class="form-control" placeholder="Search">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Tabel Data Pengaduan -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Pengadu</th>
                                <th>Jenis Pengaduan</th>
                                <th>Isi Pengaduan</th>
                                <th>No Telepon</th>
                                <th>Tanggal</th>
                                <th>Gambar Pengaduan</th>
                                <th>✓ Dilihat</th> {{-- Tambahan kolom --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaduan as $aduan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $aduan->pasien->namaPasien ?? 'N/A' }}</td>
                                    <td>{{ $aduan->jenisPengaduan }}</td>
                                    <td>{{ $aduan->isiPengaduan }}</td>
                                    <td>{{ $aduan->phone }}</td>
                                    <td>{{ \Carbon\Carbon::parse($aduan->created_at)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        @if ($aduan->gambarPengaduan)
                                        <img src="{{ asset('storage/' . $aduan->gambarPengaduan) }}"
                                        alt="Gambar Pengaduan"
                                        class="img-thumbnail"
                                        style="max-width: 100px; max-height: 100px; cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#gambarModal"
                                        onclick="showGambar('{{ asset('storage/' . $aduan->gambarPengaduan) }}')">
                                   
                                        @else
                                            <span>Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="text-center" id="status-dilihat-{{ $aduan->idPengaduan }}">
                                        <span class="badge bg-secondary">Belum Dilihat</span>
                                    </td>
                                    
                                    
                                    <td class="text-center">
                                        @php
                                            $nohp = preg_replace(
                                                '/^0/',
                                                '62',
                                                preg_replace('/[^0-9]/', '', $aduan->phone),
                                            );
                                            $pesan = urlencode(
                                                "Halo *{$aduan->pasien->namaPasien}*, kami telah menerima pengaduan Anda mengenai *{$aduan->jenisPengaduan}*. Terima kasih telah menghubungi Puskesmas Kraksaan.",
                                            );
                                        @endphp
                                    
                                    {{--
                                    <form action="{{ route('admin.pengaduan.destroy', $aduan->idPengaduan) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                    </button>
                                    </form>
                                    --}}

                                    
                                    
                                        @if ($aduan->phone)
                                            <a href="https://wa.me/{{ $nohp }}?text={{ $pesan }}"
                                                target="_blank" class="btn btn-sm btn-success" title="Kirim WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif
                                    
                                        @if ($aduan->pasien && $aduan->pasien->user)
                                        <a href="{{ route('admin.chat', ['userId' => $aduan->pasien->user->id_user]) }}"
                                            class="btn btn-sm btn-primary" title="Chat Admin"
                                            onclick="handleChatClick(event, '{{ $aduan->idPengaduan }}', '{{ route('admin.chat', ['userId' => $aduan->pasien->user->id_user]) }}')">
                                            <i class="ri-chat-3-line"></i>
                                         </a>
                                         
                                         
                                         
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Modal Gambar -->
<div class="modal fade" id="gambarModal" tabindex="-1" aria-labelledby="gambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img id="gambarPreview" src="" alt="Gambar Detail" class="img-fluid rounded">
        </div>
      </div>
    </div>
  </div>
  
        </div>
    </div>

    <script>
            // Jalankan saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function () {
        const STORAGE_KEY = 'pengaduan_terbaca';
        let terbacaList = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

        // Tampilkan status "Sudah Dilihat" hanya jika sudah pernah dibalas (klik chat)
        terbacaList.forEach(id => {
            const el = document.getElementById(`status-dilihat-${id}`);
            if (el) {
                el.innerHTML = '<span class="badge bg-success">Sudah Dilihat</span>';
                el.closest('tr').classList.add('table-success');
            }
        });
    });

    // Fungsi saat tombol Chat ditekan
    function handleChatClick(event, id, url) {
        event.preventDefault(); // Cegah redirect langsung

        const el = document.getElementById(`status-dilihat-${id}`);
        if (el) {
            el.innerHTML = '<span class="badge bg-success">Sudah Dilihat</span>';
            el.closest('tr').classList.add('table-success');

            const STORAGE_KEY = 'pengaduan_terbaca';
            let terbacaList = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

            if (!terbacaList.includes(id.toString())) {
                terbacaList.push(id.toString());
                localStorage.setItem(STORAGE_KEY, JSON.stringify(terbacaList));
            }
        }

        // Redirect ke halaman chat setelah status disimpan
        setTimeout(() => {
            window.location.href = url;
        }, 200); // Delay kecil agar efek perubahan terlihat
    }

        function showGambar(src) {
    const gambar = document.getElementById('gambarPreview');
    gambar.src = src;
}

function centangOtomatis(id) {
    const checkbox = document.getElementById(`checkbox-${id}`);
    if (checkbox && !checkbox.checked) {
        checkbox.checked = true;

        // Tambahkan warna hijau pada baris
        checkbox.closest('tr').classList.add('table-success');

        // Simpan status ke localStorage
        const STORAGE_KEY = 'pengaduan_terbaca';
        let terbacaList = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

        if (!terbacaList.includes(id.toString())) {
            terbacaList.push(id.toString());
            localStorage.setItem(STORAGE_KEY, JSON.stringify(terbacaList));
        }

        // Nonaktifkan checkbox agar tidak bisa diubah lagi
        checkbox.disabled = true;
    }
}

    </script>
@endsection
