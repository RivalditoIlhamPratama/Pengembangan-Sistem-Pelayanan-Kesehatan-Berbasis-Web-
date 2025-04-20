<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <script src="{{ asset('assets/main.js') }}" defer></script>
    <title>Puskesmas Kraksaan</title>
  </head>
  <body>
    <header class="header">
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="{{ url('/') }}"><img src="assets/11.png" alt="logo" />Puskesmas Kraksaan</a>
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
          <li class="link"><a class="disabled-link" href="{{ url('/aduanmasyarakat') }}">Pengaduan</a></li>
          <li class="link">
            <a href="{{ route('login') }}" class="btn-link">
              <button class="btn">Login</button>
            </a>
          </li>
        </ul>
      </nav>
      <div class="section__container header__container" id="home">
        <div class="header__image">
          <img src="assets/icon Header.png" alt="header" />
        </div>
        <div class="header__content">
          <h4>Pelayanan Masyarakat</h4>
          <h1 class="section__header">Puskesmas Kraksaan</h1>
          <p>
            layanan digital seperti jadwal praktik dokter, daftar tenaga medis profesional,
            rincian tarif layanan, hingga artikel edukasi kesehatan yang bermanfaat.
          </p>

        </div>
      </div>
    </header>

    <!-- Service Section -->
    <div class="services-section">
      <h2>Layanan Unggulan Kami</h2><br>
      <p>Kami menyediakan berbagai layanan kesehatan digital untuk kenyamanan Anda, mulai dari pendaftaran dokter hingga edukasi kesehatan.</p>
      <br>
      <div class="services-container">
          <div class="service">
              <img src="{{ asset('assets/service 1.png') }}" alt="Pendaftaran Online">
              <h3>Daftar Dokter</h3>
              <p>berkonsultasi dengan dokter pilihan.</p>
          </div>
          <div class="service">
              <img src="{{ asset('assets/service 2.png') }}" alt="Jadwal Dokter">
              <h3>Jadwal Dokter</h3>
              <p>Lihat jadwal dokter </p>
          </div>
          <div class="service">
              <img src="{{ asset('assets/service 3.png') }}" alt="Pengaduan Online">
              <h3>Layanan Pengaduan</h3>
              <p>Laporkan keluhan </p>
          </div>
          <div class="service">
              <img src="{{ asset('assets/service 4.png') }}" alt="Edukasi Kesehatan">
              <h3>Edukasi Kesehatan</h3>
              <p>Dapatkan informasi kesehatan </p>
          </div>
      </div>
    </div>
    <!-- End Service Section -->

    <br>
    <br>

    <!--Data Dokter-->
        <!-- Card Dokter -->
        <h2>Dokter Puskesmas Kraksaan</h2> <br>
        <div class="doctor-card-container">
          <div class="doctor-card">
            <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Siti Jamila</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="assets/Dokter1.jpg" alt="Dr. Ni Made Maya" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Dwi Wahyudi</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="assets/dokter.png" alt="Dr. Muhammad Reza" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Heni Rahmawati(K)</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="assets/dokter.png" alt="Dr. Yessi Rahmawati" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Fathullah Wahyudi(K)</h3>
              <br>
              <p>Dokter Spesialis Obstetri </p>
              <br>

            </div>
          </div>


        </div>
        <!-- End Card Dokter -->
        <br>
        <br>
        <br>
        <br>


        <!-- Beita -->
        <div class="berita--container">
          <h2>Berita Terkait</h2>
          <p class="centered-text">Berita Berita Puskesmas Kraksaan Terbaru</p>
          <br>
          <br>
          <div class="berita-container">
              <div class="news-card">
                  <img src="assets/Berita.jpeg" alt="Puskesmas Image">
                  <div class="news-info">
                      <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                      <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                      <p class="date">Thursday, 21 November 2024</p>
                      <a href="#" class="read-more">Selengkapnya</a>
                  </div>
              </div>

              <!-- Repeat the news-card for other entries -->
              <div class="news-card">
                  <img src="assets/berita.jpg" alt="Puskesmas Image">
                  <div class="news-info">
                      <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                      <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                      <p class="date">Thursday, 21 November 2024</p>
                      <a href="{{ route('berita.usg') }}" class="read-more">Selengkapnya</a>

                  </div>
              </div>

              <!-- Repeat the news-card for other entries -->
              <div class="news-card">
                <img src="assets/Berita.jpeg" alt="Puskesmas Image">
                <div class="news-info">
                    <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                    <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                    <p class="date">Thursday, 21 November 2024</p>
                    <a href="#" class="read-more">Selengkapnya</a>
                </div>
            </div>


            <div class="news-card">
              <img src="assets/Berita.jpeg" alt="Puskesmas Image">
              <div class="news-info">
                  <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                  <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                  <p class="date">Thursday, 21 November 2024</p>
                  <a href="#" class="read-more">Selengkapnya</a>
              </div>
          </div>

          <div class="news-card">
            <img src="assets/Berita.jpeg" alt="Puskesmas Image">
            <div class="news-info">
                <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                <p class="date">Thursday, 21 November 2024</p>
                <a href="#" class="read-more">Selengkapnya</a>
            </div>
        </div>


        <div class="news-card">
          <img src="assets/Berita.jpeg" alt="Puskesmas Image">
          <div class="news-info">
              <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
              <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
              <p class="date">Thursday, 21 November 2024</p>
              <a href="#" class="read-more">Selengkapnya</a>
          </div>
      </div>

              <!-- Add more cards as needed -->
          </div>
      </div>

      <!-- End Berita -->

      <br>
      <br>
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
