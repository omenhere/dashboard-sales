@extends('layouts.master')

@section('title', 'Pricing Management')

@section('content')
    <div class="container-xxl">
        <h4 class="fw-bold py-3 mb-4">Pricing Management</h4>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('pricing.index') }}" class="mb-4">
            <div class="row align-items-end g-3">

                <!-- STO Dropdown -->
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
                                <option value="{{ $sto->id }}" {{ request('sto') == $sto->id ? 'selected' : '' }}>
                                    {{ $sto->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Subpaket Dropdown -->
                <div class="col-md-6">
                    <label for="subpaket" class="form-label text-muted fw-semibold">
                        <i class="bx bx-package me-1"></i> Pilih Subpaket
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                            <i class="bx bx-code-block"></i>
                        </span>
                        <select name="subpaket" id="subpaket"
                            class="form-select form-select-sm shadow-sm border-start-0 rounded-end-pill"
                            onchange="this.form.submit()">
                            <option value="">Semua Subpaket</option>
                            @foreach ($subpakets as $subpaket)
                                <option value="{{ $subpaket->id }}"
                                    {{ request('subpaket') == $subpaket->id ? 'selected' : '' }}>
                                    {{ $subpaket->bundle->name }} - {{ $subpaket->name }}
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
                            <th>STO</th>
                            <th>Bundle</th>
                            <th>Subpaket</th>
                            <th>Material</th>
                            <th>Jasa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pricings as $pricing)
                            <tr>
                                <td>{{ $pricing->sto->witel->name }}</td>
                                <td>{{ $pricing->sto->name }}</td>
                                <td>{{ $pricing->subpaket->bundle->name }}</td>
                                <td>{{ $pricing->subpaket->name }}</td>
                                <td>{{ number_format($pricing->material_price, 2) }}</td>
                                <td>{{ number_format($pricing->jasa_price, 2) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-warning"
                                            onclick="editPricing('{{ $pricing->id }}')">
                                            Edit
                                        </button>
                                        <form action="{{ route('pricing.destroy', $pricing->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                Hapus
                                            </button>
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
                <form class="modal-content" method="POST" action="{{ route('pricing.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pricing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <!-- STO -->
                        <div class="mb-3">
                            <label for="stoSelect">STO</label>
                            <select id="stoSelect" name="sto_id" class="form-select" required>
                                @foreach ($stos as $sto)
                                    <option value="{{ $sto->id }}" data-witel="{{ $sto->witel->id }}">
                                        {{ $sto->name }} - ({{ $sto->witel->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- WITEL (readonly display + hidden input) -->
                        <div class="mb-3">
                            <label for="witelSelectDisplay">Witel</label>
                            <select id="witelSelectDisplay" class="form-select" disabled>
                                @foreach ($witels as $witel)
                                    <option value="{{ $witel->id }}">{{ $witel->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="witel_id" id="witelSelect">
                        </div>

                        <!-- Subpaket -->
                        <div class="mb-3">
                            <label>Subpaket</label>
                            <select name="subpaket_id" class="form-select" required>
                                @foreach ($subpakets as $sp)
                                    <option value="{{ $sp->id }}">
                                        {{ $sp->bundle->name }} - {{ $sp->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga -->
                        <div class="mb-3">
                            <label>Harga Material</label>
                            <input type="number" step="0.01" name="material_price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Jasa</label>
                            <input type="number" step="0.01" name="jasa_price" class="form-control" required>
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
            <form id="editPricingForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pricing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editPricingId">

                        <div class="mb-3">
                            <label>STO</label>
                            <select id="editSto" name="sto_id" class="form-select"></select>
                        </div>

                        <div class="mb-3">
                            <label>Witel</label>
                            <select id="editWitel" class="form-select" disabled></select>
                            <input type="hidden" name="witel_id" id="editWitelHidden">
                        </div>

                        <div class="mb-3">
                            <label>Subpaket</label>
                            <select id="editSubpaket" name="subpaket_id" class="form-select"></select>
                        </div>

                        <div class="mb-3">
                            <label>Harga Material</label>
                            <input type="number" step="0.01" id="editMaterial" name="material_price"
                                class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Harga Jasa</label>
                            <input type="number" step="0.01" id="editJasa" name="jasa_price" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stoSelect = document.getElementById('stoSelect');
            const witelSelectDisplay = document.getElementById('witelSelectDisplay');
            const witelSelectHidden = document.getElementById('witelSelect');

            function updateWitelFromSto() {
                const selectedSto = stoSelect.options[stoSelect.selectedIndex];
                const witelId = selectedSto.getAttribute('data-witel');

                // Set display dropdown
                for (let i = 0; i < witelSelectDisplay.options.length; i++) {
                    witelSelectDisplay.options[i].selected = witelSelectDisplay.options[i].value === witelId;
                }

                // Set hidden input
                witelSelectHidden.value = witelId;
            }

            stoSelect.addEventListener('change', updateWitelFromSto);
            updateWitelFromSto(); // set initial value
        });
    </script>

    <script>
        function editPricing(id) {
            $.get(`/pricing/${id}/edit`, function(data) {
                $('#editPricingId').val(id);

                // STO dropdown
                $('#editSto').empty();
                data.stos.forEach(sto => {
                    $('#editSto').append(`<option value="${sto.id}" ${sto.id == data.pricing.sto_id ? 'selected' : ''}>
                    ${sto.name} - (${sto.witel.name})
                </option>`);
                });

                // Witel display
                $('#editWitel').empty();
                data.witels.forEach(witel => {
                    $('#editWitel').append(`<option value="${witel.id}" ${witel.id == data.pricing.witel_id ? 'selected' : ''}>
                    ${witel.name}
                </option>`);
                });
                $('#editWitelHidden').val(data.pricing.witel_id);

                // Subpaket
                $('#editSubpaket').empty();
                data.subpakets.forEach(sub => {
                    $('#editSubpaket').append(`<option value="${sub.id}" ${sub.id == data.pricing.subpaket_id ? 'selected' : ''}>
                    ${sub.bundle.name} - ${sub.name}
                </option>`);
                });

                $('#editMaterial').val(data.pricing.material_price);
                $('#editJasa').val(data.pricing.jasa_price);

                $('#editModal').modal('show');
            });
        }

        $('#editPricingForm').submit(function(e) {
            e.preventDefault();
            const id = $('#editPricingId').val();

            const formData = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                witel_id: $('#editWitelHidden').val(),
                sto_id: $('#editSto').val(),
                subpaket_id: $('#editSubpaket').val(),
                material_price: $('#editMaterial').val(),
                jasa_price: $('#editJasa').val()
            };

            $.ajax({
                url: `/pricing/${id}`,
                method: 'POST',
                data: formData,
                success: function() {
                    $('#editModal').modal('hide');
                    location.reload();
                },
                error: function() {
                    alert('Gagal menyimpan perubahan.');
                }
            });
        });
    </script>

@endsection
