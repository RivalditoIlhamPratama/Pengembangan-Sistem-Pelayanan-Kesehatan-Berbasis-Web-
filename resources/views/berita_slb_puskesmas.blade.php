<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Kraksaan</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/berita.css') }}">
    <script src="{{ asset('assets/main.js') }}" defer></script>
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
                @if (auth()->check() && auth()->user()->role === 'pasien')
                    <li class="link"><a href="{{ route('pasien.dashboard') }}">Beranda</a></li>
                    <li class="link"><a href="{{ url('/profil') }}">Profil</a></li>
                    <li class="link"><a href="{{ url('/dokter') }}">Dokter</a></li>
                    <li class="link"><a href="{{ url('/alur-pelayanan') }}">Alur Pelayanan</a></li>
                    <li class="link"><a href="{{ route('pasien.reports') }}">Pengaduan</a></li>
                    <li class="link"><a
                            href="{{ route('pasien.chat', ['userId' => auth()->user()->id_user]) }}">Chat</a>
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

    <section class="news-section">
        <article class="main-content">
            <h1>Pemeriksaan Kesehatan di SLB Dharma Asih Kraksaan</h1>
            <div class="meta">
                <span>📅 20 Agustus 2024</span>
            </div>
            <img src="{{ asset('assets/berita.slb.png') }}" alt="Foto kegiatan SLB">

            <p><strong>Kraksaan, 20 Agustus 2024 —</strong> Dalam rangka meningkatkan kesadaran akan pentingnya
                kesehatan sejak dini, Puskesmas Kraksaan bekerja sama dengan SLB Dharma Asih Kraksaan menyelenggarakan
                pemeriksaan kesehatan gratis bagi seluruh siswa. Kegiatan ini berlangsung pada Selasa, 20 Agustus 2024
                di ruang guru.</p>

            <p><em>"Kegiatan ini merupakan bentuk komitmen kami untuk mendukung tumbuh kembang anak-anak secara
                    optimal,"</em> ujar Petugas Puskesmas Kraksaan.</p>

            <p>Pemeriksaan yang dilakukan meliputi pemeriksaan kesehatan gigi, tinggi badan, berat badan, dan
                penglihatan siswa. Selain itu, siswa juga diberikan penyuluhan mengenai pentingnya menjaga kesehatan
                tubuh melalui pola makan bergizi dan istirahat yang cukup.</p>

            <p>Hasil dari pemeriksaan menunjukkan bahwa seluruh siswa dalam kondisi kesehatan yang baik. Dengan adanya
                kegiatan ini, diharapkan para siswa dapat lebih memahami pentingnya menjaga kesehatan sejak dini untuk
                mendukung pertumbuhan dan perkembangan mereka.</p>
        </article>

        <aside class="sidebar">
            <h3>Berita Sebelumnya</h3>

            <a href="{{ route('berita.slb') }}" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/berita.slb.png') }}" alt="Foto kegiatan SLB">
                    <p>Pemeriksaan Kesehatan di </p>
                    <p> Dharma Asih Kraksaan</p>
                </div>
            </a>

            <a href="{{ route('berita.usg') }}" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/berita.jpg') }}" alt="Foto USG di Puskesmas Kraksaan">
                    <p>Puskesmas Kraksaan Kini Buka Layanan USG bagi Ibu Hamil</p>
                </div>
            </a>

            <a href="{{ route('berita.vaksin') }}" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/sosialisasi.vaksin.png') }}" alt="Thumbnail Berita 3">
                    <p>Masifkan Sosialisasi Vaksin Melalui Video di Puskesmas</p>
                </div>
            </a>

            <a href="" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/berita.jpg') }}" alt="Thumbnail Berita 4">
                    <p>Operasi Gratis Bibir Sumbing & Celah Langit-langit oleh Smile Train</p>
                </div>
            </a>

            <a href="{{ route('berita.vaksin') }}" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/sosialisasi.vaksin.png') }}" alt="Thumbnail Berita 3">
                    <p>Masifkan Sosialisasi Vaksin Melalui Video di Puskesmas</p>
                </div>
            </a>

            <a href="" class="text-decoration-none text-dark">
                <div class="news-item">
                    <img src="{{ asset('assets/berita.jpg') }}" alt="Thumbnail Berita 4">
                    <p>Operasi Gratis Bibir Sumbing & Celah Langit-langit oleh Smile Train</p>
                </div>
            </a>

        </aside>

    </section>

    <br><br><br>

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

            <!-- dimodifikasi: bungkus alamat dan kontak dalam satu flex container -->
            <div class="footer__col d-flex justify-content-between gap-4 flex-wrap" style="flex: 1 1 100%;">
                <!-- Alamat -->
                <div style="flex: 1 1 50%;">
                    <h4>Alamat :</h4>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.124710643871!2d113.41036907410655!3d-7.759615477628249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd701af20f8ae5d%3A0x8ccde8d2ff8aed0c!2sPuskesmas%20Kraksaan!5e0!3m2!1sid!2sid!4v1714445262765!5m2!1sid!2sid"
                        width="100%" height="270" style="border:0; border-radius:10px; margin-top:10px;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Kontak -->
                <div style="flex: 1 1 45%;">
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
        </div>

        <div class="footer__bar">
            Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
        </div>
    </footer>


    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</body>

</html>
