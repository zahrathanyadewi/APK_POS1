@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<style>
  .dash-header {
    padding: 2.2rem 0 1.4rem;
    border-bottom: 1px solid #ECDFDA;
    margin-bottom: 2rem;
    text-align: left;
  }

  .dash-header h1 {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.9rem;
    color: #2B1E22;
    margin: 0 0 4px;
  }

  .dash-header .dash-date {
    color: #8A7580;
    font-size: 0.95rem;
  }

  .dash-section-title {
    display: flex;
    align-items: baseline;
    gap: 10px;
    margin: 2.4rem 0 1rem;
  }

  .dash-section-title .rule {
    width: 28px;
    height: 2px;
    background: #C98A76;
  }

  .dash-section-title h2 {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.15rem;
    color: #2B1E22;
    margin: 0;
  }

  .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 16px;
  }

  .stat-tile {
    background: #ffffff;
    border: 1px solid #ECDFDA;
    border-left: 3px solid var(--accent, #C98A76);
    padding: 20px 22px;
  }

  .stat-tile .stat-label {
    font-size: 0.82rem;
    color: #8A7580;
    margin-bottom: 8px;
  }

  .stat-tile .stat-value {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.7rem;
    color: #2B1E22;
  }

  .panel-list {
    border-top: 1px solid #ECDFDA;
  }

  .panel-list-row {
    display: grid;
    grid-template-columns: 40px 1fr 90px;
    align-items: center;
    padding: 12px 4px;
    border-bottom: 1px solid #F1E5E0;
    font-size: 0.95rem;
  }

  .panel-list-row.head {
    color: #8A7580;
    font-weight: 600;
    font-size: 0.82rem;
    border-bottom: 2px solid #ECDFDA;
  }

  .panel-list-row .empty {
    grid-column: 1 / -1;
    color: #B8A5AB;
    text-align: center;
    padding: 18px 0;
  }

  .panel-list-row.best-seller {
    grid-template-columns: 1fr 90px 110px;
  }

  .pagination .page-link {
    color: #4A2C38;
    border-color: #ECDFDA;
  }
  .pagination .page-item.active .page-link {
    background-color: #4A2C38;
    border-color: #4A2C38;
  }
  .pagination .page-link:hover {
    background-color: #F3E4DE;
    color: #3A2029;
  }

  @media (max-width: 640px) {
    .panel-list-row,
    .panel-list-row.best-seller {
      grid-template-columns: 1fr;
      row-gap: 2px;
    }
  }
</style>

<div class="dash-header">
  <h1>Ringkasan Hari Ini</h1>
  <span class="dash-date">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
</div>

@can('viewAny', App\Models\User::class)
  <div class="dash-section-title">
    <span class="rule"></span>
    <h2>Penjualan Hari Ini</h2>
  </div>
  <div class="stat-grid">
    <div class="stat-tile" style="--accent:#C98A76">
      <div class="stat-label">Total Nilai Penjualan Hari ini</div>
      <div class="stat-value">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
    </div>
    <div class="stat-tile" style="--accent:#4A2C38">
      <div class="stat-label">Jumlah Transaksi Hari ini</div>
      <div class="stat-value">{{ $ringkasan['total_transaksi'] }}</div>
    </div>
  </div>

  <div class="dash-section-title">
    <span class="rule"></span>
    <h2>Status Kas & Pembayaran</h2>
  </div>
  <div class="stat-grid">
    <div class="stat-tile" style="--accent:#A97D8C">
      <div class="stat-label">Total pembayaran tunai</div>
      <div class="stat-value">Rp {{ number_format($ringkasan['total_cash']) }}</div>
    </div>
    <div class="stat-tile" style="--accent:#8A7580">
      <div class="stat-label">Total pembayaran non-tunai</div>
      <div class="stat-value">Rp{{ number_format($ringkasan['total_non_tunai']) }}</div>
    </div>
  </div>
@endcan

<div class="dash-section-title">
  <span class="rule"></span>
  <h2>Status Stok Kritis</h2>
</div>
<div class="row">
  <div class="col-md-6">
    <h3 style="font-family:'Fraunces',serif;font-weight:600;color:#2B1E22;font-size:1rem;margin-bottom:.6rem;">Daftar produk stok rendah</h3>
    <div class="panel-list">
      <div class="panel-list-row head">
        <span>#</span><span>Nama</span><span>Stok</span>
      </div>
      @forelse ($produkStokRendah as $index => $produk)
        <div class="panel-list-row">
          <span>{{ $produkStokRendah->firstItem() + $index }}</span>
          <span>{{ $produk->nama }}</span>
          <span>{{ $produk->stok }}</span>
        </div>
      @empty
        <div class="panel-list-row">
          <span class="empty">Seluruh produk berada dalam kondisi stok aman.</span>
        </div>
      @endforelse
    </div>
    {{ $produkStokRendah->links() }}
  </div>

  <div class="col-md-6">
    <h3 style="font-family:'Fraunces',serif;font-weight:600;color:#2B1E22;font-size:1rem;margin-bottom:.6rem;">Produk habis stok</h3>
    <div class="panel-list">
      <div class="panel-list-row head">
        <span>#</span><span>Nama</span><span>Stok</span>
      </div>
      @forelse ($produkStokHabis as $index => $produk)
        <div class="panel-list-row">
          <span>{{ $produkStokHabis->firstItem() + $index }}</span>
          <span>{{ $produk->nama }}</span>
          <span>{{ $produk->stok }}</span>
        </div>
      @empty
        <div class="panel-list-row">
          <span class="empty">Seluruh produk berada dalam kondisi stok aman.</span>
        </div>
      @endforelse
    </div>
    {{ $produkStokHabis->links() }}
  </div>
</div>

<div class="dash-section-title">
  <span class="rule"></span>
  <h2>Produk Terlaris</h2>
</div>
<div class="panel-list">
  <div class="panel-list-row best-seller head">
    <span>Nama</span><span>Stok</span><span>Unit Terjual</span>
  </div>
  @forelse ($produkTerlaris as $index => $produk)
    <div class="panel-list-row best-seller">
      <span>{{ $produk->nama }}</span>
      <span>{{ $produk->stok }}</span>
      <span>{{ $produk->total_terjual }}</span>
    </div>
  @empty
    <div class="panel-list-row best-seller">
      <span class="empty">Seluruh produk berada dalam kondisi stok aman.</span>
    </div>
  @endforelse
</div>

@endsection