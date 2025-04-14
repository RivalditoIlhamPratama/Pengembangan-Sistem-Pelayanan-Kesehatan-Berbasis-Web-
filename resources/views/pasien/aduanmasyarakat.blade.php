<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/aduanmasyarakat.css') }}">
    <title>Puskesmas Kraksaan</title>
</head>
<body>
<header class="header">
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo"> Puskesmas Kraksaan</a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <span><i class="ri-menu-line"></i></span>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li class="link"><a href="{{ route('pasien.dashboard') }}">Beranda</a></li>
            <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
            <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
            <li class="link"><a href="{{ url('/') }}">Alur Pelayanan</a></li>
            <li class="link"><a href="{{route('pasien.reports') }}">Pelayanan</a></li>
            @if(auth()->check() && auth()->user()->role === 'pasien')
            <li class="link">
                <div class="flex items-center space-x-4">
                    <button class="flex items-center space-x-3">
                        <i class="ri-user-fill text-xl"></i>
                        <span>{{ auth()->user()->name }}</span>
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-300">
                            <i class="ri-logout-box-r-line text-xl"></i>
                        </button>
                    </form>
                </div>
            </li>
            @endif
        </ul>
    </nav>
</header>

<!-- Pengaduan Section -->
<section class="pengaduan-container">
    <div class="pengaduan-form">
        <h2>Form Pengaduan</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success" style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(auth()->check() && auth()->user()->role === 'pasien')
        <form action="{{ route('pasien.reports.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" value="{{ auth()->user()->pasien->namaPasien ?? 'Nama Pasien' }}" readonly />

            <div class="phone-input">
                <input type="tel" name="phone" placeholder="Nomor Telepon"
                    value="{{ old('phone', '+62' . (auth()->user()->pasien->noHp ?? '')) }}" required />
            </div>

            <select name="jenis_pengaduan" required>
                <option value="" disabled {{ old('jenis_pengaduan') ? '' : 'selected' }}>Pilih Jenis Pengaduan</option>
                <option value="pelayanan" {{ old('jenis_pengaduan') == 'pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                <option value="fasilitas" {{ old('jenis_pengaduan') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                <option value="dokter" {{ old('jenis_pengaduan') == 'dokter' ? 'selected' : '' }}>Dokter</option>
            </select>

            <textarea name="aduan" placeholder="Isi Pengaduan" rows="4" required>{{ old('aduan') }}</textarea>

            <label for="gambar">Upload Gambar (optional):</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" />

            <button type="submit" class="btn">Kirim Pengaduan</button>
        </form>
        @endif
    </div>

    <div class="hubungi-kami">
        <h2>Hubungi Kami</h2>
        <div class="contact-info">
            <p><i class="ri-map-pin-line"></i> <strong>Lokasi:</strong><br>Jl. Mayjend Sungkono No.10, Kraksaan, Probolinggo</p>
            <p><i class="ri-mail-line"></i> <strong>Email:</strong><br>contact@puskesmaskraksaan.com</p>
            <p><i class="ri-phone-line"></i> <strong>Hubungi Kami:</strong><br>+628123123123</p>
        </div>
    </div>
</section>

<!-- Footer -->
<br><br>
<footer class="footer">
    <div class="section__container footer__container">
        <div class="footer__col">
            <div class="footer__logo">
                <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo"> Puskesmas Kraksaan</a>
            </div>
            <p>
                Layanan digital seperti jadwal praktik dokter,
                daftar tenaga medis profesional,
                rincian tarif layanan, hingga artikel
                edukasi kesehatan yang bermanfaat.
            </p>
            <div class="footer__socials">
                <a href="#"><i class="ri-facebook-fill"></i></a>
                <a href="#"><i class="ri-instagram-line"></i></a>
                <a href="#"><i class="ri-twitter-fill"></i></a>
            </div>
        </div>
    </div>
    <div class="footer__bar">
        Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
    </div>
</footer>

<script src="https://unpkg.com/scrollreveal"></script>
<script src="{{ asset('assets/main.js') }}"></script>
</body>
</html>
