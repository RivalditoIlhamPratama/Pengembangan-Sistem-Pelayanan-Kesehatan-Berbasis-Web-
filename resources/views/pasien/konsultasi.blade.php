<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/aduanmasyarakat.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Puskesmas Kraksaan</title>
</head>

<body>
    <header class="header">
        <nav>
            <div class="nav__header">
                <div class="nav__logo">
                    <a href="#"><img src="{{ asset('assets/logobaru.png') }}" alt="logo"> Puskesmas Kraksaan</a>
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
                <li class="link"><a href="{{ route('pasien.reports') }}">Pengaduan</a></li>

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

    <!-- Chat Section -->
    <section class="chat-container"
        style="max-width: 500px; margin: 30px auto 0; padding: 20px; border-radius: 12px; background-color: #fff; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05); border: 1px solid #e0e0e0; font-family: 'Segoe UI', sans-serif;">
        <!-- Header dengan foto dokter -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h4 style="font-weight: 600; color: #333; margin: 0;">
                Konsultasi dengan Dokter {{ $namaDokter ?? '...' }}
            </h4>
            <img src="{{ asset('assets/Pengaduan.png') }}" alt="Foto Dokter"
                style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; box-shadow: 0 0 5px rgba(0,0,0,0.1);">
        </div>

        <!-- Chat Box -->
        <div id="chat-box" style="min-height: 200px; margin-bottom: 15px;">
            <div class="chat-box">
                @foreach ($messages as $msg)

                    <div class="chat-message {{ $msg->from_id === auth()->id() ? 'sent' : 'received' }}">
                        <div class="chat-bubble">
                            <small class="sender">{{ $msg->from_id === auth()->id() ? 'Saya' : 'Dokter' }}</small>
                            <p>{{ $msg->pesan }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
        </div>

        <!-- Chat Input -->
        <form id="chat-form" action="{{ route('konsultasi.kirim') }}" method="POST" style="display: flex;">
            @csrf
            <input type="hidden" name="to_id" value="{{ $chatWith->id_user }}">

            <input type="text" name="message" id="message-input" placeholder="Tulis pesan..." required>
            <button type="submit">Kirim</button>
        </form>
        <div style="background: #f8f9fa; border: 1px solid #ddd; padding: 12px; border-radius: 6px; font-size: 13px; color: #333; margin-top: 12px;">
            <strong>Catatan:</strong><br>
            Sertakan informasi berikut dalam pesan:
            <ul style="margin: 8px 0 0 16px; padding: 0;">
                <li><strong>Alamat lengkap</strong> – untuk keperluan rujukan atau kunjungan rumah</li>
                <li><strong>Keluhan utama</strong> – contoh: batuk 3 hari, demam sejak kemarin malam</li>
                <li><strong>Riwayat penyakit sebelumnya</strong> – misal: hipertensi, asma, diabetes</li>
            </ul>
        </div>
        
    </section>

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 1500,
            showConfirmButton: false
        });
    </script>

<script>
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

@endif


</body>

</html>
