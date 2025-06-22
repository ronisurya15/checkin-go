@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">Daftar Notifikasi</h4>

    @forelse ($notifikasi as $item)
    <div class="alert alert-info shadow-sm">
        <div class="d-flex justify-content-between">
            <div>
                <h6 class="mb-1">👤 {{ $item->user->name }}</h6>
                <ul class="mb-1">
                    @foreach ($item->value as $key => $val)
                    <li><strong>{{ ucfirst($key) }}:</strong> {{ $val }}</li>
                    @endforeach
                </ul>
            </div>
            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
        </div>
    </div>
    @empty
    <div class="alert alert-secondary text-center">
        Tidak ada notifikasi saat ini.
    </div>
    @endforelse
</div>

@endsection