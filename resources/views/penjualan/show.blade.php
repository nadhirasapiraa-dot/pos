@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Detail Transaksi #{{ $penjualan->id }}</h4>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary btn-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="row">
        {{-- Informasii Ringkas Transaksi --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Informasi Transaksi</h6>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Tanggal:</strong> {{ $penjualan->created_at->translatedFormat('d-m-Y H:i:s') }}</p>
                    <p class="mb-1"><strong>Kasir:</strong> {{ $penjualan->user->name ?? '-' }}</p>
                    <p class="mb-1"><strong>Metode Pembayaran:</strong> <span class="badge bg-info text-dark">{{ $penjualan->metode_pembayaran ?? '-' }}</span></p>
                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">{{ $penjualan->status }}</span></p>
                    <hr>
                    <h5 class="text-primary">Total: Rp {{ number_format($penjualan->total_pembayaran) }}</h5>
                </div>
            </div>
        </div>

        {{-- Daftar Item Produk yang Dibeli --}}
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Item Produk Dibelinya</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
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
                                <td>{{ $item->produk->nama ?? 'Produk Dihapus' }}</td>
                                <td>Rp {{ number_format($item->harga_satuan) }}</td>
                                <td class="text-center">{{ $item->kuantitas }}</td>
                                <td class="text-end">Rp {{ number_format($item->subtotal) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada item</td>
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