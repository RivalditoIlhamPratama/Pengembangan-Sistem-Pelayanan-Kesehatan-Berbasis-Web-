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
            
           
            <h2 style="color: #1771ca; margin-top: 60px;">Jenis-Jenis Pelayanan Luar Gedung</h2>
            <p style="margin-bottom: 20px; font-size: 16px; color: #444;">
              Berikut adalah jenis pelayanan luar gedung yang dilakukan oleh Puskesmas Kraksaan, mencakup kegiatan promotif, preventif, dan pelayanan langsung ke masyarakat melalui posyandu, sekolah, dan kunjungan ke kelompok sasaran tertentu.
            </p>
            
<div class="jenis-pelayanan-grid">
    <!-- UKM Esensial -->
    <div class="pelayanan-box">
        <h4>1. Pelayanan Promosi Kesehatan</h4>
        <ul>
            <li>Pemberdayaan Masyarakat dalam PHBS</li>
            <li>UKBM</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>2. Pelayanan Kesehatan Lingkungan</h4>
        <ul>
            <li>Pembinaan Tempat Fasilitas Umum</li>
            <li>STBM Pemberdayaan Masyarakat</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>3. Pelayanan KIA & KB</h4>
        <ul>
            <li>ANC Terpadu Ibu Hamil</li>
            <li>Kelas Ibu Hamil, Balita</li>
            <li>Konseling Catin</li>
            <li>SDIDTK</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>4. Pelayanan Kesehatan Lansia</h4>
        <ul>
            <li>Posyandu Lansia</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>5. Pelayanan Kesehatan Anak Sekolah dan Remaja</h4>
        <ul>
            <li>Screening Anak Sekolah dan Remaja</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>6. Pelayanan Gizi</h4>
        <ul>
            <li>Pelayanan Gizi Masyarakat</li>
            <li>Penanggulangan Gangguan Gizi</li>
            <li>Pemantauan Status Gizi</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>7. Pelayanan Pencegahan dan Pengendalian Penyakit</h4>
        <ul>
            <li>Pemantauan Pemberian Zinc</li>
            <li>Pencegahan Hepatitis B pada Ibu Hamil</li>
            <li>Screening Kusta/Frambusia</li>
            <li>Imunisasi Anak Sekolah</li>
            <li>Mobile Klinik VCT</li>
            <li>POPM Cacingan</li>
            <li>Pelacakan dan Penemuan Kasus TB</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>8. Pencegahan dan Penanggulangan Penyakit Tidak Menular</h4>
        <ul>
            <li>Pelayanan POSBINDU</li>
            <li>Deteksi Dini Gangguan Indera</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>9. Pelayanan Kesehatan Jiwa</h4>
        <ul>
            <li>Screening Kesehatan Jiwa</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>10. Pelayanan Keperawatan Kesehatan Masyarakat (PERKESMAS)</h4>
        <ul>
            <li>Kunjungan Intervensi PIS-PK</li>
        </ul>
    </div>

    <!-- UKM Pengembangan -->
    <div class="pelayanan-box">
        <h4>11. Pelayanan Kesehatan Gigi Masyarakat</h4>
        <ul>
            <li>Penyuluhan/Pemeriksaan gigi dan mulut di PAUD, TK dan POSYANDU</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>12. Pelayanan Kesehatan Tradisional</h4>
        <ul>
            <li>Visitasi Kelompok ASMAN TOGA</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>13. Pelayanan Kesehatan Olahraga</h4>
        <ul>
            <li>Pengukuran Kebugaran Calon Jamaah Haji</li>
            <li>Pengukuran Kebugaran Anak Sekolah</li>
        </ul>
    </div>

    <div class="pelayanan-box">
        <h4>14. Pelayanan Kesehatan Kerja</h4>
        <ul>
            <li>Pembinaan Kelompok Kesehatan Kerja Informal</li>
        </ul>
    </div>
</div>

<hr style="margin: 50px 0;">

