<style>
  .navbar {
    background: #ffffff !important;
    border-bottom: 1px solid #D9E7E2;
    box-shadow: 0 2px 12px -6px rgba(34, 66, 58, 0.1);
  }

  .navbar-brand {
    color: #22423A !important;
    font-weight: 700;
    letter-spacing: 0.02em;
  }

  .navbar-nav .nav-link {
    color: #5C7D74 !important;
    font-weight: 500;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: background 0.15s ease, color 0.15s ease;
  }

  .navbar-nav .nav-link:hover {
    color: #3F7D6E !important;
    background: #F0F7F4;
  }

  .navbar-nav .nav-link.active {
    color: #ffffff !important;
    background: #3F7D6E;
  }

  .navbar-toggler {
    border-color: #D9E7E2 !important;
  }
  .navbar-toggler:focus {
    box-shadow: 0 0 0 3px #E4F0EC !important;
  }

  /* Tombol Logout - solid teal, tetap terlihat tapi senada */
  .navbar form .btn-danger {
    background: #3F7D6E !important;
    border: 1px solid #3F7D6E !important;
    color: #ffffff !important;
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 18px;
    box-shadow: 0 4px 10px -4px rgba(63, 125, 110, 0.5);
    transition: background 0.15s ease, transform 0.05s ease;
  }

  .navbar form .btn-danger:hover {
    background: #34675A !important;
    border-color: #34675A !important;
  }

  .navbar form .btn-danger:active {
    transform: translateY(1px);
  }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">POS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
        </li>
      </ul>
      <form class="position-absolute top-50 start-100 translate-middle" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
      </form>
    </div>
  </div>
</nav>