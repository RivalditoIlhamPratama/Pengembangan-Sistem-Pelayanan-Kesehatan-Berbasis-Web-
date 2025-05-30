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
            <h1>Puskesmas Kraksaan Kini Buka Layanan USG bagi Ibu Hamil</h1>
            <div class="meta">
                <span>📅 15 Juni 2023</span>
            </div>
            <img src="{{ asset('assets/berita.jpg') }}" alt="Foto USG di Puskesmas Kraksaan">

            <p><strong>Kraksaan, Probolinggo —</strong> Pelayanan ibu hamil di Puskesmas Kraksaan semakin maksimal.
                Pasalnya, Puskesmas Kraksaan kini dilengkapi layanan USG (Ultrasonografi) yang diberikan secara gratis.
                Layanan ini tersedia dua kali dalam seminggu, setiap hari Senin dan Kamis.</p>

            <p>Kepala Puskesmas Kraksaan, <strong>dr. Heni Rahmawati</strong>, menjelaskan bahwa bagi ibu hamil, selain
                mendapatkan pelayanan ANCT (Antenatal Care Terpadu), kini juga dapat menikmati pemeriksaan USG. Alur
                pelayanan dimulai dari pendaftaran di loket, pemeriksaan di ruang KIA, kemudian dilanjutkan pemeriksaan
                laboratorium untuk pengecekan HB, sifilis, HIV, dan lainnya.</p>

            <p>“Pasien dicek HB, sipilis, HIV, semuanya seperti biasanya. Setelah itu pasien kembali ke KIA dan langsung
                saya lakukan USG sambil memeriksa hasil laboratorium. Kemudian pasien diarahkan ke poli gizi, poli gigi,
                lalu pengambilan obat, dan bisa pulang,” terang dr. Heni.</p>

            <p>dr. Heni menambahkan bahwa layanan ANCT merupakan pemeriksaan terpadu yang melibatkan pemeriksaan dari
                bidang, laboratorium, gizi, gigi, hingga dokter. Semua layanan ANCT dan USG diberikan tanpa biaya kepada
                pasien. Total terdapat 18 desa yang menjadi sasaran layanan ini, dibagi 9 desa setiap Senin dan 9 desa
                setiap Kamis untuk menghindari kerumunan.</p>

            <p>“Terkadang dalam sehari, ANCT bisa mencapai 40 pasien, tetapi tidak semuanya perlu USG. USG diwajibkan
                pada kehamilan trimester satu dan tiga, sedangkan trimester dua tidak wajib kecuali ada indikasi medis
                tertentu,” jelasnya.</p>

            <p>Selain itu, bagi ibu hamil dengan usia kandungan kurang dari 12 minggu, juga diberikan tambahan susu
                sebagai nutrisi awal. “Susu diberikan untuk kontak pertama (K1) yang usia kehamilannya di bawah 12
                minggu,” tambah dr. Heni.</p>
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

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

</body>

</html>
