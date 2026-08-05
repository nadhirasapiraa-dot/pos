@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Tambah Pengguna</h3>
        <p><i class="bi bi-person-plus me-1"></i>Buat akun admin atau kasir baru</p>
    </div>
    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="kpd-card" style="max-width: 560px;">
    <div class="kpd-card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @include('users._form')
        </form>
    </div>
</div>

@endsection
