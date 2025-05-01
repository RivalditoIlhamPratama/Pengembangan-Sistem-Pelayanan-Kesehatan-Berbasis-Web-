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
    <title>Puskesmas Kraksaan</title>
  </head>
  <body>
    <header class="header">
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="{{ route('pasien.dashboard') }}"><img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas Kraksaan</a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <span><i class="ri-menu-line"></i></span>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                <li class="link"><a href="{{ route('pasien.dashboard') }}">Beranda</a></li>
                <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                <li class="link"><a href="{{ url('/alur-pelayanan') }}">Alur Pelayanan</a></li>
                <li class="link"><a href="{{route('pasien.reports') }}">Pengaduan</a></li>
                @if(auth()->check() && auth()->user()->role === 'pasien')
                <li class="link">
                    <div class="user-action">
                        <span class="user-btn w-50">
                            <i class="ri-user-fill"></i> {{ auth()->user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="ri-logout-box-r-line"></i> Logout
                        </button>
                        </form>
                    </div>
                </li>
                @endif

            </ul>
        </nav>
      <div class="section__container header__container" id="home">
        <div class="header__image floating">
          <img src="{{ asset('assets/icon Header.png') }}" alt="header" />
        </div>       
        <div class="header__content">
          <h4>Pelayanan Masyarakat</h4>
          <h1 class="section__header">Puskesmas Kraksaan</h1>
          <p>
            layanan digital seperti jadwal praktik dokter,
            rincian tarif layanan, berita berita terkait puskesmas kraksaan
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
            <img src="{{ asset('assets/service 1.png') }}" alt="Pendaftaran Online" class="floating">
            <h3>Daftar Dokter</h3>
            <p>Dapat melihat dokter yang ada di puskesmas Kraksaan</p>
        </div>
        <div class="service">
            <img src="{{ asset('assets/service 2.png') }}" alt="Jadwal Dokter" class="floating">
            <h3>Jadwal Dokter</h3>
            <p>Lihat jadwal dokter</p>
        </div>
        <div class="service">
            <img src="{{ asset('assets/service 3.png') }}" alt="Pengaduan Online" class="floating">
            <h3>Layanan Pengaduan</h3>
            <p>Laporkan keluhan</p>
        </div>
        <div class="service">
            <img src="{{ asset('assets/service 4.png') }}" alt="Edukasi Kesehatan" class="floating">
            <h3>Berita Puskesmas</h3>
            <p>Dapatkan informasi kesehatan</p>
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
            <img src="{{ asset('assets/dokter.png') }}" alt="Dr. Komang Ayu" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Siti Jamila</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="{{ asset('assets/Dokter1.jpg') }}" alt="Dr. Ni Made Maya" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Dwi Wahyudi</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="{{ asset('assets/Kepalapuskesmas.png') }}" alt="Dr. Muhammad Reza" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Heni Rahmawati</h3>
              <br>
              <p>Dokter Spesialis Anak</p>
              <br>

            </div>
          </div>
          <div class="doctor-card">
            <img src="{{ asset('assets/dokter.png') }}" alt="Dr. Yessi Rahmawati" class="doctor-img" />
            <div class="doctor-info">
              <h3>dr. Fathullah Wahyudi</h3>
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
          <p class="centered-text">Berita Berita Puskesmas Kraksaan</p>
          <br>
          <br>
          <div class="berita-container">
              <div class="news-card">
                  <img src="{{ asset('assets/berita.slb.png') }}" alt="Puskesmas Image">
                  <div class="news-info">
                      <h3>Pemeriksaan Kesehatan di SLB Dharma Asih Kraksaan : Upaya Dini Deteksi Masalah Kesehatan Siswa
                      </h3>
                      <p>Kraksaan, 20 Agustus 2024 – Dalam rangka meningkatkan kesadaran akan pentingnya kesehatan sejak dini, Puskesmas..</p>
                      <p class="date">Thursday, 21 November 2024</p>
                      <a href="{{ route('berita.slb') }}" class="read-more">Selengkapnya</a>
                  </div>
              </div>

              <!-- Repeat the news-card for other entries -->
              <div class="news-card">
                  <img src="{{ asset('assets/berita.jpg') }}" alt="Puskesmas Image">
                  <div class="news-info">
                      <h3>Puskesmas Kraksaan Kini Buka Layanan USG bagi Ibu Hamil</h3>
                      <p>Pelayanan ibu hamil di Puskesmas Kraksaan semakin maksimal. Pasalnya, Puskesmas Kraksaan kini dilengkapi layanan USG......</p>
                      <p class="date">Thursday, 21 November 2024</p>
                      <a href="{{ route('berita.usg') }}" class="read-more">Selengkapnya</a>
                  </div>
              </div>

          <!-- Repeat the news-card for other entries -->
          <div class="news-card">
            <img src="{{ asset('assets/sosialisasi.vaksin.png') }}" alt="Puskesmas Image">
            <div class="news-info">
                <h3>Masifkan Sosialisasi Vaksin Melalui Video di Puskesmas</h3>
                <p>SDinas Kesehatan (Dinkes) Kabupaten Probolinggo berencana melakukan sosialisasi vaksin Covid-19 kepada masyarakat..</p>
                <p class="date">17 Jan 2021</p>
                <a href="{{ route('berita.vaksin') }}" class="read-more">Selengkapnya</a>
            </div>
        </div>


            <div class="news-card">
              <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
              <div class="news-info">
                  <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                  <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                  <p class="date">Thursday, 21 November 2024</p>
                  <a href="#" class="read-more">Selengkapnya</a>
              </div>
          </div>

          <div class="news-card">
            <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
            <div class="news-info">
                <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
                <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
                <p class="date">Thursday, 21 November 2024</p>
                <a href="#" class="read-more">Selengkapnya</a>
            </div>
        </div>


        <div class="news-card">
          <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
          <div class="news-info">
              <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
              <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
              <p class="date">Thursday, 21 November 2024</p>
              <a href="#" class="read-more">Selengkapnya</a>
          </div>
      </div>

      <div class="news-card">
        <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
        <div class="news-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
            <p class="date">Thursday, 21 November 2024</p>
            <a href="#" class="read-more">Selengkapnya</a>
        </div>
    </div>

    <div class="news-card">
      <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
      <div class="news-info">
          <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
          <p>SEMENTARA: Banner yang terpasang di pintu masuk Puskesmas Pakuriran. Puskesmas Pakuriran menutup layanan kesehatan...</p>
          <p class="date">Thursday, 21 November 2024</p>
          <a href="#" class="read-more">Selengkapnya</a>
      </div>
  </div>


  <div class="news-card">
    <img src="{{ asset('assets/Berita.jpeg') }}" alt="Puskesmas Image">
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
            <a href="#"> <img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas Kraksaan</a>
          </div>
          <p>
            layanan digital seperti jadwal praktik dokter,
            rincian tarif layanan, berita terkait puskesmas kraksaan
          </p>
          <div class="footer__socials">
            <a href="https://www.facebook.com/pkmkraksaan/?locale=id_ID"><i class="ri-facebook-fill"></i></a>
            <a href="https://www.instagram.com/puskesmas_kraksaan/"><i class="ri-instagram-line"></i></a>
            <a href="https://www.youtube.com/@puskesmaskraksaan6927"><i class="ri-youtube-fill"></i></a>
          </div>
        </div>

        <div class="footer__col">
          <h4>Alamat :</h4>
          <div class="footer__links">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.124710643871!2d113.41036907410655!3d-7.759615477628249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd701af20f8ae5d%3A0x8ccde8d2ff8aed0c!2sPuskesmas%20Kraksaan!5e0!3m2!1sid!2sid!4v1714445262765!5m2!1sid!2sid"
              width="220%"
              height="270"
              style="border:0; border-radius:10px; margin-top:10px;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
        <br>
        <br>
        <div class="footer__col">
          <h4>Contact :</h4>
          <div class="footer__links">
            <p><i class="ri-mail-line"></i> Email: <a href="mailto:puskesmaskraksaan@gmail.com">puskesmaskraksaan@gmail.com</a></p>
            <p><i class="ri-phone-line"></i> Telp: <a href="tel:+628113373119">0811-3373-119</a></p>
            <p><i class="ri-time-line"></i> Jam Operasional: <br>Senin - Jumat, 07.00 - 14.00</p>
            <a href="https://wa.me/08113122777" target="_blank" class="btn-wa">
              <i class="ri-whatsapp-line"></i> Chat WhatsApp
            </a>
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
    <script src="{{ asset('assets/main.js') }}"></script>

  </body>
</html>
