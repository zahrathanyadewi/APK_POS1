@extends('layouts.app')

@section('title', 'POS')

@section('content')

<style>
  h4 {
    color: #22423A;
    font-weight: 700;
  }

  .card {
    border: 1px solid #D9E7E2;
    border-radius: 14px;
    box-shadow: 0 8px 20px -14px rgba(34, 66, 58, 0.15);
    overflow: hidden;
  }

  .card-footer {
    background: #F0F7F4;
    border-top: 1px solid #D9E7E2;
  }

  .form-control,
  .form-select {
    border: 1.5px solid #D9E7E2;
  }
  .form-control:focus,
  .form-select:focus {
    border-color: #3F7D6E;
    box-shadow: 0 0 0 4px #E4F0EC;
  }

  /* Tombol produk (list kiri) */
  .btn-outline-primary {
    border-color: #BFD9D1 !important;
    color: #22423A !important;
    border-radius: 10px;
  }
  .btn-outline-primary:hover,
  .btn-outline-primary:focus {
    background: #F0F7F4 !important;
    border-color: #3F7D6E !important;
    color: #22423A !important;
  }
  .btn-outline-primary small {
    color: #5C7D74 !important;
  }

  /* Tombol tambah "+" */
  .btn-primary {
    background: #3F7D6E !important;
    border-color: #3F7D6E !important;
    font-weight: 600;
    border-radius: 8px;
  }
  .btn-primary:hover {
    background: #34675A !important;
    border-color: #34675A !important;
  }

  /* Tombol Hapus di keranjang */
  .btn-danger {
    background: #6B7F6C !important;
    border-color: #5A6E5B !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-danger:hover {
    background: #5A6E5B !important;
    border-color: #495D4A !important;
  }

  /* Checkout */
  .btn-success {
    background: #3F7D6E !important;
    border-color: #3F7D6E !important;
    font-weight: 600;
    border-radius: 8px;
    padding: 10px;
  }
  .btn-success:hover {
    background: #34675A !important;
    border-color: #34675A !important;
  }
  .btn-success:disabled {
    background: #A9C2BB !important;
    border-color: #A9C2BB !important;
    cursor: not-allowed;
  }

  /* Batalkan Transaksi */
  .btn-outline-danger {
    color: #B5624E !important;
    border-color: #D9B3A8 !important;
    border-radius: 8px;
  }
  .btn-outline-danger:hover {
    background: #B5624E !important;
    border-color: #B5624E !important;
    color: #ffffff !important;
  }

  .table thead.table-light {
    background: #F0F7F4 !important;
  }
  .table th {
    color: #5C7D74;
    font-weight: 600;
  }
  .table td, .table th {
    border-color: #E4EFEC !important;
    vertical-align: middle;
  }

  .alert-danger {
    background: #F3E6E1 !important;
    border-color: #E0C4B8 !important;
    color: #8C4A3A !important;
    border-radius: 8px;
  }

  /* QRIS */
  #qris-container {
    display: none;
    border: 1.5px dashed #BFD9D1;
    border-radius: 10px;
    padding: 12px;
    margin-bottom: 10px;
    background: #F8FBFA;
  }
  #qris-container img {
    max-width: 220px;
    width: 100%;
  }

  /* Cash / Kembalian */
  #cash-container {
    display: none;
    border: 1.5px dashed #BFD9D1;
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 10px;
    background: #F8FBFA;
  }
  #cash-container label {
    font-size: 0.85rem;
    color: #5C7D74;
    font-weight: 600;
    margin-bottom: 4px;
    display: block;
  }
  #kembalian-text {
    font-weight: 700;
    margin-top: 8px;
  }
  #kembalian-text.kurang {
    color: #B5624E;
  }
  #kembalian-text.cukup {
    color: #22423A;
  }
</style>

{{-- ALERT ERROR --}}
@if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3">Tambah dan Edit</h4>

