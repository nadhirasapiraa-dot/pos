@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Detail Transaksi #{{ $penjualan->id }}</h3>
        <p><i class="bi bi-receipt me-1"></i>Rincian struk transaksi</p>
    </div>
    <a href="{{ route('penjualan.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row g-3">
    {{-- Informasi Ringkas Transaksi --}}
    <div class="col-lg-4">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5><i class="bi bi-info-circle-fill text-danger me-2"></i>Informasi Transaksi</h5>
            </div>
            <div class="kpd-card-body">
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-muted small">Tanggal</span>
                    <span class="fw-semibold small">{{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-muted small">Kasir</span>
                    <span class="fw-semibold small">{{ $penjualan->user->name ?? '-' }}</span>
                </div>
                <div class="mb-2 d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Metode Pembayaran</span>
                    <span class="badge bg-light text-dark border">{{ $penjualan->metode_pembayaran ?? '-' }}</span>
                </div>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Status</span>
                    @if($penjualan->status === 'COMPLETED')
                        <span class="badge badge-kpd-completed">{{ $penjualan->status }}</span>
                    @else
                        <span class="badge badge-kpd-open">{{ $penjualan->status }}</span>
                    @endif
                </div>
                <hr>
                <div class="text-muted small">Total Pembayaran</div>
                <h4 class="text-danger fw-bold mb-0">Rp {{ number_format($penjualan->total_pembayaran) }}</h4>
            </div>
        </div>
    </div>

    {{-- Daftar Item Produk yang Dibeli --}}
    <div class="col-lg-8">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5><i class="bi bi-basket-fill text-danger me-2"></i>Item Produk Dibeli</h5>
            </div>
            <div class="kpd-card-body p-0">
                <div class="table-responsive">
                    <table class="table kpd-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga Satuan</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan->itemPenjualan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                                <td>Rp {{ number_format($item->harga_satuan) }}</td>
                                <td class="text-center">{{ $item->kuantitas }}</td>
                                <td class="text-end fw-semibold">Rp {{ number_format($item->subtotal) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="kpd-empty">
                                    <i class="bi bi-inbox"></i>
                                    Tidak ada item
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
