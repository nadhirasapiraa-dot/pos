@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Detail Produk</h3>
        <p><i class="bi bi-box-seam me-1"></i>Informasi lengkap produk</p>
    </div>
    <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-5 mb-3">
        <div class="kpd-card h-100">
            <div class="kpd-card-body text-center">
                @if($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}"
                         class="rounded-3 img-fluid" style="max-height:260px; object-fit:cover">
                @else
                    <div class="rounded-3 border bg-light d-flex align-items-center justify-content-center mx-auto" style="height:220px; width:100%;">
                        <i class="bi bi-image text-muted" style="font-size:2.5rem;"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-3">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5>{{ $produk->nama }}</h5>
                <span class="badge bg-light text-dark border">{{ $produk->kategori->nama ?? '-' }}</span>
            </div>
            <div class="kpd-card-body">
                <div class="row gy-3">
                    <div class="col-sm-6">
                        <div class="text-muted small">Harga Beli</div>
                        <div class="fw-bold fs-5">Rp {{ number_format($produk->harga_beli) }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Harga Jual</div>
                        <div class="fw-bold fs-5 text-danger">Rp {{ number_format($produk->harga_jual) }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Stok Tersedia</div>
                        <div class="fw-bold fs-5">{{ $produk->stok }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Ditambahkan Oleh</div>
                        <div class="fw-semibold">{{ $produk->user->name ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
