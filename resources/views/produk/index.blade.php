@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>
<style>
  .btn-primary {
    background: #4A2C38 !important;
    border-color: #4A2C38 !important;
    font-weight: 600;
    border-radius: 50px;
    padding: 10px 24px;
  }
  .btn-primary:hover {
    background: #3A2029 !important;
    border-color: #3A2029 !important;
  }

  .search-box {
    background: #ffffff;
    border-radius: 50px;
    padding: 6px 6px 6px 18px;
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1.5px solid #ECDFDA;
    max-width: 520px;
    margin-bottom: 1.5rem;
  }
  .search-box input {
    border: none;
    outline: none;
    flex: 1;
    background: transparent;
    padding: 8px 0;
  }
  .search-box button.btn-search {
    background: #8A7580;
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 8px 20px;
    font-weight: 500;
  }
  .search-box button.btn-search:hover {
    background: #6F5D66;
  }

  .produk-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 1.5rem;
  }

  /* Layout kartu, bukan tabel biasa */
  .produk-card {
    background: #ffffff;
    border: 1px solid #ECDFDA;
    border-left: 5px solid #A97D8C;
    border-radius: 14px;
    padding: 14px 20px;
    margin-bottom: 12px;
    display: grid;
    grid-template-columns: 36px 60px 1.6fr 1fr 1fr 0.7fr auto;
    align-items: center;
    gap: 14px;
  }
  .produk-card .num {
    font-weight: 700;
    color: #8A7580;
  }
  .produk-card .foto img {
    width: 52px;
    height: 52px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #ECDFDA;
  }
  .produk-card .nama {
    font-weight: 700;
    color: #2B1E22;
  }
  .produk-card .nama .user-name {
    display: block;
    font-weight: 400;
    font-size: 0.75rem;
    color: #8A7580;
  }
  .produk-card .harga-jual {
    font-weight: 700;
    color: #4A2C38;
  }
  .produk-card .harga-beli {
    color: #8A7580;
    font-size: 0.85rem;
  }

  .stok-badge {
    display: inline-block;
    padding: 5px 14px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: fit-content;
    background: #E7F3EC;
    color: #3E7D5A;
  }
  .stok-habis {
    background: #F6E4E4;
    color: #A24B4B;
  }
  .stok-menipis {
    background: #FBF0DF;
    color: #B8823D;
  }

  .actions {
    display: flex;
    gap: 6px;
  }
  .actions {
    display: flex;
    gap: 6px;
  }
  .actions .btn-info,
  .actions .btn-warning,
  .actions .btn-danger {
    border: none !important;
    border-radius: 50px !important;
    width: 34px;
    height: 34px;
    padding: 0 !important;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    color: #fff !important;
  }
  .actions .btn-info { background: #A97D8C !important; }
  .actions .btn-info:hover { background: #93677A !important; }
  .actions .btn-warning { background: #C98A76 !important; }
  .actions .btn-warning:hover { background: #B87560 !important; }
  .actions .btn-danger { background: #7A4B57 !important; }
  .actions .btn-danger:hover { background: #693F49 !important; }

  .empty-state {
    text-align: center;
    padding: 40px;
    background: #ffffff;
    border-radius: 14px;
    color: #8A7580;
    font-style: italic;
  }

  .pagination .page-link {
    color: #4A2C38;
    border-color: #ECDFDA;
    border-radius: 50px;
    margin: 0 3px;
  }
  .pagination .page-item.active .page-link {
    background-color: #4A2C38;
    border-color: #4A2C38;
  }
  .pagination .page-link:hover {
    background-color: #F3E4DE;
    color: #3A2029;
  }

  .produk-header-row {
    display: grid;
    grid-template-columns: 36px 60px 1.6fr 1fr 1fr 0.7fr auto;
    align-items: center;
    gap: 14px;
    padding: 0 20px;
    margin-bottom: 10px;
  }
  .produk-header-row span {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #8A7580;
  }

  @media (max-width: 900px) {
    .produk-card {
      grid-template-columns: 1fr 1fr;
    }
    .produk-header-row {
      display: none;
    }
  }
</style>

<div class="produk-toolbar">
    <form action="{{ route('produk.index') }}" method="GET">
        <div class="search-box">
            <input
                type="text"
                name="cari"
                value=""
                placeholder="Cari nama produk"
            >
            <button class="btn-search" type="submit">Cari</button>
        </div>
    </form>
    @can('create', App\Models\Produk::class)
    <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah</a>
    @endcan
</div>

@if($products->count() > 0)
<div class="produk-header-row">
    <span>#</span>
    <span>Foto</span>
    <span>Nama Produk</span>
    <span>Harga</span>
    <span>Stok</span>
    <span></span>
    <span>Aksi</span>
</div>
@endif

@forelse ($products as $product)
<div class="produk-card">
    <div class="num">{{ $products->firstItem() + $loop->index }}</div>
    <div class="foto">
        <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}">
    </div>
    <div class="nama">
        {{ $product->nama }}
        <span class="user-name">{{ $product->user->name }}</span>
    </div>
    <div>
        <div class="harga-jual">Rp.{{ number_format($product->harga_jual) }}</div>
        
    </div>
    <div>
        <span class="stok-badge {{ $product->stok == 0 ? 'stok-habis' : ($product->stok <= 5 ? 'stok-menipis' : '') }}">
            {{ $product->stok }} pcs
        </span>
    </div>
    <div></div>
    <div class="actions">
        <a href="{{ route('produk.show',$product->id) }}" class="btn-info" title="Detail">&#128065;</a>
        @can('update', $product)
        <a href="{{ route('produk.edit', $product) }}" class="btn-warning" title="Edit">&#9998;</a>
        @endcan
        @can('delete', $product)
        <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn-danger" title="Hapus" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">&#128465;</button>
        </form>
        @endcan
    </div>
</div>
@empty
<div class="empty-state">Data tidak tersedia.</div>
@endforelse

{{ $products->links() }}

@endsection