<h2 class="text-center">Jenis Pelayanan Dalam Gedung</h2>
<div class="jenis-pelayanan-grid">
  <div class="pelayanan-box">
    <h4><i class="ri-hospital-line"></i> Ruang Bersalin</h4>
    <p><strong>Jam Layanan:</strong> 24 Jam</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-stethoscope-line"></i> Ruang Tindakan</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.00 WIB<br>Sabtu: 08.00 – 11.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-user-add-line"></i> Ruang Pendaftaran</h4>
    <p>Senin – Kamis: 07.30 – 12.00 WIB<br>Jumat: 07.30 – 10.00 WIB<br>Sabtu: 07.30 – 11.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-user-heart-line"></i> Pelayanan Umum</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.30 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-tooth-line"></i> Pelayanan Gigi</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.30 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-heart-pulse-line"></i> Pelayanan KIA</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.30 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-flask-line"></i> Laboratorium</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.30 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-shield-cross-line"></i> Imunisasi</h4>
    <p>Jumat: 08.00 – 10.30 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-parent-line"></i> CATIN</h4>
    <p>Selasa & Rabu: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-group-line"></i> KB</h4>
    <p>Rabu: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-body-scan-line"></i> ANC dan USG Ibu Hamil</h4>
    <p>Senin & Kamis: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-capsule-line"></i> Pelayanan Obat</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.30 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-restaurant-line"></i> Konsultasi Gizi</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-brush-line"></i> Sanitasi</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-virus-line"></i> TBC</h4>
    <p>Selasa & Rabu: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-shield-line"></i> HIV dan IMS</h4>
    <p>Senin & Kamis: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-user-3-line"></i> Dokter Umum</h4>
    <p>Senin & Kamis: ANCT 08.00 – 13.00 WIB<br>Selasa & Rabu: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 11.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-tooth-line"></i> Dokter Gigi</h4>
    <p>Senin & Kamis: ANCT 08.00 – 13.00 WIB<br>Selasa & Rabu: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 11.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-truck-line"></i> Ambulance</h4>
    <p>24 Jam</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-home-heart-line"></i> Pustu / Polindes / Ponkesdes</h4>
    <p>Senin – Kamis: 08.00 – 12.00 WIB<br>Jumat: 08.00 – 10.00 WIB<br>Sabtu: 08.00 – 11.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-user-settings-line"></i> Posbindu PTM</h4>
    <p>Selasa: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-hand-heart-line"></i> Kusta</h4>
    <p>Kamis: 08.00 – 13.00 WIB</p>
  </div>
  <div class="pelayanan-box">
    <h4><i class="ri-brain-line"></i> Pelayanan Jiwa</h4>
    <p>Senin – Kamis: 08.00 – 13.00 WIB<br>Jumat: 08.00 – 10.00 WIB<br>Sabtu: 08.00 – 12.00 WIB</p>
  </div>
</div>
</section>

<section class="tarif-layanan mt-5">
    <h2 class="text-center mb-4">Tarif Layanan</h2>
    
    <!-- Input pencarian -->