<div class="row">

    {{-- ================= PRODUK ================= --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari produk..."
                           onkeyup="this.form.submit()">
                </form>

                {{-- LIST PRODUK --}}
                @foreach ($products as $product)
                    <form method="POST"
                          action="{{ route('itempenjualan.store') }}"
                          class="row g-2 mb-2">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button type="submit"
                                    class="btn btn-outline-primary w-100 text-start p-2
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="fw-semibold">{{ $product->nama }}</div>
                                <small class="text-muted">
                                    Rp {{ number_format($product->harga_jual) }}
                                </small>
                            </button>
                        </div>

                        <div class="col-3">
                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   class="form-control">
                        </div>

                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ================= KERANJANG ================= --}}
    <div class="col-md-6">
        <div class="card">

            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th width="80">Jumlah</th>
                        <th>Subtotal</th>
                        <th width="70">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sale->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama }}</td>
                            <td>Rp {{ number_format($item->produk->harga_jual) }}</td>

                            <td>
                                <form method="POST"
                                      action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           min="1"
                                           class="form-control form-control-sm">
                                </form>
                            </td>

                            <td>Rp {{ number_format($item->subtotal) }}</td>

                            <td>
                                @can('delete', $item)
                                    <form method="POST"
                                          action="{{ route('itempenjualan.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Keranjang kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- FOOTER --}}
            <div class="card-footer">
                <h5 class="mb-2">
                    Total: Rp {{ number_format($sale->total_pembayaran) }}
                </h5>

                {{-- CHECKOUT --}}
                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" id="payment_method" class="form-select mb-2" required>
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    {{-- GAMBAR QRIS (muncul kalau QRIS dipilih) --}}
                    <div id="qris-container" class="text-center">
                        <img src="{{ asset('images/qris.png') }}" alt="QRIS">
                        <p class="text-muted small mb-0 mt-1">Scan untuk membayar</p>
                    </div>

                    {{-- UANG DITERIMA & KEMBALIAN (muncul kalau Cash dipilih) --}}
                    <div id="cash-container">
                        <label for="uang_diterima">Uang Diterima</label>
                        <input type="number"
                               id="uang_diterima"
                               class="form-control"
                               placeholder="Masukkan jumlah uang dari pembeli"
                               min="0">
                        <p id="kembalian-text" class="mb-0"></p>
                    </div>

                    <button id="btn-checkout" class="btn btn-success w-100
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Checkout
                    </button>
                </form>

                {{-- BATAL --}}
                @can('delete', $sale)
                    <form method="POST"
                          action="{{ route('penjualan.destroy', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                          class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100">
                            Batalkan Transaksi
                        </button>
                    </form>
                @endcan
            </div>

        </div>
    </div>

</div>

<script>
    const totalPembayaran = {{ (int) $sale->total_pembayaran }};

    const paymentMethod = document.getElementById('payment_method');
    const qrisContainer = document.getElementById('qris-container');
    const cashContainer = document.getElementById('cash-container');
    const uangDiterima = document.getElementById('uang_diterima');
    const kembalianText = document.getElementById('kembalian-text');
    const btnCheckout = document.getElementById('btn-checkout');

    function updateKembalian() {
        const diterima = parseInt(uangDiterima.value) || 0;
        const kembalian = diterima - totalPembayaran;

        if (diterima === 0) {
            kembalianText.textContent = '';
            kembalianText.className = 'mb-0';
            btnCheckout.disabled = false;
            return;
        }

        if (kembalian < 0) {
            kembalianText.textContent = 'Uang belum cukup, kurang Rp ' + Math.abs(kembalian).toLocaleString('id-ID');
            kembalianText.className = 'mb-0 kurang';
            btnCheckout.disabled = true;
        } else {
            kembalianText.textContent = 'Kembalian: Rp ' + kembalian.toLocaleString('id-ID');
            kembalianText.className = 'mb-0 cukup';
            btnCheckout.disabled = false;
        }
    }

    paymentMethod.addEventListener('change', function () {
        qrisContainer.style.display = (this.value === 'QRIS') ? 'block' : 'none';
        cashContainer.style.display = (this.value === 'CASH') ? 'block' : 'none';

        if (this.value === 'CASH') {
            uangDiterima.value = '';
            updateKembalian();
        } else {
            btnCheckout.disabled = false;
        }
    });

    uangDiterima.addEventListener('input', updateKembalian);
</script>
@endsection