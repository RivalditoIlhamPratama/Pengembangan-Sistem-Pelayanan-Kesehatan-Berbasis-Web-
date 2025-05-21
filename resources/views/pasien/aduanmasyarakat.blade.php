<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/aduanmasyarakat.css') }}">
    <title>Puskesmas Kraksaan</title>
</head>
<body>
<header class="header">
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo"> Puskesmas Kraksaan</a>
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

<!-- Pengaduan Section -->
<section class="pengaduan-container">
    <div class="pengaduan-form">
        <h2>Form Pengaduan</h2>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success" style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 10px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(auth()->check() && auth()->user()->role === 'pasien')
        <form action="{{ route('pasien.reports.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" value="{{ auth()->user()->pasien->namaPasien ?? 'Nama Pasien' }}" readonly />

            <div class="phone-input">
                <input type="tel" name="phone" placeholder="Nomor Telepon"
                    value="{{ old('phone', '+62' . (auth()->user()->pasien->noHp ?? '')) }}" required />
            </div>

            <select name="jenis_pengaduan" required>
                <option value="" disabled {{ old('jenis_pengaduan') ? '' : 'selected' }}>Pilih Jenis Pengaduan</option>
                <option value="pelayanan" {{ old('jenis_pengaduan') == 'pelayanan' ? 'selected' : '' }}>Pelayanan</option>
                <option value="fasilitas" {{ old('jenis_pengaduan') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                <option value="dokter" {{ old('jenis_pengaduan') == 'dokter' ? 'selected' : '' }}>Dokter</option>
            </select>

            <textarea name="aduan" placeholder="Isi Pengaduan" rows="4" required>{{ old('aduan') }}</textarea>

            <label for="gambar">Upload Gambar (optional):</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" />

            <button type="submit" class="btn">Kirim Pengaduan</button>
        </form>
        @endif
    </div>

    <div class="hubungi-kami">
      <div style="display: flex; justify-content: center; margin-top: 5px;">
        <img
            src="{{ asset('assets/Pengaduan.png') }}"
            alt="Lokasi Puskesmas Kraksaan"
            class="floating-image"
            style="max-width: 55%; height: auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    </div>


        <h2>Hubungi Kami</h2>
        <div class="contact-info-modern" style="margin-top: 20px;">
            <div class="info-item">
                <i class="ri-map-pin-line icon"></i>
                <div class="info-text">
                    <strong>Lokasi:</strong><br>
                    <span>Jl. Mayjend Sungkono No.10, Kraksaan, Probolinggo</span>
                </div>
            </div>
            <div class="info-item">
                <i class="ri-mail-line icon"></i>
                <div class="info-text">
                    <strong>Email:</strong><br>
                    <span>contact@puskesmaskraksaan.com</span>
                </div>
            </div>
            <div class="info-item">
                <i class="ri-phone-line icon"></i>
                <div class="info-text">
                    <strong>Hubungi Kami:</strong><br>
                    <span>+0811 3373 119</span>
                </div>
            </div>
        </div>

    </div>

</section>


<!-- Testimoni Slider Tanpa Swiper -->
<section class="pengaduan-slider">
    <h2>Testimoni Pengaduan</h2>

    <!-- Pencarian -->
    <div class="pengaduan-search-container">
    <input type="text" id="pengaduan-search-input" placeholder="Cari berdasarkan nama atau jenis pengaduan..." />
    <button id="pengaduan-search-btn"><i class="ri-search-line"></i> Cari</button>
    </div>

    <div class="slider-wrapper">
        <button class="slider-btn prev-btn">&#10094;</button>
        <div class="slider-track">
            @foreach ($pengaduan as $item)
            <div class="slider-card">
                <p class="pengaduan-isi">"{{ $item->isiPengaduan }}"</p>
                <p class="pengaduan-jenis"><em>Jenis Pengaduan:</em> {{ ucfirst($item->jenisPengaduan) }}</p>
                <strong>- {{ $item->pasien->namaPasien ?? 'Anonymous' }}</strong>
            </div>
            @endforeach
        </div>
        <button class="slider-btn next-btn">&#10095;</button>
    </div>
</section>


  <footer class="footer">
    <div class="section__container footer__container">
      <div class="footer__col">
        <div class="footer__logo">
          <a href="#"><img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas Kraksaan</a>
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
        <h4>Contact</h4>
        <div class="footer__links">
          <p><i class="ri-mail-line"></i> Email: <a href="mailto:puskesmaskraksaan@gmail.com">puskesmaskraksaan@gmail.com</a></p>
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



<script>
    const track = document.querySelector('.slider-track');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const cards = document.querySelectorAll('.slider-card');
    let currentIndex = 0;
    const cardsToShow = 3;

    function updateSlider() {
      const cardWidth = cards[0].offsetWidth + 20; // +gap
      track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
    }

    nextBtn.addEventListener('click', () => {
      if (currentIndex + cardsToShow < cards.length) {
        currentIndex += cardsToShow;
        updateSlider();
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentIndex - cardsToShow >= 0) {
        currentIndex -= cardsToShow;
        updateSlider();
      }
    });

    window.addEventListener('resize', updateSlider);



    document.getElementById('pengaduan-search-btn').addEventListener('click', function () {
  const keyword = document.getElementById('pengaduan-search-input').value.toLowerCase();
  const cards = document.querySelectorAll('.slider-card');

  cards.forEach(card => {
    const content = card.textContent.toLowerCase();
    card.style.display = content.includes(keyword) ? 'block' : 'none';
  });

  // Reset posisi slider ke awal setelah filter
  currentIndex = 0;
  updateSlider();
});

  </script>



</body>
</html>
