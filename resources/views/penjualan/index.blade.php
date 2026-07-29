@extends('layouts.app')

@section('title', 'Ini Halaman Ujicoba')

@section('content')

@include('layouts.navbar')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show my-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('errors'))
<div class="alert alert-danger" > 
  {{ session('errors') }}
</div>
@endif

<h1>Halaman Penjualan</h1>
<a href="{{ route('penjualan.create')}}"  method="GET" class="btn btn-primary btm-sm">Create</a>
<form action="{{ route('penjualan.index') }} " method="GET" class="mb-3">
        <div class="input-group mt-3">
        <input
            type="text"
            name="search"
            value="{{ request()->search}}"
            class="form-control"
            placeholder="Search penjualan"
        >

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tanggal Transaksi</th>
      <th scope="col">Kasir</th>
      <th scope="col">Total Pembayaran</th>
      <th scope="col">Metode Pembayaran</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse($sales as $sale)
    <tr>
      <th scope="row">{{$sales->firstItem() + $loop->index}}</th>
      <td>{{$sale->created_at->translatedFormat('d-m-Y H:i:s')}} </td>
      <td>{{$sale->user->name}}</td>
      <td>Rp.{{number_format($sale->total_pembayaran)}}</td>
      <td>{{$sale->metode_pembayaran}}</td>
      <td>.{{$sale->status}}</td>
      <td class="d-flex gap-1">
<a href="{{ route('penjualan.show', $sale->id) }}" class="btn btn-primary btn-sm">
    Detail
</a>
@can('view' , $sale)
||
    <a href="{{ route('penjualan.edit' , $sale) }}" class="btn btn-warning">Edit</a>
      ||
@endcan
@can('view' , $sale)
    <form action="{{ route('penjualan.destroy' , $sale) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
            Hapus
        </button>
</form>
@endcan
</td>
</tr>
@empty
<tr>
    <td colspan="6">Data Tidak Ditemukan</td>
</tr>
@endforelse
  </tbody>
</table>

{{$sales->links()}}