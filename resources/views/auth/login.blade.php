<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Masuk ke Akun Anda</h2>
        <form method="POST" action="{{ route('login.post') }}" id="loginForm">
            @csrf
            <label for="username">Email</label>
<input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror"
            required autocomplete="username" autofocus
            minlength="3" maxlength="30"
            pattern="[a-zA-Z0-9]+" title="Only alphanumeric characters allowed">
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

            <label for="login-as">Login Sebagai</label>
            <div class="custom-select-container">
<select id="login-as" name="login-as" class="custom-select">
                    <option value="pasien">Pasien</option>
                    <option value="dokter">Dokter</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" id="loginButton">
                <span class="button-text">{{ __('Login') }}</span>
                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>

            <script>
              function handleLogin(event) {
                  event.preventDefault(); // Mencegah perpindahan halaman langsung
                  showPopup(); // Menampilkan pop-up

                  // Tunggu beberapa detik sebelum pindah halaman
                  setTimeout(function() {
                      window.location.href = "index.html";
                  }, 2000); // Berpindah ke halaman dalam 2 detik
              }
          </script>

        </form>
        <p>Belum Punya Akun? <a href="{{ url('/register') }}" style="color: black;">Buat Akun</a></p>
    </div>

    <!-- Popup div -->
@if(session('login_success'))
<div id="popup" class="popup" style="display:block;">
    <div class="popup-content">
        <p>Login Berhasil!</p>
        <button onclick="closePopup()">Tutup</button>
    </div>
</div>
@else
    @if(session('login_success'))
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
        // Automatically close popup after 3 seconds
        setTimeout(closePopup, 3000);
    }
});
</script>
@endif

<script>
function closePopup() {
    document.getElementById("popup").style.display = "none";
}

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById("popup").style.display === "block") {
        // Automatically close popup after 3 seconds
        setTimeout(closePopup, 3000);
    }
});
</script>
</body>
</html>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
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
@endpush



