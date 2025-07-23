<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <script src="{{ asset('assets/main.js') }}" defer></script>

    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Puskesmas Kraksaan</title>
</head>

<body>

    <!-- Loader -->
    <div id="loader" class="loader-wrapper">
        <div class="loader-content">
            <img src="{{ asset('assets/logobaru.png') }}" alt="Logo Puskesmas" class="loader-logo" />
            <div class="spinner"></div>
            <p class="loading-text">Mohon Tunggu...</p>
        </div>
    </div>


    <header class="header">
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="{{ url('/') }}"><img src="assets/logobaru.png" alt="logo" />Puskesmas Kraksaan</a>
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
                    <li class="link"><a href="{{ url('/alur-pelayanan') }}">Pelayanan</a></li>
                    <li class="link">
                        <a href="javascript:void(0);" style="pointer-events: none; color: gray; opacity: 0.6; cursor: default;">
                            Pengaduan
                        </a>
                    </li>
                    
                @endif
                @if (!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                    <li class="link"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                    <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                    <li class="link"><a href="{{ url('/alur-pelayanan') }}">Pelayanan</a></li>
                    <li class="link">
                        <a href="javascript:void(0);" style="pointer-events: none; color: gray; opacity: 0.6; cursor: default;">
                            Pengaduan
                        </a>
                    </li>
                    
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
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="button" id="logoutBtn" class="logout-btn">
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
                <img src="assets/icon Header.png" alt="header" />
            </div>
            <div class="header__content">
                <h4>Pelayanan Masyarakat</h4>
                <h1 class="section__header">Puskesmas Kraksaan</h1>
                <p id="typing-text">

                    Puskesmas Kraksaan
                </p>

            </div>
        </div>
    </header>

    <!-- Service Section -->
    <div class="services-section">
        <h2>Layanan Kami</h2><br>
        <p>Kami menyediakan berbagai layanan kesehatan digital untuk kenyamanan Anda, mulai dari pendaftaran dokter
            hingga edukasi kesehatan.</p>
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
            <img src="assets/kepalapuskesmas.png" alt="Dr. Muhammad Reza" class="doctor-img" />
            <div class="doctor-info">
                <h3>dr. Heni Rahmawati</h3>
                <br>
                <p>Dokter Spesialis Anak</p>
                <br>

            </div>
        </div>
        <div class="doctor-card">
            <img src="assets/dokter.png" alt="Dr. Yessi Rahmawati" class="doctor-img" />
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

    <!-- Berita Terkait -->
<div class="berita--container">
    <h2>Berita Terkait</h2>
    <p class="centered-text">Berita Berita Puskesmas Kraksaan</p>
    <br><br>
    <div class="berita-container">
        @forelse ($berita as $item)
            <div class="news-card">
                <img src="{{ asset('storage/' . $item->gambarBerita) }}" alt="Berita Image">
                <div class="news-info">
                    <h3>{{ $item->judulBerita }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($item->isiBerita, 100) }}</p>
                    <p class="date">{{ \Carbon\Carbon::parse($item->tanggalBerita)->translatedFormat('l, d F Y') }}</p>
                    <a href="{{ route('berita.show', $item->idBerita) }}" class="read-more">Selengkapnya</a>
                </div>
            </div>
        @empty
            <p class="text-center">Belum ada berita.</p>
        @endforelse
    </div>
