@extends('layouts.app')

@section('content')

<style>
  .card {
    border: 1px solid #D9E7E2;
    border-radius: 14px;
    box-shadow: 0 8px 20px -14px rgba(34, 66, 58, 0.15) !important;
    overflow: hidden;
  }

  .card-header.bg-primary {
    background: #3F7D6E !important;
    color: #ffffff !important;
    font-weight: 600;
    border-bottom: none;
  }

  .table {
    background: #ffffff;
  }
  .table th {
    background: #F0F7F4;
    color: #5C7D74;
    font-weight: 600;
    width: 30%;
  }
  .table td, .table th {
    border-color: #E4EFEC !important;
    vertical-align: middle;
  }

  .btn-secondary {
    background: #5C7D74 !important;
    border-color: #5C7D74 !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-secondary:hover {
    background: #4A6960 !important;
    border-color: #4A6960 !important;
  }
</style>

<div class="container">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            Detail Produk
        </div>

        <div class="card-body">

            @if($produk->foto)
                <img src="{{ asset('storage/'.$produk->foto) }}"
                     class="img-fluid mb-3"
                     width="200">
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $produk->nama }}</td>
                </tr>

                <tr>
                    <th>Harga Beli</th>
                    <td>Rp {{ number_format($produk->harga_beli) }}</td>
                </tr>

                <tr>
                    <th>Harga Jual</th>
                    <td>Rp {{ number_format($produk->harga_jual) }}</td>
                </tr>

                <tr>
                    <th>Stok</th>
                    <td>{{ $produk->stok }}</td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>{{ $produk->created_at->format('d-m-Y') }}</td>
                </tr>
            </table>

            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </div>
    </div>

</div>
@endsection