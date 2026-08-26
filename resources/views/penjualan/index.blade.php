@extends('layouts.app')

@section('title', 'penjualan')

@section('content')

@include('layouts.navbar')

@if(session('errors'))
       <div class="alert alert-danger">
           {{ session('errors') }}
       </div>
       @endif

<h1>Halaman Penjualan</h1>
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

  /* Tombol Detail (biru) */
  .btn-info,
  .table .btn-primary {
    background: #6E9BA3 !important;
    border: 1px solid #5E8890 !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-info:hover,
  .table .btn-primary:hover {
    background: #5E8890 !important;
    border-color: #4E767D !important;
  }

  /* Tombol Edit - sage hijau redup */
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

  /* Tombol Hapus - hijau zaitun gelap */
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

  .pagination .page-link {
    color: #3F7D6E;
    border-color: #D9E7E2;
  }
  .pagination .page-item.active .page-link {
    background-color: #3F7D6E;
    border-color: #3F7D6E;
  }
</style>

<a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Create</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
           type="text"
           name="search"
           value="{{ request()->search }}"
           class="form-control"
           placeholder="Search penjualan"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
</button>
</div>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sales as $sale)
        <tr>
            <th scope="row">{{$sales->firstItem() + $loop->index}}</th>
            <td>{{$sale->created_at->translatedFormat('d-m-Y H:i:s')}}</td>
            <td>{{$sale->user->name}}</td>
            <td>Rp.{{number_format($sale->total_pembayaran)}}</td>
            <td>{{$sale->metode_pembayaran}}</td>
            <td>{{$sale->status}}</td>
            <td class="d-flex gap-1">
                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-primary">Detail</a>
                @can('view', $sale)
                ||
                <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-warning">Edit</a>
                @endcan
                @can('delete', $sale)
                ||
                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button
                     class="btn btn-danger"
                     onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                      Hapus
                     </button>
                   </form>
             @endcan
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Data Tidak Ditemukan</td>
</tr>
@endforelse
    </tbody>
</table>
{{$sales->links()}}
@endsection