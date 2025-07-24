@extends('layouts.admin')

@section('content')
    <div class="container d-flex">
        <div class="user-list" style="width: 25%; border-right: 1px solid #ccc; padding-right: 10px;">
            <h5 class="mb-3 fw-bold text-primary"><i class="ri-user-3-line"></i> Daftar Pasien Pengadu</h5>

            @if ($users->isEmpty())
                <div class="alert alert-warning text-center">Tidak ada pengguna.</div>
            @else
        <div class="list-group">
            @foreach ($users as $user)
            @php $isRespon = "respon_" . $user->id_user; @endphp
            <a href="{{ route('admin.chat', ['userId' => $user->id_user]) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $chatWith->id_user === $user->id_user ? 'active' : '' }}"
               id="pasien-item-{{ $user->id_user }}"
               onclick="tandaiSudahDirespon('{{ $user->id_user }}')">
                <div>
                    <i class="ri-user-line me-2"></i> {{ $user->name }}
                </div>
                <span class="badge text-white fw-semibold status-badge" id="status-{{ $user->id_user }}">Belum</span>
            </a>
        @endforeach
                </div>
            @endif
        </div>

        <div class="chat-section" style="width: 75%; padding-left: 10px;">
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($chatWith->name) }}&background=0D8ABC&color=fff&size=40" 
                     alt="Avatar" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                
                <div>
                    <h4 class="m-0 text-primary fw-bold">
                        <i class="ri-chat-3-line me-1"></i> Chat dengan {{ $chatWith->name }}
                    </h4>
                    <small class="text-muted">Silakan balas pesan pasien secara langsung</small>
                </div>
            </div>
            
            <br>
            <div id="loading" style="display:none;">Memuat pesan...</div>
            <div id="chat-box"
                style="border:1px solid #ccc; padding:15px; height:300px; overflow-y:scroll; margin-bottom:10px;">
                {{-- Chat history will be displayed here --}}
            </div>

            <form id="chat-form">
                @csrf
                <input type="hidden" name="to_id" value="{{ $chatWith->id_user }}">
                <div class="input-group mb-2">
                    <input type="text" name="message" class="form-control" id="message-input"
                        placeholder="Tulis pesan..." required>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            
                {{-- Tombol Kembali --}}
                <button onclick="window.history.back()" type="button" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </button>
            </form>
            
        </div>
    </div>

    {{-- Pusher & Echo --}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @vite(['resources/js/app.js']) {{-- Jika pakai Vite --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> Jika pakai Laravel Mix --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chat-form');
            if (!chatForm) {
                console.error('❌ chat-form tidak ditemukan di DOM!');
                return;
            }

            const toId = {{ $chatWith->id_user }};
            const authId = {{ auth()->user()->id_user }};

            function fetchMessages() {
                console.log("📩 Memuat pesan...");
                document.getElementById('loading').style.display = 'block';
                fetch(`/chat/fetch/${toId}`)
                    .then(res => res.json())
                    .then(data => {
                        const box = document.getElementById('chat-box');
                        box.innerHTML = '';
                        data.forEach(msg => {
                            const p = document.createElement('p');
                            p.classList.add('text-break');
                            p.textContent = (msg.from_id === authId ? 'Saya: ' :
                                '{{ $chatWith->name }}: ') + msg.message;
                            p.style.background = (msg.from_id === authId ? '#d1e7dd' : '#f8d7da');
                            p.style.padding = '6px';
                            p.style.marginBottom = '5px';
                            p.style.borderRadius = '6px';
                            box.appendChild(p);
                        });
                        box.scrollTop = box.scrollHeight;
                    }).finally(() => {
                        document.getElementById('loading').style.display = 'none';
                    });
            }

            fetchMessages();

            if (typeof Echo !== 'undefined') {
                Echo.private(`chat.${authId}`)
                    .listen('MessageSent', (e) => {
                        console.log("📡 Pesan diterima via Pusher:", e.message);
                        if (e.message.from_id === toId || e.message.to_id === toId) {
                            fetchMessages();
                        }
                    });
            } else {
                console.warn("⚠️ Laravel Echo tidak tersedia. Pastikan app.js dimuat dan Pusher dikonfigurasi.");
            }

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log("🚀 Submit form diklik");
                const form = new FormData(this);
                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        headers: {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Accept': 'application/json'
                            },

                        },

                    },
                    body: form
                }).then(res => {
                    if (!res.ok) {
                        throw new Error('Gagal mengirim ke server');
                    }
                    return res.json();
                }).then(() => {
                    document.getElementById('message-input').value = '';
                    fetchMessages();
                }).catch(error => {
                    console.error('❌ Error saat mengirim pesan:', error);
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                });
            });
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Saat halaman dimuat, periksa siapa saja yang sudah direspon
        document.querySelectorAll('.status-badge').forEach(el => {
            const userId = el.id.replace('status-', '');
            const isRespon = localStorage.getItem('respon_' + userId);
            if (isRespon === 'true') {
                el.classList.remove('bg-secondary');
                el.classList.add('bg-success');
                el.textContent = 'Terespond';
            } else {
                el.classList.remove('bg-success');
                el.classList.add('bg-secondary');
                el.textContent = 'Belum';
            }
        });
    });

    function tandaiSudahDirespon(userId) {
        localStorage.setItem('respon_' + userId, 'true');
        const badge = document.getElementById('status-' + userId);
        if (badge) {
            badge.classList.remove('bg-secondary');
            badge.classList.add('bg-success');
            badge.textContent = 'Sudah';
        }
    }
</script>

@endsection
