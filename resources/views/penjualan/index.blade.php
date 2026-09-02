@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Data Penjualan</h3>
        <p><i class="bi bi-cart-check me-1"></i>Riwayat transaksi kasir</p>
    </div>
    <a href="{{ route('penjualan.create') }}" class="btn btn-kpd-primary">
        <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
    </a>
</div>

<div class="kpd-card">
    <div class="kpd-card-body pb-0">
        <form action="{{ route('penjualan.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request()->search }}"
                       class="form-control" placeholder="Cari nama kasir...">
                <button class="btn btn-outline-kpd" type="submit">Cari</button>
                @if(request()->search)
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="kpd-card-body">
        <div class="table-responsive">
            <table class="table kpd-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="kpd-fit">#</th>
                        <th>Tanggal Transaksi</th>
                        <th>Kasir</th>
                        <th class="kpd-fit">Total Pembayaran</th>
                        <th class="kpd-fit">Metode</th>
                        <th class="kpd-fit">Status</th>
                        <th class="text-end kpd-fit">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sales->firstItem() + $loop->index }}</td>
                        <td>{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td class="fw-semibold">Rp {{ number_format($sale->total_pembayaran) }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="bi {{ $sale->metode_pembayaran === 'CASH' ? 'bi-cash' : 'bi-qr-code' }} me-1"></i>
                                {{ $sale->metode_pembayaran }}
                            </span>
                        </td>
                        <td>
                            @if($sale->status === 'OPEN')
                                <span class="badge badge-kpd-open">OPEN</span>
                            @elseif($sale->status === 'COMPLETED')
                                <span class="badge badge-kpd-completed">COMPLETED</span>
                            @else
                                <span class="badge badge-kpd-success">{{ $sale->status }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('penjualan.show', $sale->id) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($sale->status === 'OPEN')
                                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-outline-kpd btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endcan
                               @if($sale->status === 'OPEN')
                                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="kpd-empty">
                            <i class="bi bi-inbox"></i>
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="kpd-card-body pt-0">
        {{ $sales->links() }}
    </div>
</div>
@endsection
