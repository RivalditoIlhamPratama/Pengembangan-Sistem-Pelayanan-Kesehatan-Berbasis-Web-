<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
  />
  <link rel="stylesheet" href="{{ asset('assets/berita.css') }}">
  <script src="{{ asset('assets/main.js') }}" defer></script>
  <title>Puskesmas Kraksaan</title>
</head>
<body>
    <header class="header mt-0">
        <nav class="mt-0">
            <div class="nav__header">
            <div class="nav__logo">
                <a href="{{ url('/') }}"><img src="assets/11.png" alt="logo" />Puskesmas Kraksaan</a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <span><i class="ri-menu-line"></i></span>
            </div>
            </div>
            <ul class="nav__links" id="nav-links">
                @if(auth()->check() && auth()->user()->role === 'pasien')
                <li class="link"><a href="{{ route('pasien.dashboard') }}">Beranda</a></li>
                <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                <li class="link"><a href="{{ url('/') }}">Alur Pelayanan</a></li>
                @endif
                @if(!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                <li class="link"><a href="{{ url('/') }}">Beranda</a></li>
                <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                <li class="link"><a href="{{ url('/') }}">Alur Pelayanan</a></li>
                @endif
                <li class="link"><a class="@unless(auth()->check() && auth()->user()->role === 'pasien') disabled-link @endunless" href="{{ url('/aduanmasyarakat') }}">Pelayanan</a></li>
                @if(!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                <li class="link">
                    <a href="{{ url('/login') }}" class="btn-link">
                    <button class="btn">Login</button>
                    </a>
                </li>
                
                </li>
                @endif
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

    <section class="news-section">
        <article class="main-content">
          <h1>Puskesmas Kraksaan Kini Buka Layanan USG bagi Ibu Hamil</h1>
          <div class="meta">
            <span>📅 6 Februari 2025</span>

          </div>
          <img src="assets/berita.jpg" alt="Foto kegiatan">
          <p><strong>Probolinggo, 06 Februari 2025</strong> - Dalam rangka memperingati Hari Kanker Sedunia, Tim Promosi Kesehatan Rumah Sakit (PKRS) mengadakan penyuluhan edukasi tentang kanker payudara di ruang tunggu pasien poli bedah pada Kamis (06/02). Dengan menghadirkan dr. Syahrudi, Sp.B sebagai narasumber.</p>
          <p>dr. Syahrudi, Sp.B, memberikan penjelasan mengenai kanker payudara. Dalam paparannya, dr. Syahrudi menjelaskan tentang faktor risiko, gejala, metode deteksi dini, serta langkah-langkah pencegahan kanker payudara. Ia juga menekankan pentingnya kesadaran akan pemeriksaan payudara sendiri (SADARI) sebagai salah satu upaya deteksi dini.</p>
          <p>"Deteksi dini kanker payudara sangat penting karena semakin cepat ditemukan, semakin besar peluang untuk mendapatkan pengobatan yang efektif," ujar dr. Syahrudi, Sp.B.</p>
          <p>Peserta penyuluhan, yang terdiri dari pasien dan keluarga pendamping, tampak aktif dalam sesi tanya jawab. Mereka mengajukan berbagai pertanyaan seputar kanker payudara, termasuk mengenai pengobatan yang tersedia dan pola hidup sehat.</p>
          <p>Dengan adanya kegiatan ini, diharapkan semakin banyak masyarakat yang memiliki pemahaman lebih baik tentang kanker payudara dan pentingnya deteksi dini.</p>
        </article>

        
    
        <aside class="sidebar">
          <h3>Berita Sebelumnya</h3>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>RSUD Waluyo Jati Mengucapkan Selamat Menunaikan Ibadah Puasa Ramadhan 1446 H</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>HARI ULANG TAHUN RSUD WALUYO JATI KE 43</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>Penandatanganan Perjanjian Kerja Sama RSUD Waluyo Jati & Universitas Hafshawaty</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>Operasi Gratis Bibir Sumbing & Celah Langit-langit oleh Smile Train</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>RSUD Waluyo Jati Mengucapkan Selamat Menunaikan Ibadah Puasa Ramadhan 1446 H</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>HARI ULANG TAHUN RSUD WALUYO JATI KE 43</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>Penandatanganan Perjanjian Kerja Sama RSUD Waluyo Jati & Universitas Hafshawaty</p>
          </div>
          <div class="news-item">
            <img src="assets/berita.jpg" alt="">
            <p>Operasi Gratis Bibir Sumbing & Celah Langit-langit oleh Smile Train</p>
          </div>
        </aside>
      </section>

      <button onclick="goBack()" class="btn btn-back">Kembali</button>
      <script>
        function goBack() {
          window.history.back();
        }
      </script>


    <br>
    <br>
    <br>
    <!--Footer-->
    <footer class="footer">
            <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                <a href="#"><img src="assets/11.png" alt="logo" />Puskesmas Kraksaan</a>
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
            <div class="footer__col">
                <h4>Alamat</h4>
                <div class="footer__links">
                  <a href="https://maps.app.goo.gl/5LGfjh614MNkghsi8">Alamat Detail</a>
                </div>
              </div>
              <div class="footer__col">
                <h4>Contact</h4>
                <div class="footer__links">
                  <a href="#">Contact Us</a>
                </div>
              </div> 
            </div>
            <div class="footer__bar">
            Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
            </div>
    </footer>
      <!--End Footer-->

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>
</html>
