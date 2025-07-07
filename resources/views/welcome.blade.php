@extends('layouts.master')

@section('title', 'Welcome')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y text-center">
        <div class="py-5">
            <h1 class="text-primary fw-bold mb-3">
                <i class="bx bx-home-alt me-2"></i> Selamat Datang
            </h1>
            <p class="lead text-muted">Sistem Manajemen Data Penjualan</p>

            {{-- <a href="{{ route('sales.rekap') }}" class="btn btn-primary mt-3 rounded-pill px-4">
                <i class="bx bx-line-chart"></i> Lihat Rekap Penjualan
            </a> --}}
        </div>
    </div>
@endsection
