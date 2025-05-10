<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Puskesmas</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remixicon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
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
                <a href="{{ route('admin.dashboard') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                    <i class="ri-dashboard-line mr-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.users') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.users') ? 'bg-gray-800' : '' }}">
                    <i class="ri-user-line mr-2"></i> Data Pengguna
                </a>
                <a href="{{ route('admin.data_pengaduan') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.data_pengaduan') ? 'bg-gray-800' : '' }}">
                    <i class="ri-clipboard-line mr-2"></i> Data Pengaduan
                </a>
                <a href="{{ route('admin.data_dokter') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.data_dokter') ? 'bg-gray-800' : '' }}">
                    <i class="ri-user-3-line mr-2"></i> Data Dokter
                </a>
                <a href="{{ route('admin.laporan_klinik') }}" class="py-2 px-4 rounded hover:bg-gray-800 {{ request()->routeIs('admin.laporan_klinik') ? 'bg-gray-800' : '' }}">
                    <i class="ri-file-line mr-2"></i> Laporan Klinik
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
                    <a href="{{ route('admin.profil') }}" class="hover:text-blue-600 font-medium">
                        Admin
                    </a>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="text-black hover:text-gray-500 ml-3">
                            <i class="ri-logout-box-r-line text-xl"></i>
                        </button>
                    </form>
                    
                    <script>
                        function confirmLogout() {
                            if (confirm("Apakah Anda yakin ingin logout?")) {
                                document.getElementById('logout-form').submit();
                            }
                        }
                    </script>
                    
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

    @push('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                document.getElementById('edit-id').value = this.dataset.id;
                document.getElementById('edit-name').value = this.dataset.name;
                document.getElementById('edit-username').value = this.dataset.username;
                document.getElementById('edit-email').value = this.dataset.email;
                document.getElementById('edit-role').value = this.dataset.role;
            });
        });
    });
    </script>
    @endpush

</body>
</html>
