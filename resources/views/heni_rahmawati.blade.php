<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/sitijamila.css') }}">
    <script src="{{ asset('assets/main.js') }}" defer></script>
    <title>Puskesmas Kraksaan</title>
</head>

<body>
    <!-- Header -->
    <header class="header mt-0">
        <nav class="mt-0">
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas Kraksaan
                    </a>
                </div>
                <div class="nav__menu__btn" id="menu-btn">
                    <span><i class="ri-menu-line"></i></span>
                </div>
            </div>
            <ul class="nav__links" id="nav-links">
                @if (auth()->check() && auth()->user()->role === 'pasien')
                    <li class="link"><a href="{{ route('pasien.dashboard') }}">Beranda</a></li>
                    <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                    <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                    <li class="link"><a href="{{ url('/alur-pelayanan') }}">Alur Pelayanan</a></li>
                    <li class="link"><a href="{{ route('pasien.reports') }}">Pengaduan</a></li>
                @endif
                @if (!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                    <li class="link"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                    <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                    <li class="link"><a href="{{ url('/alur-pelayanan') }}">Pelayanan</a></li>
                    <li class="link"><a href="{{ route('pasien.reports') }} disabled-link">Pengaduan</a></li>
                @endif
                @if (!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                    <li class="link">
                        <a href="{{ url('/login') }}" class="btn-link">
                            <button class="btn">Login</button>
                        </a>
                    </li>

                    </li>
                @endif

                @if (auth()->check() && auth()->user()->role === 'pasien')
                    <li class="link">
                        <div class="user-action">
                            <span class="user-btn">
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
    </header>

    <!-- Section Detail Dokter -->
    <section class="doctor-detail">
        <div class="doctor-container">
            <div class="doctor-info">
                <h1>Dr. Heni Rahmawati</h1>
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
                <img src="{{ asset('assets/dr.Sagung.png') }}" alt="Dr. Heni Rahmawati">
            </div>
        </div>
    </section>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo" /> Puskesmas Kraksaan</a>

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
                        width="220%" height="270" style="border:0; border-radius:10px; margin-top:10px;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
            <br>
            <br>
            <div class="footer__col">
                <h4>Contact :</h4>
                <div class="footer__links">
                    <p><i class="ri-mail-line"></i> Email: <a
                            href="mailto:puskesmaskraksaan@gmail.com">puskesmaskraksaan@gmail.com</a></p>
                    <p><i class="ri-phone-line"></i> Telp: <a href="tel:+628113373119">0811-3373-119</a></p>
                    <p><i class="ri-time-line"></i> Jam Operasional: <br>Senin - Jumat, 07.00 - 14.00</p>
                    <a href="https://wa.me/628113373119" target="_blank" class="btn-wa">
                        <i class="ri-whatsapp-line"></i> Chat WhatsApp
                    </a>
                </div>
            </div>

        </div>

        <div class="footer__bar">
            Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
        </div>
    </footer>

    <!-- JS -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>

</html>
