<nav class="navbar navbar-expand bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POS</a>

    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav mb-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @if(auth()->user()->role_id == 1)
        <li class="nav-item">
          <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" aria-current="page" href="{{ route('admin.users') }}">Users</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('penjualan*') ? 'active' : '' }}" aria-current="page" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
        @if(auth()->user()->role_id == 1)
        <li class="nav-item">
          <a class="nav-link {{ request()->is('kategori') ? 'active' : '' }}" aria-current="page" href="{{ route('kategori.index') }}">Jenis Item</a>
        </li>
        @endif
      </ul>
      <form action="{{ route('logout') }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
      </form>
    </div>
  </div>
</nav>