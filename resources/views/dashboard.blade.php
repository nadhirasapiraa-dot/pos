{{-- memanggil app.blade.php --}}
@extends('layouts.app')

{{-- mengatur title halaman --}}
@section('title', 'Dashboard')

{{--batas aawal isi konten--}}
@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Ringkasan Hari Ini</h3>
        <p><i class="bi bi-calendar3 me-1"></i>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</p>
    </div>
</div>

@can('viewAny', App\Models\User::class)
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="kpd-stat kpd-stat-red">
            <div class="kpd-stat-label">Total Penjualan Hari Ini</div>
            <div class="kpd-stat-value">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
            <i class="bi bi-graph-up-arrow kpd-stat-icon"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="kpd-stat kpd-stat-dark">
            <div class="kpd-stat-label">Jumlah Transaksi</div>
            <div class="kpd-stat-value">{{ $ringkasan['total_transaksi'] }}</div>
            <i class="bi bi-receipt kpd-stat-icon"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="kpd-stat kpd-stat-green">
            <div class="kpd-stat-label">Pembayaran Tunai</div>
            <div class="kpd-stat-value">Rp {{ number_format($ringkasan['total_cash']) }}</div>
            <i class="bi bi-cash-stack kpd-stat-icon"></i>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="kpd-stat kpd-stat-gold">
            <div class="kpd-stat-label">Pembayaran Non-Tunai</div>
            <div class="kpd-stat-value">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
            <i class="bi bi-qr-code kpd-stat-icon"></i>
        </div>
    </div>
</div>
@endcan

<div class="row g-3 mb-4">
    <div class="col-lg-6">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5><i class="bi bi-exclamation-diamond-fill text-warning me-2"></i>Stok Rendah</h5>
            </div>
            <div class="kpd-card-body p-0">
                <div class="table-responsive">
                    <table class="table kpd-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th class="text-end">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkStokRendah as $index => $produk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td class="text-end"><span class="badge badge-kpd-open">{{ $produk->stok }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="kpd-empty py-3">
                                    <i class="bi bi-check2-circle"></i>
                                    Tidak ada produk dengan stok rendah.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kpd-card-body pt-0">
                {{ $produkStokRendah->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="kpd-card h-100">
            <div class="kpd-card-header">
                <h5><i class="bi bi-x-octagon-fill text-danger me-2"></i>Stok Habis</h5>
            </div>
            <div class="kpd-card-body p-0">
                <div class="table-responsive">
                    <table class="table kpd-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th class="text-end">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkStokHabis as $index => $produk)
                            <tr>
                                <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td class="text-end"><span class="badge bg-danger">{{ $produk->stok }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="kpd-empty py-3">
                                    <i class="bi bi-check2-circle"></i>
                                    Tidak ada produk dengan stok habis.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kpd-card-body pt-0">
                {{ $produkStokHabis->links() }}
            </div>
        </div>
    </div>
</div>

<div class="kpd-card">
    <div class="kpd-card-header">
        <h5><i class="bi bi-trophy-fill text-warning me-2"></i>Produk Terlaris Hari Ini</h5>
    </div>
    <div class="kpd-card-body p-0">
        <div class="table-responsive">
            <table class="table kpd-table mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th class="text-end">Unit Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkTerlaris as $index => $produk)
                    <tr>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td class="text-end"><span class="badge badge-kpd-completed">{{ $produk->total_terjual }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="kpd-empty py-3">
                            <i class="bi bi-inboxes"></i>
                            Belum ada produk terjual hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- batas akhirnya-->
@endsection
