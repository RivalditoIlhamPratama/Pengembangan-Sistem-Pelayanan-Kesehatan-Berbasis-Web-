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
        <td>{{ Str::limit($b->isiBerita, 50) }}</td>
        <td>
            @if ($b->gambarBerita)
                <img src="{{ asset('storage/' . $b->gambarBerita) }}" width="80" class="img-thumbnail">
            @else
                <span class="text-muted">Tidak Ada</span>
            @endif
        </td>
        <td class="text-center">
            <div class="btn-group" role="group">
                <!-- Tombol Edit -->
                <button class="btn btn-outline-warning btn-sm me-1"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $b->idBerita }}">
                    <i class="fas fa-edit"></i> Edit
                </button>

                <!-- Modal Edit -->
                <div class="modal fade" id="editModal{{ $b->idBerita }}" tabindex="-1" aria-labelledby="editModalLabel{{ $b->idBerita }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ route('admin.berita.update', $b->idBerita) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $b->idBerita }}">Edit Berita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Berita</label>
                                        <input type="date" class="form-control" name="tanggalBerita" value="{{ $b->tanggalBerita }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Berita</label>
                                        <input type="text" class="form-control" name="judulBerita" value="{{ $b->judulBerita }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Isi Berita</label>
                                        <textarea class="form-control" name="isiBerita" rows="5" required>{{ $b->isiBerita }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Gambar (Opsional)</label>
                                        <input type="file" class="form-control" name="gambarBerita">
                                        @if ($b->gambarBerita)
                                            <img src="{{ asset('storage/' . $b->gambarBerita) }}" width="100" class="mt-2">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.berita.destroy', $b->idBerita) }}" method="POST" class="d-inline"
                      onsubmit="confirmDelete(event, this)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus Berita">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </form>
            </div>
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


  @section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, form) {
        event.preventDefault(); // Mencegah form langsung submit

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Lanjutkan submit
            }
        });
    }
</script>
@endsection

@endsection
