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
          <li class="link"><a href="{{ url('/') }}">Beranda</a></li>
          <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
          <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
          <li class="link"><a href="{{ url('/') }}">Alur Pelayanan</a></li>
          <li class="link"><a href="{{ url('/aduanmasyarakat') }}">Pengaduan</a></li>
          <li class="link">
            <a href="{{ url('/login') }}" class="btn-link">
              <button class="btn">Login</button>
            </a>
          </li>
          <li class="link">
            <a href="{{ url('/register') }}" class="btn-link">
              <button class="btn">Daftar</button>
            </a>
          </li>
        </ul>
      </nav>
    </header>

<!-- Pengaduan Section -->
<section class="pengaduan-container">
    <div class="pengaduan-form">
      <h2>Form Pengaduan</h2>
      <form action="{{ url('/submit-pengaduan') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama" placeholder="Isi Nama Lengkap" required />
        
        <div class="phone-input">
          <input type="text" value="+62" disabled class="phone-code" />
          <input type="tel" name="phone" placeholder="Nomor Telepon" required />
        </div>

        <select name="jenis_pengaduan" required>
          <option value="" disabled selected>Pilih Jenis Pengaduan</option>
          <option value="pelayanan">Pelayanan</option>
          <option value="fasilitas">Fasilitas</option>
          <option value="dokter">Dokter</option>
        </select>

        <textarea name="message" placeholder="Message" rows="4" required></textarea>

        <label for="gambar">Upload Gambar (optional):</label>
        <input type="file" id="gambar" name="gambar" accept="image/*" />

        <button type="submit" class="btn">Kirim Pengaduan</button>
      </form>
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

<br>
<br>

<!--Footer-->
<footer class="footer">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="footer__logo">
          <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo"> Puskesmas Kraksaan</a>
        </div>
        <p>
          layanan digital seperti jadwal praktik dokter, 
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
