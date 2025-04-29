<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="register-container">
        
        <!-- Tambahkan Logo di sini -->
        <div class="logo-container">
            <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas Kraksaan" class="logo-img">
        </div>
        
        <h2>Buat Akun Baru</h2>
        
        <form>
            <label for="nama">Nama</label>
            <input type="text" id="nama" placeholder="">

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="">

            <label for="password">Password</label>
            <input type="password" id="password" placeholder="">

            <label for="konfirmasi">Konfirmasi Password</label>
            <input type="password" id="konfirmasi" placeholder="">

            <label for="role">Daftar Sebagai</label>
            <input type="text" id="role" placeholder="Pasien" disabled>

            <button type="submit" class="btn-daftar">Daftar</button>
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
        </form>
    </div>
</body>
</html>
