@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="card" style="width: 30rem;">
        <img src="{{ asset('storage/' . $produk->foto) }}" 
             width="150" 
             class="card-img-top">
    <div class="card-body">
        <h5 class="card-title">{{ $produk->nama }}</h5>

        <p class="card-text">
            Harga Beli : {{ $produk->harga_beli }} <br>
            Harga Jual : {{ $produk->harga_jual }} <br>
            Stok : {{ $produk->stok }} <br>
            User : {{ $produk->user->name }}
        </p>

        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
</div>

@endsection