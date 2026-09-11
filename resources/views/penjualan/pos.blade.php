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
    <!-- Kolom Kiri: Daftar Produk -->
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
                        @if(request('search'))
                            <a href="{{ route('penjualan.create') }}" class="btn btn-secondary">
                                <i class="bi bi-x-lg"></i> Reset
                            </a>
                        @endif
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
                                        <img src="{{ asset('storage/' . $product->foto) }}"
                                             alt="{{ $product->nama }}"
                                             style="width:100%;height:100%;object-fit:cover;">
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

    <!-- Kolom Kanan: Keranjang & Checkout -->
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
                    <span class="fs-4 fw-800 text-danger fw-bold">Rp {{ number_format($sale->ItemPenjualan->sum('subtotal')) }}</span>
                </div>

                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      onsubmit="return confirm('Yakin ingin di checkout?')">
                    @csrf
                    @method('PUT')
                    
                    <!-- Choice Pembayaran -->
                    <div class="mb-2">
                        <select name="payment_method" id="payment_method" class="form-select" onchange="handlePaymentChange()" required>
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash (Tunai)</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>

                    <!-- Section Uang Tunai & Kembalian (Muncul jika CASH) -->
                    <div id="cash_section" class="border rounded p-2 mb-2 bg-light" style="display: none;">
                        <div class="mb-2">
                            <label class="form-label small fw-semibold mb-1">Uang Tunai (Bayar)</label>
                            <input type="number" name="bayar" id="bayar_input" class="form-control form-control-sm" placeholder="Masukkan jumlah uang" oninput="calculateChange()">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-muted">Kembalian:</span>
                            <span id="kembalian_text" class="fw-bold text-success">Rp 0</span>
                        </div>
                    </div>

                    <!-- Section QRIS (Muncul jika QRIS) -->
                    <div id="qris_section" class="text-center border rounded p-2 mb-2 bg-light" style="display: none;">
                        <span class="small fw-semibold d-block mb-1">Scan QRIS Pembayaran:</span>
                        <!-- Ganti asset gambar qris sesuai file kamu -->
                        <img src="{{ asset('images/qris.png') }}" alt="QRIS Code" class="img-fluid border rounded p-1 style-qris" style="max-width: 150px;">
                        <small class="text-muted d-block mt-1">Pastikan pembayaran berhasil sebelum checkout</small>
                    </div>

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

<!-- JavaScript Logic untuk Kasir -->
<script>
    const grandTotal = {{ $sale->ItemPenjualan->sum('subtotal') }};

    function handlePaymentChange() {
        const method = document.getElementById('payment_method').value;
        const cashSection = document.getElementById('cash_section');
        const qrisSection = document.getElementById('qris_section');
        const bayarInput = document.getElementById('bayar_input');

        if (method === 'CASH') {
            cashSection.style.display = 'block';
            qrisSection.style.display = 'none';
            bayarInput.required = true;
        } else if (method === 'QRIS') {
            cashSection.style.display = 'none';
            qrisSection.style.display = 'block';
            bayarInput.required = false;
        } else {
            cashSection.style.display = 'none';
            qrisSection.style.display = 'none';
            bayarInput.required = false;
        }
    }

    function calculateChange() {
        const bayar = parseFloat(document.getElementById('bayar_input').value) || 0;
        const kembalian = bayar - grandTotal;
        const kembalianText = document.getElementById('kembalian_text');

        if (kembalian >= 0) {
            kembalianText.className = 'fw-bold text-success';
            kembalianText.innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
        } else {
            kembalianText.className = 'fw-bold text-danger';
            kembalianText.innerText = 'Kurang Rp ' + Math.abs(kembalian).toLocaleString('id-ID');
        }
    }
</script>

@endsection