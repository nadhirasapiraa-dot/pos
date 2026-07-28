@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@if(session('errors'))
<div class="alert alert-danger">
    {{ session('errors') }}
</div>
@endif

<h4 class="mb-3">
    {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan'}}
</h4>

<div class="row">

    {{-- ==================== PRODUK ==================== --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">
                <div class="mb-3">
                    <form method="GET" action="{{ route('penjualan.create') }}">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari produk...">
                    </form>
                </div>

                @foreach($products as $product)
                <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2 align-items-center">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="col-7">
                        <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            <div class="d-flex align-items-center gap-2">
                                {{-- Gambar produk --}}
                                <img src="{{ asset('storage/'. $product->foto) }}"
                                     alt="Gambar"
                                     class="rounded-circle"
                                     style="width:45px; height:45px; object-fit:cover;">

                                {{-- Nama & harga --}}
                                <div>
                                    <div class="fw-semibold">{{ $product->nama}}</div>
                                    <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-3">
                        <input type="number"
                               name="quantity"
                               value="1"
                               min="1"
                               class="form-control {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}">
                    </div>

                    <div class="col-2">
                        <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>


    {{-- ==================== KERANJANG ==================== --}}
    <div class="col-md-6">
        <div class="card">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
<tbody> 
    @forelse($sale->ItemPenjualan as $item) 
    <tr> 
        {{-- 1. Kolom Nama Produk --}}
        <td>{{ $item->produk->nama }}</td> 
        
        {{-- 2. Kolom Harga --}}
        <td>Rp {{ number_format($item->produk->harga_jual) }}</td> 
        
        {{-- 3. Kolom Qty (Sudah Diperbaiki) --}}
        <td>
            <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}"> 
                @csrf 
                @method('PUT') 
                {{-- Ditambahkan onchange agar ketika angka diganti, langsung otomatis tersimpan --}}
                <input type="number" name="quantity" value="{{ $item->kuantitas }}" min="1" class="form-control form-control-sm" onchange="this.form.submit()"> 
            </form> 
        </td> 
        
        {{-- 4. Kolom Subtotal --}}
        <td>Rp {{ number_format($item->subtotal) }}</td> 
        
        {{-- 5. Kolom Aksi Hapus --}}
        <td> 
            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}"> 
                @csrf 
                @method('DELETE') 
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button> 
            </form> 
        </td> 
    </tr> 
    @empty 
    <tr> 
        {{-- Colspan diubah jadi 5 karena jumlah kolom di atas ada 5 --}}
        <td colspan="5" class="text-center text-muted py-3">Keranjang masih kosong</td> 
    </tr> 
    @endforelse 
</tbody>

                </tbody>
            </table>

            <div class="card-footer">
                <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

                <form method="POST" action="" class="mt-2">
                    @csrf
                    <select name="payment_method" class="form-select mb-2">
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100">
                        Checkout
                    </button>
                </form>

                <form method="POST" action="" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger w-100">
                        Batal Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection