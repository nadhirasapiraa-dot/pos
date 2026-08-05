@extends('layouts.app')

@section('title', $mode === 'edit' ? 'Edit Penjualan' : 'Kasir')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>{{ $mode === 'edit' ? 'Edit Penjualan' : 'Kasir / Transaksi Baru' }}</h3>
        <p><i class="bi bi-receipt-cutoff me-1"></i>
            Status:
            @if($sale->status === 'OPEN')
                <span class="badge badge-kpd-open">OPEN</span>
            @else
                <span class="badge badge-kpd-completed">{{ $sale->status }}</span>
            @endif
        </p>
    </div>
    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">

    {{-- ==================== PRODUK ==================== --}}
    <div class="col-lg-6">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5><i class="bi bi-grid-3x3-gap-fill text-danger me-2"></i>Daftar Produk</h5>
            </div>
            <div class="kpd-card-body">
                <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari produk...">
                        <button class="btn btn-outline-kpd" type="submit">Cari</button>
                    </div>
                </form>

                <div style="max-height:56vh; overflow:auto;" class="pe-1">
                    @forelse($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="d-flex align-items-center gap-2 border rounded-3 p-2 mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex-grow-1">
                            <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" style="border-color:#E7DFDC;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-2 bg-light d-flex align-items-center justify-content-center flex-shrink-0" style="width:36px;height:36px;">
                                        <i class="bi bi-box-seam text-danger"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold small">{{ $product->nama }}</div>
                                        <small class="text-muted">Rp {{ number_format($product->harga_jual) }} &middot; stok {{ $product->stok }}</small>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <div style="width:70px;">
                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   class="form-control form-control-sm text-center {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                        </div>

                        <div>
                            <button class="btn btn-kpd-primary btn-sm {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" style="width:38px;">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    </form>
                    @empty
                    <div class="kpd-empty">
                        <i class="bi bi-search"></i>
                        Produk tidak ditemukan.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    {{-- ==================== KERANJANG ==================== --}}
    <div class="col-lg-6">
        <div class="kpd-card h-100 d-flex flex-column">
            <div class="kpd-card-header">
                <h5><i class="bi bi-cart-fill text-danger me-2"></i>Keranjang</h5>
            </div>

            <div class="table-responsive" style="max-height:40vh; overflow:auto;">
                <table class="table kpd-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th style="width:90px;">Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->ItemPenjualan as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->produk->nama }}</td>
                            <td>Rp {{ number_format($item->produk->harga_jual) }}</td>
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->kuantitas }}" min="1"
                                           class="form-control form-control-sm text-center" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td class="fw-semibold">Rp {{ number_format($item->subtotal) }}</td>
                            <td>
                                @can('delete', $item)
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="kpd-empty py-4">
                                <i class="bi bi-cart-x"></i>
                                Keranjang masih kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="kpd-card-body mt-auto border-top">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold">Total Pembayaran</span>
                    <span class="fs-4 fw-800 text-danger fw-bold">Rp {{ number_format($sale->total_pembayaran) }}</span>
                </div>

                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      onsubmit="return confirm('Yakin ingin di checkout?')">
                    @csrf
                    @METHOD('PUT')
                    <select name="payment_method" class="form-select mb-2">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-kpd-primary w-100 py-2 fw-semibold {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        <i class="bi bi-check-circle me-1"></i> Checkout
                    </button>
                </form>

                @can('delete', $sale)
                <form method="POST" action="{{ route('penjualan.destroy', $sale->id) }}"
                      class="mt-2"
                      onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        <i class="bi bi-x-circle me-1"></i> Batal Transaksi
                    </button>
                </form>
                @endcan
            </div>
        </div>
    </div>

</div>

@endsection
