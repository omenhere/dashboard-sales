@extends('layouts.master')

@section('title', 'Rekap Profit')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Rekap Profit per Bundle</h4>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('profit.index') }}" class="mb-4">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label for="witel" class="form-label text-muted fw-semibold">
                        <i class="bx bx-map me-1"></i> Pilih Witel
                    </label>
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-map-pin"></i>
                        </span>
                        <select name="witel" id="witel"
                            class="form-select form-select-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Semua Witel</option>
                            @foreach ($witels as $witel)
                                <option value="{{ $witel->id_witel }}"
                                    {{ $selectedWitel === $witel->id_witel ? 'selected' : '' }}>
                                    {{ $witel->nama_witel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

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
                                <option value="{{ $sto->id_sto }}" {{ $selectedSto === $sto->id_sto ? 'selected' : '' }}>
                                    {{ $sto->nama_sto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">

            <!-- Total Penjualan -->
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 small">
                        <h6 class="text-muted mb-1">Total Penjualan</h6>
                        <h5 class="fw-bold text-info mb-0">{{ number_format($totalpenjualan, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>

            <!-- Total Material -->
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 small">
                        <h6 class="text-muted mb-1">Total Nilai Material</h6>
                        <h5 class="fw-bold text-primary mb-0">Rp {{ number_format($totalMaterialValue, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>

            <!-- Nilai Jasa -->
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 small">
                        <h6 class="text-muted mb-1">Total Nilai Jasa</h6>
                        <h5 class="fw-bold text-info mb-0">Rp {{ number_format($totalJasaValue, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>

            <!-- Total Gabungan -->
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4">
                    <div class="card-body p-3 small">
                        <h6 class="text-muted mb-1">Total Nilai</h6>
                        <h5 class="fw-bold text-success mb-0">Rp {{ number_format($totalValue, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>

        </div>


        <hr class="my-4">


        <!-- Rekap Tabel per STO dan Witel -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body p-4">
                <h5 class="mb-3 fw-semibold">Detail Rekap per STO dan Witel</h5>

                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Witel</th>
                                <th>STO</th>
                                <th class="text-end">Material</th>
                                <th class="text-end">Jasa</th>
                                <th class="text-end">KPI (%)</th>
                                <th class="text-end">BAIJ Jasa</th>
                                <th class="text-end">Pembulatan</th>
                                <th class="text-end">Total Nilai</th>
                                <th class="text-end">Total (Bulat)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapPerSto as $i => $row)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $row->witel }}</td>
                                    <td>{{ $row->sto }}</td>
                                    <td class="text-end">Rp {{ number_format($row->material, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($row->jasa, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($row->kpi, 2) }}%</td>
                                    <td class="text-end">Rp {{ number_format($row->baij_jasa, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($row->pembulatan_baij, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-semibold">Rp {{ number_format($row->total, 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-bold text-primary">Rp
                                        {{ number_format($row->total_bulat, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>



    @endsection
