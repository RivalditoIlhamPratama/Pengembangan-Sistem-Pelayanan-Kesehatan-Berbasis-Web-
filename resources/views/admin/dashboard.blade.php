@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-4">
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-3 gap-6">
        <!-- Card Total Pengguna -->
        <div class="bg-gray-100 shadow-md p-6 rounded-lg flex items-center">
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                <i class="ri-user-3-fill text-3xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-gray-700">Total Pengguna</h2>
                <p class="text-3xl font-semibold">120</p>
            </div>
        </div>

        <!-- Card Total Dokter -->
        <div class="bg-gray-100 shadow-md p-6 rounded-lg flex items-center">
            <div class="bg-green-100 text-green-600 p-4 rounded-full">
                <i class="ri-stethoscope-fill text-3xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-gray-700">Total Dokter</h2>
                <p class="text-3xl font-semibold">25</p>
            </div>
        </div>

        <!-- Card Total Pengaduan -->
        <div class="bg-gray-100 shadow-md p-6 rounded-lg flex items-center">
            <div class="bg-red-100 text-red-600 p-4 rounded-full">
                <i class="ri-file-warning-fill text-3xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-lg font-bold text-gray-700">Total Pengaduan</h2>
                <p class="text-3xl font-semibold">30</p>
            </div>
        </div>
    </div>
</div>
@endsection
