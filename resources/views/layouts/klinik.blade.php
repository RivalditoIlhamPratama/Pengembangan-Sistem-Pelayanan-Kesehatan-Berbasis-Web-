<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Umum </title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>


<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <!-- Background Ikon Acak -->
            <div class="absolute inset-0 z-0 pointer-events-none">
                <!-- Deretan ikon berantakan -->
                <i class="ri-heart-pulse-line text-white text-xl absolute top-4 left-5 opacity-5"></i>
                <i class="ri-stethoscope-line text-white text-2xl absolute top-12 right-6 opacity-5"></i>
                <i class="ri-capsule-line text-white text-lg absolute top-24 left-8 opacity-5"></i>
                <i class="ri-first-aid-kit-line text-white text-2xl absolute top-40 right-10 opacity-5"></i>
                <i class="ri-dna-line text-white text-xl absolute top-32 right-3 opacity-5"></i>
                <i class="ri-user-heart-line text-white text-2xl absolute bottom-36 left-4 opacity-5"></i>
                <i class="ri-nurse-line text-white text-lg absolute bottom-24 right-6 opacity-5"></i>
                <i class="ri-syringe-line text-white text-xl absolute top-56 left-6 opacity-5"></i>
                <i class="ri-hospital-line text-white text-xl absolute bottom-20 left-16 opacity-5"></i>
                <i class="ri-heart-add-line text-white text-2xl absolute bottom-36 right-10 opacity-5"></i>
                <i class="ri-capsule-fill text-white text-lg absolute top-72 right-4 opacity-5"></i>
                <i class="ri-microscope-line text-white text-lg absolute bottom-[250px] left-[50px] opacity-5"></i>
                <i class="ri-mental-health-line text-white text-xl absolute top-[300px] left-[10px] opacity-5"></i>
                <i class="ri-thermometer-line text-white text-xl absolute top-[160px] right-[60px] opacity-5"></i>
                <i class="ri-contrast-drop-line text-white text-lg absolute bottom-[70px] right-[80px] opacity-5"></i>
                <i class="ri-aliens-line text-white text-lg absolute top-[450px] left-[40px] opacity-5"></i>
                <i class="ri-drop-line text-white text-2xl absolute top-[360px] right-[30px] opacity-5"></i>
                <i class="ri-medicine-bottle-line text-white text-xl absolute bottom-[180px] left-[100px] opacity-5"></i>
                <i class="ri-brain-line text-white text-2xl absolute top-[220px] right-[100px] opacity-5"></i>
                <i class="ri-bandage-line text-white text-xl absolute bottom-[130px] right-[50px] opacity-5"></i>
                <i class="ri-eye-2-line text-white text-lg absolute top-[80px] left-[120px] opacity-5"></i>
                <i class="ri-hospital-line text-white text-xl absolute bottom-[20px] right-[15px] opacity-5"></i>
            </div>
        
        <div class="p-5 flex items-center space-x-3 border-b border-gray-700">
            <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas" class="w-12 h-12">
            <h1 class="text-xl font-bold">Puskesmas</h1>
        </div>


        <nav class="mt-4 flex flex-col gap-2 px-4">
            <a href="{{ route('klinik.dashboard') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('klinik.dashboard') ? 'bg-gray-800' : '' }}">
                <i class="ri-dashboard-line mr-2"></i> Dashboard
            </a>
            <a href="{{ route('klinik.laporan') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('klinik.laporan') ? 'bg-gray-800' : '' }}">
                <i class="ri-clipboard-line mr-2"></i> Laporan Klinik
            </a>
        </nav>
        <div class="mt-auto px-4 pb-4 border-t border-gray-700 pt-4">
            <a href="" class="py-2 px-4 rounded hover:bg-gray-800 flex items-center {{ request()->routeIs('admin.activity_log') ? 'bg-gray-800' : '' }}">
                <i class="ri-history-line mr-2"></i> Riwayat Aktivitas
            </a>
            <a href="" class="py-2 px-4 rounded hover:bg-gray-800 flex items-center mt-2 {{ request()->routeIs('admin.settings') ? 'bg-gray-800' : '' }}">
                <i class="ri-settings-3-line mr-2"></i> Pengaturan Sistem
            </a>
        </div>

        <div class="flex justify-center gap-4 mt-6 mb-4">
            <i class="ri-heart-pulse-line text-red-400 text-2xl animate-pulse"></i>
            <i class="ri-stethoscope-line text-green-400 text-2xl animate-bounce"></i>
            <i class="ri-dna-line text-purple-400 text-2xl animate-spin"></i>
            <i class="ri-first-aid-kit-line text-orange-400 text-2xl animate-pulse"></i>
            <i class="ri-capsule-line text-pink-400 text-2xl animate-bounce"></i>
        </div>

    </aside>





    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="flex justify-between items-center p-4 bg-white border-b">
            <button class="text-2xl text-gray-700">
                <i class="ri-menu-line"></i>
            </button>
            <div class="flex items-center space-x-3">
                <i class="ri-user-fill text-xl"></i>
                <span>{{ $klinik->namaKlinik }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-black hover:text-gray-500 ml-3">
                        <i class="ri-logout-box-r-line text-xl"></i>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 overflow-auto">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
