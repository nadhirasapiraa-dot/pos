@extends('layouts.app')

@section('title', 'Tentang Aplikasi')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="kpd-card text-center">
            
            <!-- Header Kartu Informasi -->
            <div class="kpd-card-header justify-content-center bg-light">
                <h5 class="mb-0 text-danger">
                    <i class="bi bi-shop me-2"></i>Tentang Toko Grosir
                </h5>
            </div>

            <div class="kpd-card-body py-4">
                <!-- Deskripsi Utama -->
                <p class="text-start text-muted lh-base mb-4" style="font-size: 0.95rem;">
                    <strong>Toko grosir</strong> adalah tempat usaha perdagangan yang menjual produk atau barang dalam kuantitas/jumlah besar kepada pedagang eceran (retailer), pemilik bisnis kecil, instansi, atau pelaku usaha lainnya, bukan langsung ke konsumen akhir untuk pemakaian pribadi.
                </p>

                <hr class="my-3" style="border-color: var(--kpd-border);">

                <!-- Informasi Pengembang & Kontak -->
                <div class="d-flex flex-column gap-2 text-start small">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-code-slash text-danger fs-5"></i>
                        <div>
                            <span class="text-muted d-block">Pengembang Aplikasi</span>
                            <strong class="fs-6" style="color: var(--kpd-text);">Nadira Sapira Putri M.</strong>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2 mt-2">
                        <i class="bi bi-envelope-at text-danger fs-5"></i>
                        <div>
                            <span class="text-muted d-block">Kontak / Email</span>
                            <a href="mailto:nadhirasapiraa@gmail.com" class="fw-bold text-decoration-none" style="color: var(--kpd-red-dark);">
                                nadhirasapiraa@gmail.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Ringkas -->
            <div class="kpd-card-header bg-light justify-content-center py-2">
                <small class="text-muted">Sistem Informasi Transaksi Kasir &copy; {{ date('Y') }}</small>
            </div>

        </div>
    </div>
</div>

@endsection