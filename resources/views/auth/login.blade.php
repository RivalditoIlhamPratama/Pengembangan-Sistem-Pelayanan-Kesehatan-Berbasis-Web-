<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>

    <!-- Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Khusus Login -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            background-image: url('{{ asset('assets/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 10px;
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .login-container img {
            width: 200px;
            display: block;
            margin: 0 auto 20px;
        }

        .form-control {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 2;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Logo -->
        <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas">

        <h2>Masuk ke Akun Anda</h2>

        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
            @csrf

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}"
                class="form-control @error('username') is-invalid @enderror" required autocomplete="username" autofocus
                minlength="3" maxlength="30">
            @error('username')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password">
                <span class="fa fa-eye toggle-password"></span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <button type="submit" class="btn btn-primary" id="loginButton">
                <span class="button-text">{{ __('Login') }}</span>
                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>
        </form>

        <p>Belum Punya Akun? <a href="{{ url('/register') }}" style="color: black;">Buat Akun</a></p>
    </div>

    <!-- POPUP -->
    @if (session('login_success'))
        <div id="popup" class="popup" style="display:block;">
            <div class="popup-content">
                <p>Login Berhasil!</p>
                <button onclick="closePopup()">Tutup</button>
            </div>
        </div>
    @else
        <div id="popup" class="popup" style="display:none;">
            <div class="popup-content">
                <p>Login Berhasil!</p>
                <button onclick="closePopup()">Tutup</button>
            </div>
        </div>
    @endif

    <!-- SCRIPT -->
    <script>
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Tutup popup otomatis
            if (document.getElementById("popup").style.display === "block") {
                setTimeout(closePopup, 3000);
            }

            // Toggle password visibility
            const toggle = document.querySelector('.toggle-password');
            const password = document.querySelector('#password');

            toggle.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });

            // Tombol loading saat login
            const form = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');

            form.addEventListener('submit', function () {
                loginButton.querySelector('.button-text').classList.add('d-none');
                loginButton.querySelector('.spinner-border').classList.remove('d-none');
                loginButton.disabled = true;
            });

            // Validasi input
            form.addEventListener('input', function (e) {
                if (e.target.matches('input')) {
                    e.target.classList.toggle('is-invalid', !e.target.checkValidity());
                }
            });
        });
    </script>


@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33',
        confirmButtonText: 'Tutup'
    });
</script>
@endif

</body>

</html>