</div>
    <!-- Add more cards as needed -->
        </div>
    </div>

    <!-- End Berita -->
    <!-- Video Section -->
    <div class="video-section">
        <h2>Video Dokumentasi</h2>
        <p class="centered-text">Tonton video dari Puskesmas Kraksaan</p>
        <br><br>
        <div class="video-row">
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/iStZfrQE6ZA"
                    title="Video Puskesmas Kraksaan" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Video Profil Puskesmas Kraksaan</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/zESpcFZG3YU"
                    title="Video Edukasi 2" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Pembacaan ikrar</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/i-WB1NV0orM"
                    title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">VAKSINASI COVID 19 TAHAP 1,PUSKESMAS KRAKSAAN</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/RXjnWGMRcHc"
                    title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Kampanya Adaptasi</p>
            </div>

            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/iStZfrQE6ZA"
                    title="Video Puskesmas Kraksaan" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Video Profil Puskesmas Kraksaan</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/zESpcFZG3YU"
                    title="Video Edukasi 2" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Pembacaan ikrar</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/i-WB1NV0orM"
                    title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">VAKSINASI COVID 19 TAHAP 1,PUSKESMAS KRAKSAAN</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/RXjnWGMRcHc"
                    title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Kampanya Adaptasi</p>
            </div>
            <div class="video-item">
                <iframe width="100%" height="215" src="https://www.youtube.com/embed/RXjnWGMRcHc"
                    title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                <p class="video-caption">Kampanya Adaptasi</p>
            </div>


            <div class="video-section">
                <h2>Video Kesehatan</h2>
                <p class="centered-text">Tonton video Kesehatan berikut ini</p>
                <br><br>
                <div class="video-row" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <div class="video-item" style="flex: 1 1 300px;">
                        <iframe width="100%" height="215" src="https://www.youtube.com/embed/jkS6glRPD_o"
                            title="Video Puskesmas Kraksaan" frameborder="0" allowfullscreen></iframe>
                        <p class="video-caption">Animasi 5 Gerakan Sehat</p>
                    </div>
                    <div class="video-item" style="flex: 1 1 300px;">
                        <iframe width="100%" height="215" src="https://www.youtube.com/embed/MvSkn9svGGw"
                            title="Video Edukasi 2" frameborder="0" allowfullscreen></iframe>
                        <p class="video-caption">Seberapa Penting Kesehatan Mental Untuk Kita?</p>
                    </div>
                    <div class="video-item" style="flex: 1 1 300px;">
                        <iframe width="100%" height="215" src="https://www.youtube.com/embed/2xdVIW9VAL8"
                            title="Video Edukasi 3" frameborder="0" allowfullscreen></iframe>
                        <p class="video-caption">Ayo Cegah Diabetes Mellitus 60 detik</p>
                    </div>
                    <div class="video-item" style="flex: 1 1 300px;">
                        <iframe width="100%" height="215" src="https://www.youtube.com/embed/BtN-goy9VOY"
                            title="Video Edukasi 4" frameborder="0" allowfullscreen></iframe>
                        <p class="video-caption">Tentang Virus Korona & Yang Harus Kamu Lakukan</p>
                    </div>
                </div>
            </div>



            <div style="margin-top: 20px;"></div>





            <br>
            <footer class="footer">
                <div class="section__container footer__container">
                    <div class="footer__col">
                        <div class="footer__logo">
                            <a href="#"><img src="assets/logobaru.png" alt="logo" />Puskesmas Kraksaan</a>
                        </div>
                        <p>
                            layanan digital seperti jadwal praktik dokter,
                            rincian tarif layanan, berita terkait puskesmas kraksaan
                        </p>
                        <div class="footer__socials">
                            <a href="https://www.facebook.com/pkmkraksaan/?locale=id_ID"><i
                                    class="ri-facebook-fill"></i></a>
                            <a href="https://www.instagram.com/puskesmas_kraksaan/"><i
                                    class="ri-instagram-line"></i></a>
                            <a href="https://www.youtube.com/@puskesmaskraksaan6927"><i
                                    class="ri-youtube-fill"></i></a>
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
                            <p><i class="ri-phone-line"></i> Telp: <a href="tel:+62 822-3428-5513">+62
                                    822-3428-5513</a></p>
                            <p><i class="ri-time-line"></i> Jam Operasional: <br>Senin - Jumat, 07.00 - 14.00</p>
                            <a href="https://wa.me/6282234285513" target="_blank" class="btn-wa">
                                <i class="ri-whatsapp-line"></i> Chat WhatsApp
                            </a>

                        </div>
                    </div>

                </div>

                <div class="footer__bar">
                    Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
                </div>
            </footer>



            <script src="https://unpkg.com/scrollreveal"></script>
            <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

            <script>
                const text =
                    "layanan digital seperti jadwal praktik dokter, rincian tarif layanan, berita berita terkait puskesmas kraksaan";
                let index = 0;
                const speed = 100; // kecepatan mengetik dalam ms

                function typeWriter() {
                    if (index < text.length) {
                        document.getElementById("typing-text").innerHTML += text.charAt(index);
                        index++;
                        setTimeout(typeWriter, speed);
                    }
                }

                window.addEventListener("load", typeWriter);
            </script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const links = document.querySelectorAll("a:not(.read-more):not([target='_blank']):not(.btn-wa)");

                    links.forEach((link) => {
                        link.addEventListener("click", function(e) {
                            const href = link.getAttribute("href");
                            if (href && !href.startsWith("#") && !href.startsWith("javascript") && !link
                                .classList.contains("disabled-link")) {
                                document.getElementById("loader").style.display = "flex";
                            }
                        });
                    });

                    window.addEventListener("pageshow", function() {
                        document.getElementById("loader").style.display = "none";
                    });
                });
            </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logoutBtn = document.getElementById("logoutBtn");
        const logoutForm = document.getElementById("logoutForm");

        if (logoutBtn && logoutForm) {
            logoutBtn.addEventListener("click", function () {
                Swal.fire({
                    title: 'Yakin ingin logout?',
                    text: "Anda akan keluar dari sistem.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        logoutForm.submit();
                    }
                });
            });
        }
    });
</script>


</body>

</html>
