@extends('layouts.admin')

@section('content')
    <div class="container d-flex">
        <div class="user-list" style="width: 25%; border-right: 1px solid #ccc; padding-right: 10px;">
            <h5>Daftar Pengguna</h5>

            @if ($users->isEmpty())
                <p>Tidak ada pengguna lain.</p>
            @else
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item {{ $chatWith->id_user === $user->id_user ? 'active' : '' }}">
                            <a href="{{ route('admin.chat', ['userId' => $user->id_user]) }}"
                                style="text-decoration: none; color: inherit;">
                                {{ $user->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="chat-section" style="width: 75%; padding-left: 10px;">
            <h4>Chat dengan {{ $chatWith->name }}</h4>

            <div id="loading" style="display:none;">Memuat pesan...</div>
            <div id="chat-box"
                style="border:1px solid #ccc; padding:15px; height:300px; overflow-y:scroll; margin-bottom:10px;">
                {{-- Chat history will be displayed here --}}
            </div>

            <form id="chat-form">
                @csrf
                <input type="hidden" name="to_id" value="{{ $chatWith->id_user }}">
                <div class="input-group">
                    <input type="text" name="message" class="form-control" id="message-input"
                        placeholder="Tulis pesan..." required>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
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
@endsection
