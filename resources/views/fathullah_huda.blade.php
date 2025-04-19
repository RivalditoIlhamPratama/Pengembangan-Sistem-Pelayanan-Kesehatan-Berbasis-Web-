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
  <link rel="stylesheet" href="{{ asset('assets/sitijamila.css') }}">
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

<!-- Section Detail Dokter -->
<section class="doctor-detail">
    <div class="doctor-container">
      <div class="doctor-info">
        <h1>Dr. fathullah huda</h1>
        <p class="specialization">Dokter Spesialis Anak</p>
  
        <h3>Jadwal Pelayanan :</h3>
        <table class="schedule-table">
          <thead>
            <tr>
              <th>Hari Pelayanan</th>
              <th>Waktu Pelayanan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Senin | Poli Umum</td>
              <td>10:00 - 12:00 WIB</td>
            </tr>
            <tr>
              <td>Selasa | Poli Umum</td>
              <td>10:00 - 12:00 WIB</td>
            </tr>
            <tr>
              <td>Rabu | Poli Umum</td>
              <td>10:00 - 12:00 WIB</td>
            </tr>
          </tbody>
        </table>
        <p class="schedule-note">*Mohon Maaf, Jadwal sewaktu-waktu dapat berubah</p>
  
        <button onclick="goBack()" class="btn btn-back">Kembali</button>
      </div>
  
      <div class="doctor-image">
        <img src="{{ asset('assets/dr.Sagung.png') }}" alt="Dr. Siti Jamila">
      </div>
    </div>
  </section>
  
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
