<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
    <title>Puskesmas Kraksaan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <a href="{{ route('pasien.dashboard') }}"><img src="{{ asset('assets/11.png') }}"
                            alt="logo" />Puskesmas Kraksaan</a>
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
                <li class="link"><a href="{{ route('pasien.chat', ['userId' => auth()->user()->id_user]) }}">Chat</a>
                </li>
                @if (auth()->check() && auth()->user()->role === 'pasien')
                    <li class="link">
                        <div class="user-action">
                            <span class="user-btn w-50">
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
        <div class="section__container header__container" id="home">
            <div class="header__image floating">
                <img src="{{ asset('assets/icon Header.png') }}" alt="header" />
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

    <section class="container py-4" style="max-width: 768px">
        <h4 class="mb-4 text-primary fw-bold">Chat dengan {{ $chatWith->name }}</h4>

        <div id="chat-box" class="border rounded p-3 mb-3 bg-light" style="height: 350px; overflow-y: auto;"></div>

        <form id="chat-form" class="d-flex gap-2">
            @csrf
            <input type="hidden" name="to_id" value="{{ $chatWith->id_user }}">
            <input type="text" name="message" id="message-input" class="form-control" placeholder="Tulis pesan..."
                required>
            <button type="submit" class="btn btn-primary px-4">Kirim</button>
        </form>
    </section>

    <div style="margin-top: 20px;"></div>




    <br>
    <!--Footer-->
    <footer class="footer">
        <div class="section__container footer__container">
            <div class="footer__col">
                <div class="footer__logo">
                    <a href="#"> <img src="{{ asset('assets/11.png') }}" alt="logo" />Puskesmas
                        Kraksaan</a>
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
                    <a href="https://wa.me/08113122777" target="_blank" class="btn-wa">
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

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBox = document.getElementById('chat-box');
            const authId = {{ auth()->user()->id_user }};
            const toId = {{ $chatWith->id_user }};

            function renderMessage(msg) {
                const bubble = document.createElement('div');
                const isMe = msg.from_id === authId;
                bubble.classList.add('mb-2', 'p-2', 'rounded', 'text-white');
                bubble.style.maxWidth = '75%';
                bubble.style.wordWrap = 'break-word';
                bubble.textContent = (isMe ? 'Saya: ' : '{{ $chatWith->name }}: ') + msg.message;

                if (isMe) {
                    bubble.classList.add('bg-success', 'ms-auto', 'text-end');
                } else {
                    bubble.classList.add('bg-secondary', 'text-start');
                }

                chatBox.appendChild(bubble);
            }

            function fetchMessages() {
                fetch(`/chat/fetch/${toId}`)
                    .then(res => res.json())
                    .then(data => {
                        chatBox.innerHTML = '';
                        data.forEach(msg => renderMessage(msg));
                        chatBox.scrollTop = chatBox.scrollHeight;
                    });
            }

            fetchMessages();

            if (typeof Echo !== 'undefined') {
                Echo.private(`chat.${authId}`)
                    .listen('MessageSent', (e) => {
                        if (e.message.from_id === toId || e.message.to_id === toId) {
                            fetchMessages();
                        }
                    });
            }

            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const form = new FormData(this);

                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: form
                }).then(res => {
                    if (!res.ok) throw new Error('Gagal kirim pesan');
                    return res.json();
                }).then(() => {
                    document.getElementById('message-input').value = '';
                    fetchMessages();
                }).catch(err => {
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                    console.error(err);
                });
            });
        });
    </script>
</body>

</html>
