<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <script>
        function showPopup() {
            document.getElementById("popup").style.display = "block";
        }
        function closePopup() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Masuk ke Akun Anda</h2>
        <form onsubmit="showPopup(); return false;">
            <label for="email">Email</label>
            <input type="email" id="email" value="">
            
            <label for="password">Password</label>
            <input type="password" id="password">
            
            <label for="login-as">Login Sebagai</label>
            <div class="custom-select-container">
                <select id="login-as" class="custom-select">
                    <option value="pasien">Pasien</option>
                    <option value="dokter">Dokter</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <a href="index.html" class="login-button" onclick="handleLogin(event)">Masuk</a>

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

    <div id="popup" class="popup">
        <div class="popup-content">
            <p>Login Berhasil!</p>
            <button onclick="closePopup()">Tutup</button>
        </div>
    </div>
</body>
</html>