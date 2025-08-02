@extends('layouts.dokter')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card p-4 shadow-sm">
            <h4 class="mb-4 fw-bold">
                <i class="ri-message-2-line"></i> Daftar Konsultasi Pasien
            </h4>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="text-center">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 25%;">Nama Pasien Konsultasi</th>
                            <th>Isi Konsultasi</th>
                            <th style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($pesanTerakhir->isEmpty())
    <tr>
        <td colspan="4" class="text-center">Belum ada konsultasi masuk.</td>
    </tr>
@else
    @foreach ($pesanTerakhir as $i => $item)
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td>
                {{ $item->pengirim->name }}
                @if($jumlahBelumDibaca->has($item->from_id))
                    <span class="badge bg-danger ms-2">
                        {{ $jumlahBelumDibaca[$item->from_id] }} pesan baru
                    </span>
                @endif
            </td>
            <td>{{ Str::limit($item->pesan ?? '-', 70) }}</td>
            <td class="text-center">
                <a href="{{ route('dokter.chat', $item->from_id) }}" class="btn btn-sm btn-primary">
                    <i class="ri-chat-1-line"></i> Chat
                </a>
            </td>
        </tr>
    @endforeach
@endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
