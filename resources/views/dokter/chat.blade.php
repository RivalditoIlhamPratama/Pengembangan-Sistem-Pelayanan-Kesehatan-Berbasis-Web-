@extends('layouts.dokter')

@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold mb-3 text-primary">
                <i class="ri-message-3-line"></i> Konsultasi dengan {{ $namaPasien }}
            </h5>

            <div class="border p-3 mb-3" style="height: 400px; overflow-y: auto;" id="chatBox">
                @foreach ($messages as $msg)
                    <div class="mb-2 {{ $msg->from_id == auth()->user()->id_user ? 'text-end' : 'text-start' }}">
                        <div class="d-inline-block p-2 rounded 
                            {{ $msg->from_id == auth()->user()->id_user ? 'bg-primary text-white' : 'bg-light' }}">
                            {{ $msg->pesan }}
                        </div>
                        <div class="text-muted small mt-1">
                            {{ $msg->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('dokter.kirim') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="to_id" value="{{ $chatWith->id_user }}">
                <div class="input-group">
                    <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-send-plane-line"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
