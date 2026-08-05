@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')

<div class="kpd-page-header">
    <div>
        <h3>Edit Pengguna</h3>
        <p><i class="bi bi-person-gear me-1"></i>{{ $user->name }}</p>
    </div>
    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="kpd-card" style="max-width: 560px;">
    <div class="kpd-card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @include('users._form')
        </form>
    </div>
</div>

@endsection
