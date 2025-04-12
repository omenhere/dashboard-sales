@extends('layouts.master')

@section('title', 'Rekap Penjualan')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0 text-primary"><i class="bx bx-cart-alt me-2"></i>Rekap Penjualan</h4>
            <button class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#addSaleModal">
                <i class="bx bx-plus me-1"></i> Tambah Penjualan
            </button>
        </div>

        <form method="GET" action="{{ route('sales.rekap') }}" class="mb-4">
            <div class="row align-items-end g-3">
                <!-- Witel Dropdown -->
                <div class="col-md-4">
                    <label for="witel" class="form-label text-muted fw-semibold">
                        <i class="bx bx-network-chart me-1"></i> Pilih Witel
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-map"></i>
                        </span>
                        <select name="witel" id="witel"
                            class="form-select form-select-sm shadow-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Pilih Witel</option>
                            @foreach ($witels as $witel)
                                <option value="{{ $witel->name }}" {{ $selectedWitel === $witel->name ? 'selected' : '' }}>
                                    {{ $witel->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- STO Dropdown -->
                @if ($selectedWitel)
                    <div class="col-md-4">
                        <label for="sto" class="form-label text-muted fw-semibold">
                            <i class="bx bx-building-house me-1"></i> Pilih STO
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                                <i class="bx bx-store-alt"></i>
                            </span>
                            <select name="sto" id="sto"
                                class="form-select form-select-sm shadow-sm border-start-0 rounded-end-pill"
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
                @endif
            </div>
        </form>



        <!-- Card Bundle -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @foreach ($result as $bundleName => $subpakets)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">
                            <h5 class="text-dark mb-3 d-flex align-items-center">
                                <i class="bx bx-layer me-2 text-primary fs-4"></i>
                                {{ $bundleName }}
                            </h5>

                            @forelse ($subpakets as $item)
                                <div class="d-flex justify-content-between align-items-center py-2 mb-2 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex justify-content-center align-items-center me-3"
                                            style="width: 36px; height: 36px;">
                                            <i class="bx bx-package text-muted fs-5"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">{{ $item->subpaket }}</small>
                                        </div>
                                    </div>
                                    <span class="text-dark fw-semibold">{{ number_format($item->total) }}</span>
                                </div>
                            @empty
                                <p class="text-muted small">Tidak ada data subpaket.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>



        @if ($selectedWitel || $selectedSto)

            <hr class="my-5">




            <form method="GET" class="mb-4">
                <input type="hidden" name="witel" value="{{ $selectedWitel }}">
                <input type="hidden" name="sto" value="{{ $selectedSto }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="bundle_filter" class="form-label">Filter Nama Paket</label>
                        <select name="bundle" id="bundle_filter" class="form-select form-select-sm"
                            onchange="this.form.submit()">
                            <option value="">Semua Paket</option>
                            @foreach (\App\Models\Bundle::all() as $bundle)
                                <option value="{{ $bundle->id }}"
                                    {{ request('bundle') == $bundle->id ? 'selected' : '' }}>
                                    {{ $bundle->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="subpaket_filter" class="form-label">Filter Subpaket</label>
                        <select name="subpaket" id="subpaket_filter" class="form-select form-select-sm"
                            onchange="this.form.submit()">
                            <option value="">Semua Subpaket</option>
                            @foreach (\App\Models\Subpaket::with('bundle')->get() as $subpaket)
                                <option value="{{ $subpaket->id }}"
                                    {{ request('subpaket') == $subpaket->id ? 'selected' : '' }}>
                                    {{ $subpaket->bundle->name }} - {{ $subpaket->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>


            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="mb-3 text-dark">
                        <i class="bx bx-table me-2 text-primary"></i> Ringkasan Quantity Detail
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Witel</th>
                                    <th>STO</th>
                                    <th>Nama Paket</th>
                                    <th>Subpaket</th>
                                    <th>Total Quantity</th>
                                    <th class="text-end">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($witels as $witel)
                                    @foreach ($witel->stos as $sto)
                                        @php
                                            if ($selectedWitel && $selectedWitel !== $witel->name) {
                                                continue;
                                            }
                                            if ($selectedSto && $selectedSto !== $sto->name) {
                                                continue;
                                            }

                                            $sales = \App\Models\Sale::with(['subpaket.bundle'])
                                                ->where('witel_id', $witel->id)
                                                ->where('sto_id', $sto->id)
                                                ->get()
                                                ->groupBy('subpaket_id');
                                        @endphp

                                        @foreach ($sales as $group)
                                            @php
                                                $subpaket = $group->first()->subpaket;
                                                $bundleName = $subpaket?->bundle?->name ?? '-';
                                                $subpaketName = $subpaket?->name ?? '-';
                                                $quantity = $group->sum('quantity');

                                                // Terapkan filter berdasarkan request
                                                if (request('bundle') && $subpaket->bundle_id != request('bundle')) {
                                                    continue;
                                                }
                                                if (request('subpaket') && $subpaket->id != request('subpaket')) {
                                                    continue;
                                                }
                                            @endphp

                                            <tr>
                                                <td class="text-center">{{ $no++ }}</td>
                                                <td>{{ $witel->name }}</td>
                                                <td>{{ $sto->name }}</td>
                                                <td>{{ $bundleName }}</td>
                                                <td>{{ $subpaketName }}</td>
                                                <td class="text-end">{{ number_format($quantity) }}</td>
                                                <td class="text-end">
                                                    <div class="mt-2">
                                                        <a href="javascript:void(0);" class="btn btn-sm btn-warning"
                                                            onclick="editSale('{{ $group->first()->id }}')">
                                                            <i class="bx bx-edit"></i>
                                                        </a>

                                                        <form action="{{ route('sale.destroy', $group->first()->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif


    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="addSaleModal" tabindex="-1" aria-labelledby="addSaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('sale.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label class="form-label">Witel</label>
                        <select name="witel_id" class="form-select" required>
                            @foreach ($witels as $witel)
                                <option value="{{ $witel->id }}">{{ $witel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">STO</label>
                        <select name="sto_id" class="form-select" required>
                            @foreach ($stos as $sto)
                                <option value="{{ $sto->id }}">{{ $sto->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Subpaket</label>
                        <select name="subpaket_id" class="form-select" required>
                            @foreach (\App\Models\Subpaket::with('bundle')->get() as $subpaket)
                                <option value="{{ $subpaket->id }}">{{ $subpaket->bundle->name }} -
                                    {{ $subpaket->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Jumlah (Quantity)</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="sale_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editSaleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editSaleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Penjualan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editSaleId">
                        <div class="mb-3">
                            <label>Witel</label>
                            <select id="editWitel" name="witel_id" class="form-select form-select-sm"></select>
                        </div>
                        <div class="mb-3">
                            <label>STO</label>
                            <select id="editSto" name="sto_id" class="form-select form-select-sm"></select>
                        </div>
                        <div class="mb-3">
                            <label>Subpaket</label>
                            <select id="editSubpaket" name="subpaket_id" class="form-select form-select-sm"></select>
                        </div>
                        <div class="mb-3">
                            <label>Quantity</label>
                            <input type="number" id="editQuantity" name="quantity"
                                class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" id="editDate" name="sale_date" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('scripts')
    <script>
        function editSale(id) {
            $.get('/sale/' + id + '/edit', function(data) {
                $('#editSaleId').val(id);

                // Populate Witel
                $('#editWitel').empty();
                data.witels.forEach(witel => {
                    $('#editWitel').append(
                        `<option value="${witel.id}" ${witel.id === data.sale.witel_id ? 'selected' : ''}>${witel.name}</option>`
                    );
                });

                // Populate STO
                $('#editSto').empty();
                data.stos.forEach(sto => {
                    $('#editSto').append(
                        `<option value="${sto.id}" ${sto.id === data.sale.sto_id ? 'selected' : ''}>${sto.name}</option>`
                    );
                });

                // Populate Subpaket
                $('#editSubpaket').empty();
                data.subpakets.forEach(sub => {
                    $('#editSubpaket').append(
                        `<option value="${sub.id}" ${sub.id === data.sale.subpaket_id ? 'selected' : ''}>${sub.name}</option>`
                    );
                });

                // Set values
                $('#editQuantity').val(data.sale.quantity);
                $('#editDate').val(data.sale.sale_date);

                // Tampilkan modal
                $('#editSaleModal').modal('show');
            });
        }

        $('#editSaleForm').submit(function(e) {
            e.preventDefault();
            const id = $('#editSaleId').val();
            const formData = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                witel_id: $('#editWitel').val(),
                sto_id: $('#editSto').val(),
                subpaket_id: $('#editSubpaket').val(),
                quantity: $('#editQuantity').val(),
                sale_date: $('#editDate').val()
            };

            $.ajax({
                url: '/sale/' + id,
                method: 'POST',
                data: formData,
                success: function(res) {
                    $('#editSaleModal').modal('hide');
                    location.reload(); // refresh page (bisa diganti partial refresh)
                },
                error: function(xhr) {
                    alert('Gagal menyimpan perubahan. Silakan cek kembali.');
                }
            });
        });
    </script>
@endpush
