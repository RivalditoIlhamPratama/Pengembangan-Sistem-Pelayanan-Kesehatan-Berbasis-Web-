<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Buat Akun</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            background-image: url('{{ asset('assets/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>


</head>

<body>
    <div class="register-container">
        <!-- Tambahkan Logo di sini -->
        <div class="logo-container d-flex justify-content-center mb-4">
            <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas Kraksaan" class="logo-img"
    style="max-width: 200px; width: 100%; height: auto;" />

        </div>

        <h2>Buat Akun Baru</h2>

        <form class="" method="POST" action="{{ route('register.post') }}">
            @csrf
            <label class="form-label" for="username">Nama Pasien</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="Username" required />
            <label class="form-label" for="jenisKelamin">Jenis Kelamin</label>
            <select class="form-control" name="jenisKelamin" id="jenisKelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label class="form-label" for="noHp">No HP</label>
            <input class="form-control" type="text" name="noHp" id="noHp" required>

            <label class="form-label" for="alamatPasien">Alamat</label>
            <input class="form-control" type="text" name="alamatPasien" id="alamatPasien" required>

            <label class="form-label" for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" required>

            <label class="form-label" for="password">Password</label>
            <div style="position: relative;">
                <input class="form-control" type="password" name="password" id="password" placeholder="password"
                    required style="padding-right: 30px;" />
            </div>

            <label for="password_confirmation">Konfirmasi Password</label>
            <div style="position: relative;">
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="password_confirmation" required style="padding-right: 30px;" />
            </div>

            <div class="hidden">
                <input type="text" name="role" id="role" value="pasien" required />
            </div>

            <button type="submit" class="btn-daftar">Daftar</button>
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
        </form>
    </div>
</body>

</html>
