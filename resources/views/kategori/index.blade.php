@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')


@include('layouts.navbar')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Jenis / Kategori Item</h4>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Kategori</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $key => $kategori)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection