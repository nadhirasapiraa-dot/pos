@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="kpd-auth-wrap">
    <div class="kpd-auth-card">
        <div class="kpd-auth-strip"></div>

        <div class="kpd-auth-header">
            <div class="kpd-auth-emblem"><i class="bi bi-shop"></i></div>
            <h4>Koperasi Desa Merah Putih</h4>
            <p>Sistem Kasir &amp; Manajemen Toko</p>
        </div>

        <div class="kpd-auth-body">

            @if ($errors->any())
                <div class="alert alert-danger py-2 px-3 small mb-3">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-envelope-fill text-danger"></i></span>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email" placeholder="nama@koperasi.desa" autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label small fw-semibold">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-lock-fill text-danger"></i></span>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" placeholder="••••••••">
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-kpd-primary w-100 py-2 mt-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>

            <p class="text-center text-muted small mt-4 mb-0">
                &copy; {{ date('Y') }} Koperasi Desa Merah Putih — Republik Indonesia
            </p>
        </div>
    </div>
</div>
@endsection
