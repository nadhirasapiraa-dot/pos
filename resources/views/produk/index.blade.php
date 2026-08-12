@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="kpd-page-header">
    <div>
        <h3>Data Produk</h3>
        <p><i class="bi bi-box-seam me-1"></i>Kelola produk yang dijual di koperasi</p>
    </div>
    @can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" class="btn btn-kpd-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Produk
    </a>
    @endcan
</div>

<div class="kpd-card">
    <div class="kpd-card-body pb-0">
        <form action="{{ route('produk.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Cari nama produk...">
                <button class="btn btn-outline-kpd" type="submit">Cari</button>
                @if(request('search'))
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
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
                        <th class="kpd-fit">Foto</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th class="kpd-fit">Stok</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-end kpd-fit">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td>
                            @if($product->foto)
                                <img src="{{ asset('storage/' . $product->foto) }}"
                                     width="52" height="52"
                                     class="rounded-3 border" style="object-fit:cover">
                            @else
                                <div class="rounded-3 border d-flex align-items-center justify-content-center bg-light text-muted" style="width:52px;height:52px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $product->nama }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->kategori->nama ?? '-' }}</span></td>
                        <td>Rp {{ number_format($product->harga_beli) }}</td>
                        <td>Rp {{ number_format($product->harga_jual) }}</td>
                        <td>
                            @if($product->stok == 0)
                                <span class="badge bg-danger">{{ $product->stok }}</span>
                            @elseif($product->stok <= 5)
                                <span class="badge badge-kpd-open">{{ $product->stok }}</span>
                            @else
                                <span class="badge badge-kpd-completed">{{ $product->stok }}</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $product->user->name ?? '-' }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-1">
                                <a href="{{ route('produk.show', $product) }}" class="btn btn-outline-secondary btn-sm" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @can('update', $product)
                                <a href="{{ route('produk.edit', $product) }}" class="btn btn-outline-kpd btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @endcan
                                @can('delete', $product)
                                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" title="Hapus"
                                            onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="kpd-empty">
                            <i class="bi bi-inbox"></i>
                            Data produk tidak tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="kpd-card-body pt-0">
        {{ $products->links() }}
    </div>
</div>
@endsection
