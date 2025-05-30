<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/profil.css') }}">
    <script src="{{ asset('assets/main.js') }}" defer></script>
    <title>Puskesmas Kraksaan</title>
</head>

<body>

    <!-- Loader -->
    <div id="loader" class="loader-wrapper">
        <div class="loader-content">
            <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas" class="loader-logo" />
            <div class="spinner"></div>
            <p class="loading-text">Mohon Tunggu...</p>
        </div>
    </div>

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


    <section class="about">
        <div class="container">
            <div class="about__content">
                <div class="about__image">
                    <img src="assets/alur pelayanan.png" alt="Logo Puskesmas Kraksaan"
                        style="width: 110%; max-width: 1010px; height: auto;">
                </div>
                <br><br>
                <div class="about__text">
                    <h2>Alur Pelayanan</h2>
                    <p>
                        Alur pelayanan di Puskesmas Kraksaan dimulai dari pasien datang dan melakukan pendaftaran serta
                        rekam medis. Setelah itu, pasien akan diarahkan ke berbagai jenis pelayanan sesuai kebutuhannya,
                        seperti pelayanan umum, gigi, KIA & KB, TB, HIV, kusta, hepatitis, gizi, dan sanitasi. Jika
                        diperlukan, pasien dapat dirujuk untuk pemeriksaan laboratorium. Setelah pelayanan selesai,
                        pasien akan menuju farmasi untuk mengambil obat. Pasien kemudian dapat pulang atau dirujuk ke
                        rumah sakit jika kondisi darurat atau membutuhkan penanganan lanjutan.
                    </p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <!-- Jenis Pelayanan -->
            <h2 style="color: #1771ca; margin-top: 60px;">Jenis-Jenis Pelayanan</h2>
            <table class="service-table">
                <thead>
                    <tr>
                        <th>UKM Esensial</th>
                        <th>UKM Pengembangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="service-title">1. Pelayanan Promosi Kesehatan</div>
                            <ul class="service-list">
                                <li>Pemberdayaan Masyarakat dalam PHBS</li>
                                <li>UKBM</li>
                            </ul>
                            <div class="service-title">2. Pelayanan Kesehatan Lingkungan</div>
                            <ul class="service-list">
                                <li>Pembinaan Tempat Fasilitas Umum</li>
                                <li>STBM Pemberdayaan Masyarakat</li>
                            </ul>
                            <div class="service-title">3. Pelayanan KIA & KB</div>
                            <ul class="service-list">
                                <li>ANC Terpadu Ibu Hamil</li>
                                <li>Kelas Ibu Hamil, Balita</li>
                                <li>Konseling Catin</li>
                                <li>SDIDTK</li>
                            </ul>
                            <div class="service-title">4. Pelayanan Kesehatan Lansia</div>
                            <ul class="service-list">
                                <li>Posyandu Lansia</li>
                            </ul>
                            <div class="service-title">5. Pelayanan Kesehatan Anak Sekolah dan Remaja</div>
                            <ul class="service-list">
                                <li>Screening Anak Sekolah dan Remaja</li>
                            </ul>
                            <div class="service-title">6. Pelayanan Gizi</div>
                            <ul class="service-list">
                                <li>Pelayanan Gizi Masyarakat</li>
                                <li>Penanggulangan Gangguan Gizi</li>
                                <li>Pemantauan Status Gizi</li>
                            </ul>
                            <div class="service-title">7. Pelayanan Pencegahan dan Pengendalian Penyakit</div>
                            <ul class="service-list">
                                <li>Pemantauan Pemberian Zinc</li>
                                <li>Pencegahan Hepatitis B pada Ibu Hamil</li>
                                <li>Screening Kusta/Frambusia</li>
                                <li>Imunisasi Anak Sekolah</li>
                                <li>Mobile Klinik VCT</li>
                                <li>POPM Cacingan</li>
                                <li>Pelacakan dan Penemuan Kasus TB</li>
                            </ul>
                            <div class="service-title">8. Pencegahan dan Penanggulangan Penyakit Tidak Menular</div>
                            <ul class="service-list">
                                <li>Pelayanan POSBINDU</li>
                                <li>Deteksi Dini Gangguan Indera</li>
                            </ul>
                            <div class="service-title">9. Pelayanan Kesehatan Jiwa</div>
                            <ul class="service-list">
                                <li>Screening Kesehatan Jiwa</li>
                            </ul>
                            <div class="service-title">10. Pelayanan Keperawatan Kesehatan Masyarakat (PERKESMAS)</div>
                            <ul class="service-list">
                                <li>Kunjungan Intervensi PIS-PK</li>
                            </ul>
                        </td>
                        <td>
                            <div class="service-title">1. Pelayanan Kesehatan Gigi Masyarakat</div>
                            <ul class="service-list">
                                <li>Penyuluhan/Pemeriksaan gigi dan mulut di PAUD, TK dan POSYANDU</li>
                            </ul>
                            <div class="service-title">2. Pelayanan Kesehatan Tradisional</div>
                            <ul class="service-list">
                                <li>Visitasi Kelompok ASMAN TOGA</li>
                            </ul>
                            <div class="service-title">3. Pelayanan Kesehatan Olahraga</div>
                            <ul class="service-list">
                                <li>Pengukuran Kebugaran Calon Jamaah Haji</li>
                                <li>Pengukuran Kebugaran Anak Sekolah</li>
                            </ul>
                            <div class="service-title">4. Pelayanan Kesehatan Kerja</div>
                            <ul class="service-list">
                                <li>Pembinaan Kelompok Kesehatan Kerja Informal</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </section>


    </div>
    </div>
    </section>
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
    <!--End Footer-->

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

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

</body>

</html>
