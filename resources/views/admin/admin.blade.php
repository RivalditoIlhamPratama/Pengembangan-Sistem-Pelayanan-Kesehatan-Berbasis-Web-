<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-gray-900 h-screen text-white p-5">
            <h1 class="text-xl font-bold">Puskesmas</h1>
            <ul class="mt-5">
                <li class="py-2"><a href="{{ route('admin.dashboard') }}"
                        class="text-gray-300 hover:text-white">Dashboard</a></li>
                <li class="py-2"><a href="{{ route('admin.users') }}" class="text-gray-300 hover:text-white">Data
                        Pengguna</a></li>
                <li class="py-2"><a href="{{ route('admin.data_dokter') }}"
                        class="text-gray-300 hover:text-white">Data Dokter</a></li>
                <li class="py-2"><a href="{{ route('admin.reports') }}" class="text-gray-300 hover:text-white">Data
                        Laporan Klinik</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="w-4/5 p-6">
            @yield('content')
        </div>
    </div>
</body>

</html>
