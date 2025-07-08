@extends('layouts.master')

@section('title', 'Pricing Management')

@section('content')
    <div class="container-xxl">
        <h4 class="fw-bold py-3 mb-4">Pricing Management</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('product-prices.index') }}" class="mb-4">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label for="witel" class="form-label text-muted fw-semibold">
                        <i class="bx bx-map me-1"></i> Pilih Witel
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-buildings"></i>
                        </span>
                        <select name="witel" id="witel"
                            class="form-select form-select-sm shadow-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Semua Witel</option>
                            @foreach ($witels as $witel)
                                <option value="{{ $witel->id_witel }}" {{ request('witel') == $witel->id_witel ? 'selected' : '' }}>
                                    {{ $witel->nama_witel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="product" class="form-label text-muted fw-semibold">
                        <i class="bx bx-package me-1"></i> Pilih Produk
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-code-block"></i>
                        </span>
                        <select name="product" id="product"
                            class="form-select form-select-sm shadow-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Semua Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id_product }}"
                                    {{ request('product') == $product->id_product ? 'selected' : '' }}>
                                    {{ $product->name_product }}
                                    ({{ $product->bundlings->pluck('name_bundling')->implode(', ') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Pricing</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Pricing</button>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>WITEL</th>
                            <th>Bundling</th>
                            <th>Produk</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricings as $pricing)
                            <tr>
                                <td>{{ optional($pricing->witel)->nama_witel ?? '-' }}</td>
                                <td>{{ optional($pricing->product)->bundlings->pluck('name_bundling')->implode(', ') ?? '-' }}
                                </td>
                                <td>{{ optional($pricing->product)->name_product ?? '-' }}</td>
                                <td>{{ number_format(optional($pricing->product)->harga_materi ?? 0, 2) }}</td>
                                <td>{{ number_format($pricing->harga_jasa ?? 0, 2) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal" data-id="{{ $pricing->id }}"
                                            data-id_witel="{{ $pricing->id_witel }}"
                                            data-id_product="{{ $pricing->id_product }}"
                                            data-harga_materi="{{ $pricing->product->harga_materi ?? 0 }}"
                                            data-harga_jasa="{{ $pricing->harga_jasa }}" onclick="fillEditModal(this)">
                                            Edit
                                        </button>

                                        <form
                                            action="{{ route('product-prices.destroy', ['product_price' => $pricing->id]) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('product-prices.store') }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pricing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Witel</label>
                            <select name="id_witel" class="form-select" required>
                                @foreach ($witels as $witel)
                                    <option value="{{ $witel->id_witel }}">{{ $witel->nama_witel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Produk</label>
                            <select name="id_product" class="form-select" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id_product }}">
                                        {{ $product->name_product }}
                                        ({{ $product->bundlings->pluck('name_bundling')->implode(', ') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Harga Jasa</label>
                            <input type="number" step="0.01" name="harga_jasa" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editPricingForm" method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <input type="hidden" id="editPricingId" name="id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pricing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Witel</label>
                        <select name="id_witel" id="editWitel" class="form-select" required>
                            @foreach ($witels as $witel)
                                <option value="{{ $witel->id_witel }}">{{ $witel->nama_witel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Produk</label>
                        <select name="id_product" id="editProduct" class="form-select" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id_product }}">{{ $product->name_product }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Harga Material</label>
                        <input type="number" step="0.01" id="editMaterial" name="harga_materi" class="form-control"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Harga Jasa</label>
                        <input type="number" step="0.01" id="editJasa" name="harga_jasa" class="form-control"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function fillEditModal(button) {
            const data = button.dataset;
            

            document.getElementById('editPricingId').value = data.id;
            document.getElementById('editWitel').value = data.id_witel;
            document.getElementById('editProduct').value = data.id_product;
            document.getElementById('editMaterial').value = data.harga_materi;
            document.getElementById('editJasa').value = data.harga_jasa;

            // Set form action (jangan lupa!)
            document.getElementById('editPricingForm').action = `/product-prices/${data.id}`;
        }
    </script>

@endsection
