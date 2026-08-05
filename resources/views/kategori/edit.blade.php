@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Edit Kategori</h3>
        <p><i class="bi bi-tags me-1"></i>{{ $kategori->nama }}</p>
    </div>
    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="kpd-card" style="max-width: 520px;">
    <div class="kpd-card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label small fw-semibold">Nama Kategori</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama', $kategori->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-kpd-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Update
                </button>
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
