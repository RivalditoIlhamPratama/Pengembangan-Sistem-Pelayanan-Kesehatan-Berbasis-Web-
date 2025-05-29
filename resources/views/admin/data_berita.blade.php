@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4 fw-bold">Data Berita</h2>

        <!-- Pencarian dan Tombol Tambah -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="input-group w-25">
                <input type="text" class="form-control" placeholder="Search">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="btn btn-primary" onclick="toggleForm()">
                <i class="fas fa-plus"></i> Tambah Berita
            </button>
        </div>

        <!-- FORM INPUT BERITA (TERSEMBUNYI) -->
        <div id="formBerita" class="mb-4" style="display: none;">
            <form>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required>
                </div>

                <div class="mb-3">
                    <label for="isi" class="form-label">Isi Berita</label>
                    <textarea class="form-control" id="isi" name="isi" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>

                <button type="submit" class="btn btn-success">Save</button>
            </form>
            <hr>
        </div>

        <!-- DATA BERITA -->
        @php
            $berita = [
                [
                    'tanggal' => '2015-12-23',
                    'judul' => 'facebook form login',
                    'isi' => 'Who doesnt know facebook ?...'
                ],
                [
                    'tanggal' => '2015-12-22',
                    'judul' => 'WYSIWYG Web Editor',
                    'isi' => 'tes ajalah....'
                ],
                [
                    'tanggal' => '2015-08-17',
                    'judul' => 'How to create facebook form login',
                    'isi' => 'Web applications still use the...'
                ],
                [
                    'tanggal' => '2015-08-03',
                    'judul' => 'How to create facebook form login',
                    'isi' => '// onPaste callback$j...'
                ],
            ];
        @endphp

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Judul</th>
                    <th>Isi Berita</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($berita as $b)
                    <tr>
                        <td>{{ $b['tanggal'] }}</td>
                        <td>{{ $b['judul'] }}</td>
                        <td>{{ Str::limit($b['isi'], 30) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary">✏️</button>
                            <button type="button" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
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
        form.style.display = (form.style.display === 'none') ? 'block' : 'none';
    }
</script>
@endsection
