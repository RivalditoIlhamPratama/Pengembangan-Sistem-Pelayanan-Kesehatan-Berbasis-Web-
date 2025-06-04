<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        /* Add background image */
        body {
            background-image: url('{{ asset('assets/background.jpg') }}');
            /* Pastikan file ada di /public/assets */
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
            /* Semi-transparent background */
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
        }

        .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Logo Image -->
        <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas"> <!-- Logo image -->

        <h2>Masuk ke Akun Anda</h2>

        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
            @csrf
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}"
                class="form-control @error('username') is-invalid @enderror" required autocomplete="username" autofocus
                minlength="3" maxlength="30">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password">Password</label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            <i class="fa fa-eye"></i>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <button type="submit" class="btn btn-primary" id="loginButton">
                <span class="button-text">{{ __('Login') }}</span>
                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>

        </form>

        <p>Belum Punya Akun? <a href="{{ url('/register') }}" style="color: black;">Buat Akun</a></p>
    </div>

    <!-- Popup div -->
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

    <script>
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById("popup").style.display === "block") {
                setTimeout(closePopup, 3000); // Automatically close popup after 3 seconds
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const passwordInput = this.previousElementSibling;
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' :
                        'password';
                    passwordInput.setAttribute('type', type);
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            });

            // Form submission handling
            const form = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');

            form.addEventListener('submit', function() {
                const buttonText = loginButton.querySelector('.button-text');
                const spinner = loginButton.querySelector('.spinner-border');

                buttonText.classList.add('d-none');
                spinner.classList.remove('d-none');
                loginButton.disabled = true;
            });

            // Client-side validation
            form.addEventListener('input', function(e) {
                if (e.target.matches('input')) {
                    if (e.target.checkValidity()) {
                        e.target.classList.remove('is-invalid');
                    } else {
                        e.target.classList.add('is-invalid');
                    }
                }
            });
        });
    </script>

</body>

</html>
