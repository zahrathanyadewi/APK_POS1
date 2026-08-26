@extends('layouts.app')

@section('title', 'Login')

@section('content')

@include('layouts.navbar')

<style>
  body {
    background: linear-gradient(160deg, #EAF3EF 0%, #DCEAE6 100%);
    font-family: 'Inter', sans-serif;
    color: #22423A;
  }

  h1 {
    font-weight: 700;
    color: #22423A;
    margin-top: 2.2rem;
    margin-bottom: 1.2rem;
  }

  h1 small.text-muted {
    font-size: 1.1rem;
    color: #7C978E !important;
  }

  h3 {
    font-weight: 600;
    color: #22423A;
    margin-bottom: 1rem;
  }

  .card {
    border: 1px solid #D9E7E2;
    border-radius: 14px;
    box-shadow: 0 8px 20px -14px rgba(34, 66, 58, 0.15);
    margin-bottom: 1.5rem;
    overflow: hidden;
  }

  .card-header {
    background: #F0F7F4;
    color: #5C7D74;
    font-weight: 500;
    border-bottom: 1px solid #D9E7E2;
  }

  .card-body {
    background: #ffffff;
  }

  .card-title {
    color: #3F7D6E;
    font-weight: 700;
    font-size: 1.5rem;
    margin: 0;
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

  .text-muted {
    color: #7C978E !important;
  }

  a {
    color: #3F7D6E;
  }
  a:hover {
    color: #34675A;
  }

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

<div class="text-center">
  <h1>
    Ringkasan Hari Ini
    <small class="text-muted">
      ({{ $tanggalHariIni->translatedFormat('l, d F Y') }})
    </small>
    </h1>
    <div class="row">
      @can('viewAny', App\Models\User::class)
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>
        <div class="col-md-6">           
            <div class="card">
             <div class="card-header">
               Total Nilai Penjualan Hari ini
             </div>
             <div class="card-body">
    <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
  </div>
</div>
        </div>
        <div class="col-md-6">
           <div class="card">
             <div class="card-header">
               Jumlah Transaksi Hari ini
             </div>
             <div class="card-body">
               <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
          </div>
        </div>
    </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>
        <div class="col-md-6">
            <div class="card">
             <div class="card-header">
               Total pembayaran tunai
             </div>
             <div class="card-body">
               <h5 class="card-title">Rp {{ number_format( $ringkasan['total_cash']) }}</h5>
          </div>
        </div>
        </div>
        <div class="col-md-6">
            <div class="card">
             <div class="card-header">
               Total pembayaran non-tunai
             </div>
             <div class="card-body">
               <h5 class="card-title">Rp{{number_format($ringkasan['total_non_tunai']) }}</h5>
          </div>
        </div>
    </div>
   @endcan
    <div class="row">
        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Daftar produk stok rendah</h3>
            <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produkStokRendah as $index => $produk)
            <tr>
                <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->stok }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-muted text-center">
                    Seluruh produk berada dalam kondisi stok aman.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $produkStokRendah->links() }}

        </div>
        <div class="col-md-6">
            <h3>Produk habis stok</h3>
             <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Stok</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produkStokHabis as $index => $produk)
            <tr>
                <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->stok }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-muted text-center">
                    Seluruh produk berada dalam kondisi stok aman.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $produkStokHabis->links() }}
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <h1>Best Seller Products</h1>
</div>
      <div class="col-md-12">
        <table class="table">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Stok</th>
            <th scope="col">Unit Terjual</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($produkTerlaris as $index => $produk)
            <tr>
                
                <td>{{ $produk->nama }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ $produk->total_terjual }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-muted text-center">
                    Seluruh produk berada dalam kondisi stok aman.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>
          </div>
</div>

@endsection