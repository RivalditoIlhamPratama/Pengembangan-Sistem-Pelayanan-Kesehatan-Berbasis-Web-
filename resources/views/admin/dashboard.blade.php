@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-10">Dashboard Admin</h1>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Card: Total Pengguna -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">
            <div class="bg-purple-500 p-3 rounded-full text-white text-xl">
                <i class="ri-user-3-fill"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">{{ $user }}</p>
                <p class="text-sm text-gray-500">Total Pengguna</p>
            </div>
        </div>

        <!-- Card: Total Dokter -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">
            <div class="bg-blue-500 p-3 rounded-full text-white text-xl">
                <i class="ri-stethoscope-fill"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">{{ $user_dokter }}</p>
                <p class="text-sm text-gray-500">Total Dokter</p>
            </div>
        </div>

        <!-- Card: Total Pengaduan -->
        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">
            <div class="bg-pink-500 p-3 rounded-full text-white text-xl">
                <i class="ri-file-warning-fill"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">{{ $pengaduan }}</p>
                <p class="text-sm text-gray-500">Total Pengaduan</p>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow p-4 flex items-center gap-4">
            <div class="bg-green-500 p-3 rounded-full text-white text-xl">
                <i class="ri-file-list-3-fill"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">{{ $laporan_klinik }}</p>
                <p class="text-sm text-gray-500">Total Laporan Klinik</p>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="mt-14 bg-white shadow-xl p-8 rounded-2xl">
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">📈 Statistik Jumlah Data</h2>
        <div class="w-full md:w-3/4 lg:w-2/3 mx-auto">
            <canvas id="dashboardChart" height="260"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');

    const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
    gradientBlue.addColorStop(0, 'rgba(59, 130, 246, 0.9)');
    gradientBlue.addColorStop(1, 'rgba(59, 130, 246, 0.4)');

    const gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
    gradientGreen.addColorStop(0, 'rgba(34, 197, 94, 0.9)');
    gradientGreen.addColorStop(1, 'rgba(34, 197, 94, 0.4)');

    const gradientRed = ctx.createLinearGradient(0, 0, 0, 400);
    gradientRed.addColorStop(0, 'rgba(239, 68, 68, 0.9)');
    gradientRed.addColorStop(1, 'rgba(239, 68, 68, 0.4)');

    const gradientYellow = ctx.createLinearGradient(0, 0, 0, 400);
    gradientYellow.addColorStop(0, 'rgba(234, 179, 8, 0.9)');
    gradientYellow.addColorStop(1, 'rgba(234, 179, 8, 0.4)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pengguna', 'Dokter', 'Pengaduan', 'Laporan Klinik'],
            datasets: [{
                label: 'Jumlah Data',
                data: [{{ $user }}, {{ $user_dokter }}, {{ $pengaduan }}, {{ $laporan_klinik }}],
                backgroundColor: [gradientBlue, gradientGreen, gradientRed, gradientYellow],
                borderRadius: { topLeft: 12, topRight: 12 },
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#94a3b8',
                    borderWidth: 1,
                    padding: 10
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { size: 13 },
                        color: '#4b5563'
                    },
                    grid: {
                        color: '#e5e7eb',
                        borderDash: [4, 4]
                    }
                },
                x: {
                    ticks: {
                        font: { size: 13 },
                        color: '#4b5563'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutBack'
            }
        }
    });
</script>



<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('login_success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Login Berhasil!',
        text: 'Selamat datang kembali 👋',
        showConfirmButton: false,
        timer: 2500
    });
</script>
@endif
@endsection
