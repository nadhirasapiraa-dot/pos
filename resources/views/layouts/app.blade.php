<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23FF0000' class='bi bi-shop' viewBox='0 0 16 16'><path d='M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.75 8 2.37 2.37 0 0 1 7.5 7.083 2.37 2.37 0 0 1 5.25 8a2.37 2.37 0 0 1-2-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045a.5.5 0 0 0-.12.325v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V9a.5.5 0 0 1 .5-.5zM5 11a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4H5v-4z'/></svg>">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') — Kopdes Merah Putih</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@auth

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
                <a href="{{ route('dashboard') }}" class="kpd-nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>

                @if(auth()->check() && auth()->user()->role_id == 1)
                    <a href="{{ route('admin.users') }}" class="kpd-nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Pengguna
                    </a>

                    <a href="{{ route('kategori.index') }}" class="kpd-nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="bi bi-tags-fill"></i> Kategori
                    </a>
                @endif

                <a href="{{ route('produk.index') }}" class="kpd-nav-link {{ request()->is('produk*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i> Produk
                </a>

                <a href="{{ route('penjualan.index') }}" class="kpd-nav-link {{ request()->is('penjualan*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check-fill"></i> Penjualan
                </a>
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
