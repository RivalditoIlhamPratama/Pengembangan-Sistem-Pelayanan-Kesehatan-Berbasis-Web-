@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-600 mb-8">Dashboard Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Total Pengguna -->
        <div class="bg-white/50 backdrop-blur-lg shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl p-6 border-l-4 border-blue-500 flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-tr from-blue-200 to-blue-100 text-blue-600 shadow-md">
                <i class="ri-user-3-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm uppercase tracking-wide text-gray-600 font-semibold">Total Pengguna</h2>
                <p class="text-2xl font-bold text-blue-700 mt-1">{{ $user }}</p>
            </div>
        </div>

        <!-- Card Total Dokter -->
        <div class="bg-white/50 backdrop-blur-lg shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl p-6 border-l-4 border-green-500 flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-tr from-green-200 to-green-100 text-green-600 shadow-md">
                <i class="ri-stethoscope-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm uppercase tracking-wide text-gray-600 font-semibold">Total Dokter</h2>
                <p class="text-2xl font-bold text-green-700 mt-1">{{ $user_dokter }}</p>
            </div>
        </div>

        <!-- Card Total Pengaduan -->
        <div class="bg-white/50 backdrop-blur-lg shadow-lg hover:shadow-2xl transition-all duration-300 rounded-xl p-6 border-l-4 border-red-500 flex items-center">
            <div class="p-4 rounded-full bg-gradient-to-tr from-red-200 to-red-100 text-red-600 shadow-md">
                <i class="ri-file-warning-fill text-4xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm uppercase tracking-wide text-gray-600 font-semibold">Total Pengaduan</h2>
                <p class="text-2xl font-bold text-red-700 mt-1">{{ $pengaduan }}</p>
            </div>
        </div>
    </div>

    <!-- Grafik -->
<div class="mt-12 bg-white/70 backdrop-blur-md p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">📈 Statistik Jumlah</h2>
    <div class="w-full md:w-2/3 lg:w-1/2 mx-auto">
        <canvas id="dashboardChart" style="max-width: 100%; height: 260px;"></canvas>
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
                label: 'Jumlah',
                data: [{{ $user }}, {{ $user_dokter }}, {{ $pengaduan }}],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(34, 197, 94, 0.7)',
                    'rgba(239, 68, 68, 0.7)'
                ],
                borderRadius: 8,
                borderSkipped: false,
                maxBarThickness: 50
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
