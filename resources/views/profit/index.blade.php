@extends('layouts.master')

@section('title', 'Rekap Profit')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Rekap Profit per Bundle</h4>

        <!-- Filter STO -->
        <form method="GET" action="{{ route('profit.index') }}" class="mb-4">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label for="sto" class="form-label text-muted fw-semibold">
                        <i class="bx bx-building-house me-1"></i> Pilih STO
                    </label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-store-alt"></i>
                        </span>
                        <select name="sto" id="sto"
                            class="form-select form-select-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Semua STO</option>
                            @foreach ($stos as $sto)
                                <option value="{{ $sto->name }}" {{ $selectedSto === $sto->name ? 'selected' : '' }}>
                                    {{ $sto->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>


        <!-- Profit per Bundle -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @foreach ($result as $bundleName => $subpakets)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="mb-3 text-primary d-flex align-items-center">
                                <i class="bx bx-box me-2"></i> {{ $bundleName }}
                            </h5>
                            @foreach ($subpakets as $item)
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom mb-2">
                                    <span class="text-muted">{{ $item->subpaket }}</span>
                                    <span class="fw-bold text-dark">Rp
                                        {{ number_format($item->profit, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-4">

        <!-- Ringkasan Profit Keseluruhan -->
        <div class="row mb-4">
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 bg-light">
                    <div class="card-body">
                        <h6 class="text-muted mb-2">Total Profit Keseluruhan</h6>
                        <h4 class="fw-bold text-success">
                            Rp {{ number_format($materialGrandTotal + $jasaKpiGrandTotal, 0, ',', '.') }}
                        </h4>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-success w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 mb-5">

            <!-- Total Material -->
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted mb-2">Total Material</h6>
                        <h4 class="fw-bold text-dark">Rp {{ number_format($materialGrandTotal, 0, ',', '.') }}</h4>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-primary w-100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jasa -->
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted mb-2">Total Jasa</h6>
                        <h4 class="fw-bold text-dark">Rp {{ number_format($jasaGrandTotal ?? 0, 0, ',', '.') }}</h4>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-info w-100"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jasa Setelah KPI -->
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h6 class="text-muted mb-2">Jasa Setelah KPI</h6>
                        <h4 class="fw-bold text-dark">Rp {{ number_format($jasaKpiGrandTotal, 0, ',', '.') }}</h4>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-success w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Info -->
        @if ($selectedKpi)
            @php
                $kpiValue = $selectedKpi;
                $kpiClass = $kpiValue < 100 ? 'alert-danger' : ($kpiValue == 100 ? 'alert-warning' : 'alert-success');
                $kpiIcon =
                    $kpiValue < 100 ? 'bx bx-trending-down' : ($kpiValue == 100 ? 'bx bx-minus' : 'bx bx-trending-up');
            @endphp

            <div class="alert {{ $kpiClass }} mt-3 rounded-4 shadow-sm d-flex align-items-center">
                <i class="{{ $kpiIcon }} fs-4 me-2"></i>
                <div>
                    <strong>KPI STO "{{ $selectedSto }}"</strong>: {{ number_format($kpiValue, 2) }}%
                </div>
            </div>
        @endif
    </div>
@endsection
