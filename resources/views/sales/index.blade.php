@extends('layouts.master')

@section('title', 'Rekap Penjualan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-primary">
                <i class="bx bx-cart-alt me-2"></i>Rekap Penjualan
            </h4>
        </div>

        <form method="GET" action="{{ route('sales.index') }}" class="mb-4">
            <div class="row align-items-end g-3">
                <div class="col-md-3">
                    <label for="witel" class="form-label">Pilih Witel</label>
                    <select name="witel" id="witel" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Witel</option>
                        @foreach ($witels as $witel)
                            <option value="{{ $witel->id_witel }}"
                                {{ $selectedWitel == $witel->id_witel ? 'selected' : '' }}>
                                {{ $witel->nama_witel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- STO (hanya tampil bila Witel dipilih) --}}
                @if ($selectedWitel)
                    <div class="col-md-3">
                        <label for="sto" class="form-label">Pilih STO</label>
                        <select name="sto" id="sto" class="form-select form-select-sm"
                            onchange="this.form.submit()">
                            <option value="">Semua STO</option>
                            @foreach ($stos->where('id_witel', $selectedWitel) as $sto)
                                <option value="{{ $sto->id_sto }}" {{ $selectedSto == $sto->id_sto ? 'selected' : '' }}>
                                    {{ $sto->nama_sto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="col-md-3">
                    <label for="product" class="form-label">Pilih Produk</label>
                    <select name="product" id="product" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">Semua Produk</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id_product }}"
                                {{ $selectedProd == $product->id_product ? 'selected' : '' }}>
                                {{ $product->name_product }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @foreach ($bundlingSummary as $bundleName => $items)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="text-dark mb-3">
                                <i class="bx bx-layer me-2 text-primary fs-4"></i>{{ $bundleName }}
                            </h5>

                            @forelse ($items as $item)
                                <div class="d-flex justify-content-between align-items-center py-2 mb-2 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <span
                                            class="bg-light rounded-circle d-flex justify-content-center align-items-center me-3"
                                            style="width: 36px; height: 36px;">
                                            <i class="bx bx-package text-muted fs-5"></i>
                                        </span>
                                        <small class="text-muted">{{ $item->product }}</small>
                                    </div>
                                    <span class="fw-semibold">{{ number_format($item->total) }}</span>
                                </div>
                            @empty
                                <p class="text-muted small mb-0">Tidak ada data produk.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="text-dark mb-0">
                        <i class="bx bx-table me-2 text-primary"></i> Ringkasan Quantity per Produk
                    </h5>
                    <button class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal"
                        data-bs-target="#addSaleModal">
                        <i class="bx bx-plus me-1"></i> Tambah Penjualan
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width:5%">#</th>
                                <th>Witel</th>
                                <th>STO</th>
                                <th>Bundling</th>
                                <th>Produk</th>
                                <th class="text-end" style="width:10%">Quantity</th>
                                <th class="text-end" style="width:10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $index => $sale)
                                @php
                                    $bundle = optional($sale->product->bundlings->first())->name_bundling ?? '-';
                                    $productName = optional($sale->product)->name_product ?? '-';
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $sale->witel->nama_witel ?? '-' }}</td>
                                    <td>{{ $sale->sto->nama_sto ?? '-' }}</td>
                                    <td>{{ $bundle }}</td>
                                    <td>{{ $productName }}</td>
                                    <td class="text-end">{{ number_format($sale->quantity) }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addSaleModal" tabindex="-1" aria-labelledby="addSaleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('sales.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Penjualan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-2">
                            <label class="form-label">Witel</label>
                            <select name="id_witel" class="form-select" required>
                                @foreach ($witels as $witel)
                                    <option value="{{ $witel->id_witel }}">{{ $witel->nama_witel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">STO</label>
                            <select name="id_sto" class="form-select" required>
                                @foreach ($stos as $sto)
                                    <option value="{{ $sto->id_sto }}">{{ $sto->nama_sto }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Produk</label>
                            <select name="id_product" class="form-select" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id_product }}">
                                        {{ $product->name_product }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Jumlah (Quantity)</label>
                            <input type="number" name="quantity" class="form-control" required min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
