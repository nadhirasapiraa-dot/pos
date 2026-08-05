@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Tambah Produk</h3>
        <p><i class="bi bi-box-seam me-1"></i>Lengkapi data produk baru</p>
    </div>
    <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="kpd-card">
    <div class="kpd-card-body">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @include('produk._form')
        </form>
    </div>
</div>

@endsection
