<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Kopdes Merah Putih</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@auth
    {{-- ============ TAMPILAN SETELAH LOGIN (sidebar + topbar) ============ --}}
    <div class="kpd-shell">

        <div class="kpd-sidebar-backdrop" id="kpdSidebarBackdrop"></div>

        <aside class="kpd-sidebar" id="kpdSidebar">
            <div class="kpd-brand">
                <div class="kpd-brand-emblem"><i class="bi bi-shop"></i></div>
                <div class="kpd-brand-text">
                    <div class="kpd-brand-title">Kopdes Merah Putih</div>
                    <div class="kpd-brand-sub">Sistem Kasir Koperasi</div>
                </div>
            </div>

            <nav class="kpd-nav">
                <div class="kpd-nav-section">Menu Utama</div>

                <a href="{{ route('dashboard') }}" class="kpd-nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>

                <a href="{{ route('produk.index') }}" class="kpd-nav-link {{ request()->is('produk*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i> Produk
                </a>

                <a href="{{ route('penjualan.index') }}" class="kpd-nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check-fill"></i> Kasir / Penjualan
                </a>

                @if(auth()->check() && auth()->user()->role_id == 1)
                    <div class="kpd-nav-section">Administrasi</div>

                    <a href="{{ route('kategori.index') }}" class="kpd-nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i> Jenis / Kategori
                    </a>

                    <a href="{{ route('admin.users') }}" class="kpd-nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Pengguna
                    </a>
                @endif
            </nav>

            <div class="kpd-sidebar-foot">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-kpd-logout">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="kpd-main">
            <header class="kpd-topbar">
                <button class="btn btn-sm btn-light d-lg-none border" id="kpdSidebarToggle">
                    <i class="bi bi-list"></i>
                </button>

                <div class="kpd-topbar-title">
                    <span class="kpd-stripe"></span>
                    @yield('title')
                </div>

                <div class="kpd-user-chip">
                    <div class="kpd-user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                    <div class="kpd-user-meta d-none d-sm-block">
                        <div class="kpd-user-name">{{ auth()->user()->name }}</div>
                        <div class="kpd-user-role">{{ auth()->user()->role->name ?? '-' }}</div>
                    </div>
                </div>
            </header>

            <main class="kpd-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('errors') && is_string(session('errors')))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ session('errors') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
@else
    {{-- ============ TAMPILAN BELUM LOGIN (halaman login full-page) ============ --}}
    @yield('content')
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const kpdToggle = document.getElementById('kpdSidebarToggle');
    const kpdSidebar = document.getElementById('kpdSidebar');
    const kpdBackdrop = document.getElementById('kpdSidebarBackdrop');
    if (kpdToggle) {
        kpdToggle.addEventListener('click', () => {
            kpdSidebar.classList.toggle('show');
            kpdBackdrop.classList.toggle('show');
        });
        kpdBackdrop?.addEventListener('click', () => {
            kpdSidebar.classList.remove('show');
            kpdBackdrop.classList.remove('show');
        });
    }
</script>
@stack('scripts')
</body>
</html>
