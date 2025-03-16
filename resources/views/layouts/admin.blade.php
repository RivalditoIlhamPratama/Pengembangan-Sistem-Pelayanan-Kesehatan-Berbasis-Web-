<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FontAwesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <!-- Sidebar -->
<div class="w-64 bg-gray-900 text-white flex flex-col">
    <div class="p-5 flex items-center space-x-3">
        <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas" class="w-15 h-14">
        <h1 class="text-xl font-bold">Puskesmas</h1>
    </div>
    <ul class="space-y-2 px-4">
        <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4">Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}" class="block py-2 px-4 active">Data Pengguna</a></li>
        <li><a href="#" class="block py-2 px-4">Data Dokter</a></li>
        <li><a href="#" class="block py-2 px-4">Data Pengaduan</a></li>
        <li><a href="#" class="block py-2 px-4">Data Laporan Klinik</a></li>
    </ul>
</div>

<br>
<br>
<br>
<br>

        <!-- Content -->
        <div class="flex-1 p-10">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <button class="text-2xl"><i class="ri-menu-line"></i></button>
                <div class="flex items-center space-x-3">
                    <i class="ri-user-fill text-xl"></i>
                    <span>Admin</span>
                </div>
            </div>

            <div>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
