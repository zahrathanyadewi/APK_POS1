<style>
  .navbar {
    background: #ffffff !important;
    border-bottom: 1px solid #ECDFDA;
    box-shadow: 0 2px 12px -6px rgba(74, 44, 56, 0.1);
  }

  .navbar-brand {
    font-family: 'Italiana', serif;
    color: #4A2C38 !important;
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .navbar-nav .nav-link {
    color: #8A7580 !important;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: background 0.15s ease, color 0.15s ease;
  }

  .navbar-nav .nav-link:hover {
    color: #4A2C38 !important;
    background: #F8EFEA;
  }

  .navbar-nav .nav-link.active {
    color: #ffffff !important;
    background: #4A2C38;
  }

  .navbar-toggler {
    border-color: #ECDFDA !important;
  }
  .navbar-toggler:focus {
    box-shadow: 0 0 0 3px #F3E4DE !important;
  }

  .navbar form .btn-danger {
    background: #4A2C38 !important;
    border: 1px solid #4A2C38 !important;
    color: #ffffff !important;
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 18px;
    box-shadow: 0 4px 10px -4px rgba(74, 44, 56, 0.5);
    transition: background 0.15s ease, transform 0.05s ease;
  }

  .navbar form .btn-danger:hover {
    background: #3A2029 !important;
    border-color: #3A2029 !important;
  }

  .navbar form .btn-danger:active {
    transform: translateY(1px);
  }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('tentang') }}">Aveline</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        @if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'admin')
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Pengguna</a>
        </li>
        @endif
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>
      <form class="position-absolute top-50 start-100 translate-middle" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Keluar</button>
      </form>
    </div>
  </div>
</nav>