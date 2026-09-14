@extends('layouts.app')

@section('title', 'penjualan')

@section('content')

@include('layouts.navbar')

@if(session('errors'))
       <div class="alert alert-danger">
           {{ session('errors') }}
       </div>
       @endif

<style>
  .penjualan-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 1.5rem;
  }

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
    border: 1.5px solid #ECDFDA;
    max-width: 420px;
    margin-bottom: 1.5rem;
  }
  .search-box input {
    border: none;
    outline: none;
    flex: 1;
    background: transparent;
    padding: 8px 0;
  }
  .search-box button {
    background: #8A7580 !important;
    border: none !important;
    border-radius: 50px !important;
    padding: 8px 20px !important;
    font-weight: 500;
  }
  .search-box button:hover {
    background: #6F5D66 !important;
  }

  /* Layout kartu, bukan tabel biasa */
  .sale-card {
    background: #ffffff;
    border: 1px solid #ECDFDA;
    border-left: 5px solid #A97D8C;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 12px;
    display: grid;
    grid-template-columns: 40px 1.4fr 1fr 1fr 1fr 1fr auto;
    align-items: center;
    gap: 10px;
  }
  .sale-card .label {
    display: none;
  }
  .sale-card .num {
    font-weight: 700;
    color: #8A7580;
  }
  .sale-card .total {
    font-weight: 700;
    color: #2B1E22;
  }

  .status-badge {
    display: inline-block;
    padding: 5px 14px;
    border-radius: 50px;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: fit-content;
  }
  .status-lunas, .status-selesai, .status-success {
    background: #E7F3EC;
    color: #3E7D5A;
  }
  .status-pending, .status-proses {
    background: #FBF0DF;
    color: #B8823D;
  }
  .status-batal, .status-gagal {
    background: #F6E4E4;
    color: #A24B4B;
  }
  .status-default {
    background: #F1E5E0;
    color: #4A2C38;
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

  @media (max-width: 900px) {
    .sale-card {
      grid-template-columns: 1fr 1fr;
    }
    .sale-card .label {
      display: block;
      font-size: 0.7rem;
      color: #8A7580;
      text-transform: uppercase;
    }
  }
</style>

<div class="penjualan-header">
    <h1>Halaman Penjualan</h1>
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary">Tambah</a>
</div>

<form action="{{ route('penjualan.index') }}" method="GET">
    <div class="search-box">
        <input
           type="text"
           name="search"
           value="{{ request()->search }}"
           placeholder="Cari penjualan"
        >
        <button type="submit">Cari</button>
    </div>
</form>

@forelse($sales as $sale)
<div class="sale-card">
    <div class="num">{{$sales->firstItem() + $loop->index}}</div>
    <div>
        <span class="label">Tanggal Transaksi</span>
        {{$sale->created_at->translatedFormat('d-m-Y H:i:s')}}
    </div>
    <div>
        <span class="label">Kasir</span>
        {{$sale->user->name}}
    </div>
    <div class="total">
        <span class="label">Total Pembayaran</span>
        Rp.{{number_format($sale->total_pembayaran)}}
    </div>
    <div>
        <span class="label">Metode Pembayaran</span>
        {{$sale->metode_pembayaran}}
    </div>
    <div>
        <span class="label">Status</span>
        <span class="status-badge status-{{ strtolower($sale->status) }}">{{$sale->status}}</span>
    </div>
    <div class="actions">
        <a href="{{ route('penjualan.show', $sale) }}" class="btn-info" title="Detail">
            &#128065;
        </a>
        @can('view', $sale)
        <a href="{{ route('penjualan.edit', $sale) }}" class="btn-warning" title="Edit">
            &#9998;
        </a>
        @endcan
        @can('delete', $sale)
        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button
             class="btn-danger"
             title="Hapus"
             onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
              &#128465;
             </button>
           </form>
        @endcan
    </div>
</div>
@empty
<div class="empty-state">Data Tidak Ditemukan</div>
@endforelse

{{$sales->links()}}
@endsection