<div style="text-align:center; margin: 20px 0;">
    <input type="text" id="searchInput" placeholder="Cari jenis pelayanan..." style="padding: 8px; width: 300px; border-radius: 8px; border: 1px solid #ccc;">
  </div>
    <div class="tabel-pelayanan-wrapper">
      <div class="tabel-pelayanan">
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Pelayanan</th>
                <th>Jasa Sarana (Rp)</th>
                <th>Jasa Pelayanan (Rp)</th>
                <th>Total (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <!-- I. UGD -->
              <tr><td colspan="5"><strong>I. UGD</strong></td></tr>
              <tr><td>1</td><td>Pemeriksaan kesehatan umum</td><td>10.000</td><td>10.000</td><td>20.000</td></tr>
              <tr><td>2</td><td>Pelayanan observasi (maks. 6 jam)</td><td>30.000</td><td>30.000</td><td>60.000</td></tr>
              <tr><td>3</td><td>Tarif Pelayanan Rekam Medik dan kartu pasien baru</td><td>10.000</td><td>5.000</td><td>15.000</td></tr>
      
              <!-- II. RAWAT JALAN -->
              <tr><td colspan="5"><strong>II. RAWAT JALAN</strong></td></tr>
              <tr><td>1</td><td>Di Pelayanan Umum, Gigi dan KIA</td><td>6.000</td><td>4.000</td><td>10.000</td></tr>
              <tr><td>2</td><td>Pelayanan Konsultasi</td><td>8.000</td><td>12.000</td><td>20.000</td></tr>
              <tr><td>3</td><td>Pemeriksaan Pelayanan Umum Sore hari</td><td>10.000</td><td>10.000</td><td>20.000</td></tr>
              <tr><td>4</td><td>Tarif Pelayanan Rekam Medik dan kartu pasien baru</td><td>10.000</td><td>5.000</td><td>15.000</td></tr>
      
              <!-- IV. PERSALINAN -->
              <tr><td colspan="5"><strong>IV. PERSALINAN</strong></td></tr>
              <tr><td>1</td><td>Persalinan Normal</td><td>200.000</td><td>400.000</td><td>600.000</td></tr>
              <tr><td>2</td><td>Persalinan dengan Penyulit (termasuk vakum)</td><td colspan="3"></td></tr>
              <tr><td></td><td>a. Dokter Umum</td><td>250.000</td><td>500.000</td><td>750.000</td></tr>
              <tr><td></td><td>b. Dokter Spesialis</td><td>100.000</td><td>800.000</td><td>900.000</td></tr>
              <tr><td>3</td><td>Abortus spontan tanpa penyulit</td><td>60.000</td><td>100.000</td><td>160.000</td></tr>
              <tr><td>4</td><td>Curretage pd Abortus tanpa penyulit</td><td>100.000</td><td>500.000</td><td>600.000</td></tr>
              <tr><td>5</td><td>Pertolongan pada Retensio Plasenta</td><td>100.000</td><td>150.000</td><td>250.000</td></tr>
      
              <!-- V. TINDAKAN MEDIK POLI UMUM/UGD/RAWAT INAP -->
              <tr><td colspan="5"><strong>V. TINDAKAN MEDIK DI POLI UMUM/UGD/RAWAT INAP</strong></td></tr>
      
              <!-- A. RINGAN -->
              <tr><td colspan="5"><em>A. Tindakan Medis Ringan</em></td></tr>
              <tr><td></td><td>Luka Lecet</td><td>4.000</td><td>6.000</td><td>10.000</td></tr>
              <tr><td></td><td>Luka Bakar Ringan</td><td colspan="3"></td></tr>
              <tr><td></td><td>Luka Bakar Sedang</td><td colspan="3"></td></tr>
              <tr><td></td><td>Tampon Hidung</td><td colspan="3"></td></tr>
      
              <!-- B. KECIL -->
              <tr><td colspan="5"><em>B. Tindakan Medis Kecil</em></td></tr>
              <tr><td></td><td>Jahit luka 1 s.d. 3 jahitan</td><td>8.000</td><td>12.000</td><td>20.000</td></tr>
              <tr><td></td><td>Perawat luka/tindik</td><td colspan="3"></td></tr>
              <tr><td></td><td>Pemasangan bidai</td><td colspan="3"></td></tr>
              <tr><td></td><td>Pemakaian suction/hari</td><td colspan="3"></td></tr>
              <tr><td></td><td>Lavement</td><td colspan="3"></td></tr>
      
              <!-- C. SEDANG -->
              <tr><td colspan="5"><em>C. Tindakan Medis Sedang</em></td></tr>
              <tr><td></td><td>Luka Bakar Sedang</td><td>10.000</td><td>15.000</td><td>25.000</td></tr>
              <tr><td></td><td>Jahit luka 4 s/d 7 jahitan</td><td colspan="3"></td></tr>
              <tr><td></td><td>Incisi abses</td><td colspan="3"></td></tr>
              <tr><td></td><td>Ekstraksi kuku termasuk roster plasty</td><td colspan="3"></td></tr>
              <tr><td></td><td>Pengambilan benda asing</td><td colspan="3"></td></tr>
              <tr><td></td><td>Pasang atau buka kateter</td><td colspan="3"></td></tr>
              <tr><td></td><td>Nekrotomi/hari</td><td colspan="3"></td></tr>
              <tr><td></td><td>Pemasangan infus/hari</td><td colspan="3"></td></tr>
              <tr><td></td><td>Resusitasi</td><td colspan="3"></td></tr>
              <tr><td></td><td>Tampon vagina</td><td colspan="3"></td></tr>
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
                    <a href="#"><img src="assets/logobaru.png" alt="logo" />Puskesmas Kraksaan</a>
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

<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
      const input = this.value.toLowerCase();
      const rows = document.querySelectorAll('#tarifTable tbody tr');
  
      rows.forEach(row => {
        const cellsText = row.innerText.toLowerCase();
        row.style.display = cellsText.includes(input) ? '' : 'none';
      });
    });
  </script>
  
</body>

</html>
