@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<h4>Tambah Produk</h4>

@if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('produk.store')}}" method="POST" enctype="multipart/form-data">
    @include('Produk._form')
</form>

@endsection