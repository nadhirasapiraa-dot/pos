@extends('layouts.app')

@section('title', 'Jenis / Kategori')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


<div class="kpd-page-header">
    <div>
        <h3>Jenis / Kategori Item</h3>
        <p><i class="bi bi-tags me-1"></i>Kelola pengelompokan produk</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="btn btn-kpd-primary">
        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
    </a>
</div>

<div class="kpd-card">
    <div class="kpd-card-body">
        <div class="table-responsive">
            <table class="table kpd-table kpd-table-center align-middle mb-0">
                <thead>
                    <tr>
                        <th width="60" class="kpd-fit">No</th>
                        <th>Nama Kategori</th>
                        <th class="text-end kpd-fit">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $key => $kategori)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="fw-semibold">
                                <i class="bi bi-tag-fill text-danger me-1"></i>{{ $kategori->nama }}
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-outline-kpd btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="kpd-empty">
                                <i class="bi bi-inbox"></i>
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
