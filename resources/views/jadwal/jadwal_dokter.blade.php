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
    @php use Illuminate\Support\Str; use Carbon\Carbon; @endphp
    <header class="header mt-0">
        <nav class="mt-0">
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas Kraksaan</a>
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
                    <li class="link"><a href="{{ route('pasien.reports') }}" class="disabled-link">Pengaduan</a></li>
                @endif
                @if (!auth()->check() || (auth()->check() && auth()->user()->role !== 'pasien'))
                    <li class="link">
                        <a href="{{ url('/login') }}" class="btn-link">
                            <button class="btn">Login</button>
                        </a>
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
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <section class="doctor-detail" style="padding: 2rem;">
        <div style="display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start; max-width: 900px; margin: 0 auto;">
    
            {{-- Foto Dokter di Kiri --}}
            <div style="flex: 0 0 220px;">
                @if ($dokter->gambarProfil)
                    <img src="{{ asset('storage/' . $dokter->gambarProfil) }}"
                         alt="{{ $dokter->namaDokter }}"
                         style="width: 220px; height: auto; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                @else
                    <img src="{{ asset('assets/default-doctor.png') }}"
                         alt="Foto Default"
                         style="width: 220px; height: auto; border-radius: 12px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                @endif
            </div>
    
            {{-- Informasi Dokter di Kanan --}}
            <div style="flex: 1;">
    
                {{-- Nama Dokter --}}
                <h1 style="font-size: 1.8rem; font-weight: bold; color: #333; margin-bottom: 0.2rem;">
                    {{ $dokter->namaDokter }}
                </h1>
    
                {{-- Spesialis --}}
                <p style="font-size: 0.9rem; color: #777; margin-bottom: 1rem;">
                    Dokter {{ $dokter->spesialis }}
                </p>
    
                {{-- Judul Jadwal --}}
                <h3 style="font-size: 1.1rem; margin-bottom: 0.8rem;">Jadwal Pelayanan :</h3>
    
                @if ($dokter->jadwaldokters->count() > 0)
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                        <thead>
                            <tr>
                                <th style="background-color: #e0e7ff; text-align: left; padding: 8px; color: #333; border: 1px solid #ccc;">
                                    Hari Pelayanan
                                </th>
                                <th style="background-color: #e0e7ff; text-align: left; padding: 8px; color: #333; border: 1px solid #ccc;">
                                    Waktu Pelayanan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokter->jadwaldokters as $jadwal)
                                @if ($jadwal->hari && $jadwal->waktu)
                                    <tr>
                                        <td style="padding: 8px; border: 1px solid #ccc;">
                                            {{ $jadwal->hari->namaHari }} | Poli Umum
                                        </td>
                                        <td style="padding: 8px; border: 1px solid #ccc;">
                                            {{ $jadwal->waktu->jamMulai }} - {{ $jadwal->waktu->jamSelesai }} WIB
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
    
                    <p style="font-size: 0.8rem; color: #777; margin-top: 0.5rem; font-style: italic;">
                        *Mohon Maaf, Jadwal sewaktu-waktu dapat berubah
                    </p>
                @else
                    <p style="color: #999;">Belum ada jadwal yang terdaftar.</p>
                @endif
    
                {{-- Tombol Kembali --}}
                <a href="{{ url('/dokter') }}"
                    style="
                        display: inline-block;
                        margin-top: 1rem;
                        padding: 8px 16px;
                        background-color: #007bff;
                        color: white;
                        text-decoration: none;
                        border-radius: 6px;
                        font-size: 0.95rem;
                    ">
                    ← Kembali
                </a>
    
            </div>
        </div>
    </section>
    
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas
                        Kraksaan</a>
                </div>
                <p>
                    layanan digital seperti jadwal praktik dokter,
                    rincian tarif layanan, berita terkait puskesmas kraksaan
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
                <h4>Contact</h4>
                <div class="footer__links">
                    <p><i class="ri-mail-line"></i> Email: <a
                            href="mailto:puskesmaskraksaan@gmail.com">puskesmaskraksaan@gmail.com</a></p>
                    <p><i class="ri-phone-line"></i> Telp: <a href="tel:+628113373119">0811-3373-119</a></p>
                    <p><i class="ri-time-line"></i> Jam Operasional: <br>Senin - Jumat, 07.00 - 14.00</p>
                    <a href="https://wa.me/628113373119" target="_blank" class="btn-wa">Chat WhatsApp</a>
                </div>
            </div>

        </div>

        <div class="footer__bar">
            Copyright © 2024 Puskesmas Kraksaan. All rights reserved.
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('assets/main.js') }}"></script>
    

</body>

</html>