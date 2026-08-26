@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>
<style>
  h1 {
    color: #22423A;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .btn-primary {
    background: #3F7D6E !important;
    border-color: #3F7D6E !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-primary:hover {
    background: #34675A !important;
    border-color: #34675A !important;
  }

  .form-control {
    border: 1.5px solid #D9E7E2;
  }
  .form-control:focus {
    border-color: #3F7D6E;
    box-shadow: 0 0 0 4px #E4F0EC;
  }

  .btn-secondary {
    background: #5C7D74 !important;
    border-color: #5C7D74 !important;
  }
  .btn-secondary:hover {
    background: #4A6960 !important;
    border-color: #4A6960 !important;
  }

  /* Tombol Detail */
  .btn-info {
    background: #6E9BA3 !important;
    border: 1px solid #5E8890 !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-info:hover {
    background: #5E8890 !important;
    border-color: #4E767D !important;
    color: #ffffff !important;
  }

  /* Tombol Edit - sage hijau redup, senada dengan halaman Users */
  .btn-warning {
    background: #8A9A7E !important;
    border: 1px solid #798A6D !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-warning:hover {
    background: #798A6D !important;
    border-color: #67785C !important;
    color: #ffffff !important;
  }

  /* Tombol Hapus - hijau zaitun gelap, senada dengan halaman Users */
  .btn-danger {
    background: #6B7F6C !important;
    border: 1px solid #5A6E5B !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-danger:hover {
    background: #5A6E5B !important;
    border-color: #495D4A !important;
  }

  .table {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
  }
  .table thead th {
    background: #F0F7F4;
    color: #5C7D74;
    font-weight: 600;
    border-bottom: 2px solid #D9E7E2;
  }
  .table td, .table th {
    border-color: #E4EFEC !important;
    vertical-align: middle;
  }
  .table tbody tr:hover {
    background: #F7FAF9;
  }

  /* Pagination */
  .pagination .page-link {
    color: #3F7D6E;
    border-color: #D9E7E2;
  }
  .pagination .page-item.active .page-link {
    background-color: #3F7D6E;
    border-color: #3F7D6E;
  }
  .pagination .page-link:hover {
    background-color: #E4F0EC;
    color: #34675A;
  }
</style>

@can('create', App\Models\Produk::class)
<a href="{{ route('produk.create') }}" method="GET" class="btn btn-primary mb-3">Create</a>
@endcan

<form action="{{ route('produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value=""
            class="form-control"
            placeholder="Search nama produk"
        >
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User</th>
      <th scope="col">Foto</th>
      <th scope="col">Nama</th>
      <th scope="col">Harga Beli</th>
        <th scope="col">Harga Jual</th>
        <th scope="col">Stok</th>
        <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
      <td>{{ $product->user->name }}</td>
      <td>
        <img src="{{ asset('storage/' . $product->foto) }}" 
                 width="100"
                 class="img-thumbnail">
      </td>
      <td>{{ $product->nama }}</td>
        <td>{{ $product->harga_beli }}</td>
        <td>{{ $product->harga_jual }}</td>
        <td>{{ $product->stok }}</td>
        <td class="d-flex gap-1">
          <a href="{{ route('produk.show',$product->id) }}" class="btn btn-info btn-sm">Detail</a>
          @can('update', $product)
            <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning">Edit</a>
          @endcan
            ||
          @can('delete', $product)
            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">Hapus</button>
            </form>
          @endcan
        </td>
    </tr>
    @empty
    <tr>
        <td colspan=8><h1>Data tidak tersedia.</h1></td>
    </tr>
    @endforelse
  </tbody>
</table>
{{ $products->links() }}

@endsection