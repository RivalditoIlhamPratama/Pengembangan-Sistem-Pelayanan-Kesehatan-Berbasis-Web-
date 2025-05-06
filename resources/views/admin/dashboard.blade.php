@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-10">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Total Pengguna -->
        <div class="bg-gradient-to-r from-blue-100 to-white shadow-md hover:shadow-xl transition-all duration-500 rounded-2xl p-6 border-l-8 border-blue-600 flex items-center">
            <div class="p-4 rounded-full bg-blue-200 text-blue-700 shadow-inner">
                <i class="ri-user-3-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xs font-semibold uppercase text-gray-600 tracking-widest">Total Pengguna</h2>
                <p class="text-3xl font-bold text-blue-800 mt-1">{{ $user }}</p>
            </div>
        </div>

        <!-- Card Total Dokter -->
        <div class="bg-gradient-to-r from-green-100 to-white shadow-md hover:shadow-xl transition-all duration-500 rounded-2xl p-6 border-l-8 border-green-600 flex items-center">
            <div class="p-4 rounded-full bg-green-200 text-green-700 shadow-inner">
                <i class="ri-stethoscope-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xs font-semibold uppercase text-gray-600 tracking-widest">Total Dokter</h2>
                <p class="text-3xl font-bold text-green-800 mt-1">{{ $user_dokter }}</p>
            </div>
        </div>

        <!-- Card Total Pengaduan -->
        <div class="bg-gradient-to-r from-red-100 to-white shadow-md hover:shadow-xl transition-all duration-500 rounded-2xl p-6 border-l-8 border-red-600 flex items-center">
            <div class="p-4 rounded-full bg-red-200 text-red-700 shadow-inner">
                <i class="ri-file-warning-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xs font-semibold uppercase text-gray-600 tracking-widest">Total Pengaduan</h2>
                <p class="text-3xl font-bold text-red-800 mt-1">{{ $pengaduan }}</p>
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
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pengguna', 'Dokter', 'Pengaduan'],
            datasets: [{
                label: 'Jumlah Data',
                data: [{{ $user }}, {{ $user_dokter }}, {{ $pengaduan }}],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',   // Blue
                    'rgba(34, 197, 94, 0.8)',    // Green
                    'rgba(239, 68, 68, 0.8)'     // Red
                ],
                borderRadius: 10,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                tooltip: {
                    backgroundColor: '#333',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#ccc',
                    borderWidth: 1
                },
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 12
                        },
                        stepSize: 1
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            },
            animation: {
                duration: 1200,
                easing: 'easeOutQuart'
            }
        }
    });
</script>
@endsection
