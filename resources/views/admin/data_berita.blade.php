@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 fw-bold">Data Berita</h2>

            <!-- Pencarian dan Tombol Tambah -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group w-25">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <div id="btnTambahBerita">
                    <button class="btn btn-primary" onclick="toggleForm()">
                        <i class="fas fa-plus"></i> Tambah Berita
                    </button>
                </div>
            </div>

            <!-- FORM INPUT BERITA (TERSEMBUNYI) -->
            <div id="formBerita" class="mb-4" style="display: none;">
                <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggalBerita" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalBerita" name="tanggalBerita" required>
                    </div>

                    <div class="mb-3">
                        <label for="judulBerita" class="form-label">Judul Berita</label>
                        <input type="text" class="form-control" id="judulBerita" name="judulBerita" placeholder="Judul"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="isiBerita" class="form-label">Isi Berita</label>
                        <textarea class="form-control" id="isiBerita" name="isiBerita" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="gambarBerita" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="gambarBerita" name="gambarBerita">
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleForm()">Cancel</button>
                </form>
                <hr>
            </div>

            <!-- DATA BERITA -->
            <!-- DATA BERITA -->
<table class="table table-bordered table-striped">
  <thead>
      <tr>
          <th>Tanggal</th>
          <th>Judul</th>
          <th>Isi Berita</th>
          <th>Gambar</th> {{-- Tambahkan kolom gambar --}}
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($berita as $b)
          <tr>
              <td>{{ $b->tanggalBerita }}</td>
              <td>{{ $b->judulBerita }}</td>
              <td>{{ Str::limit($b->isiBerita, 30) }}</td>
              <td>
                  @if($b->gambarBerita)
                      <img src="{{ asset('storage/' . $b->gambarBerita) }}" alt="Gambar Berita" width="80" class="img-thumbnail">
                  @else
                      <span class="text-muted">Tidak Ada</span>
                  @endif
              </td>
              <td>
                {{-- Tombol Edit --}}
                <button class="btn btn-outline-primary btn-sm rounded-circle shadow-sm"
                    data-bs-toggle="modal" data-bs-target="#editModal" title="Edit Pengaduan">
                    <i class="fas fa-pen"></i>
                </button>
            
                {{-- Tambahkan Form Hapus di bawahnya --}}
                <form action="{{ route('admin.berita.destroy', $b->idBerita) }}" method="POST" class="d-inline"

                    onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
            
          </tr>
      @endforeach
  </tbody>
</table>

        </div>
    </div>

    <!-- Script toggle -->
    <script>
        function toggleForm() {
            const form = document.getElementById('formBerita');
            const table = document.querySelector('table');
            const btnTambah = document.getElementById('btnTambahBerita');

            const isHidden = form.style.display === 'none' || form.style.display === '';

            form.style.display = isHidden ? 'block' : 'none';
            table.style.display = isHidden ? 'none' : 'table';
            btnTambah.style.display = isHidden ? 'none' : 'block';
        }
    </script>

    <!-- Modal Edit Berita -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Berita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="tanggalBerita" class="form-label">Tanggal Berita</label>
              <input type="date" class="form-control" id="tanggalBerita" value="2024-06-01">
            </div>
            <div class="mb-3">
              <label for="judulBerita" class="form-label">Judul Berita</label>
              <input type="text" class="form-control" id="judulBerita" value="Contoh Judul Berita">
            </div>
            <div class="mb-3">
              <label for="isiBerita" class="form-label">Isi Berita</label>
              <textarea class="form-control" id="isiBerita" rows="5">Isi berita yang akan diedit...</textarea>
            </div>
            <div class="mb-3">
              <label for="gambarBerita" class="form-label">Gambar (opsional)</label>
              <input type="file" class="form-control" id="gambarBerita">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
