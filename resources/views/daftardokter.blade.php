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
  <link rel="stylesheet" href="{{ asset('assets/daftardokter.css') }}">
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
            <li class="link"><a class="disabled-link" href="{{ url('/aduanmasyarakat') }}">Pelayanan</a></li>
          <li class="link">
            <a href="{{ url('/login') }}" class="btn-link">
              <button class="btn">Login</button>
            </a>
          </li>
          <li class="link">
            <a href="{{ url('/login') }}" class="btn-link">
              <button class="btn">Daftar</button>
            </a>
          </li>
        </ul>
      </nav>
    </header>

    <>
      <h2>Dokter Puskesmas Kraksaan</h2>
      <div class="doctor-card-container">
        <!-- Card Dokter -->
        <div class="doctor-card">
          <img src="assets/dr.Sagung.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="dokterkomang.html" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/Dr.Ninda.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Ninda Farahdina N</h3>
            <p>Dokter Umum</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>
        <div class="doctor-card">
          <img src="assets/dr.Reza.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>
        <div class="doctor-card">
          <img src="assets/dr.Made.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>

        <div class="doctor-card">
          <img src="assets/dokter.png" alt="Dr. Komang Ayu" class="doctor-img">
          <div class="doctor-info">
            <h3>dr. Komang Ayu R.P., M.Sc. Sp.A</h3>
            <p>Dokter Spesialis Anak</p>
            <div class="btn-container">
              <a href="#" class="btn">Jadwal</a>
              <button class="btn">Poll</button>
            </div>
          </div>
        </div>


      </div>
    </>


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
            <h4>Company</h4>
            <div class="footer__links">
              <a href="#">Business</a>
              <a href="#">Franchise</a>
            </div>
          </div>
          <div class="footer__col">
            <h4>About Us</h4>
            <div class="footer__links">
              <a href="#">Blogs</a>
              <a href="#">Security</a>
              <a href="#">Careers</a>
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
