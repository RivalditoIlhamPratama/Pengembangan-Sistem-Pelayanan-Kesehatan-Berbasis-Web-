<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Rekam Medis</title>

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
        <div class="p-5 flex items-center space-x-3 border-b border-gray-700">
            <img src="{{ asset('assets/11.png') }}" alt="Logo Puskesmas" class="w-12 h-12">
            <h1 class="text-xl font-bold">Puskesmas</h1>
        </div>

        <nav class="mt-4 flex flex-col gap-2 px-4">
            <a href="{{ route('stafrekammedis.dashboard') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('stafrekammedis.dashboard') ? 'bg-gray-800' : '' }}">
                <i class="ri-folder-user-line mr-2"></i> Rekam Medis
            </a>
        </nav>
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
                <span>Staff Rekam Medis</span>
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
