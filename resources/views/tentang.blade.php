@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

@include('layouts.navbar')

<style>
  .tentang-hero {
    padding: 2.6rem 0 1.8rem;
    text-align: left;
  }

  .tentang-hero .brand-mark {
    font-family: 'Italiana', serif;
    color: #4A2C38;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    margin-bottom: 6px;
  }

  .tentang-hero h1 {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.9rem;
    color: #2B1E22;
    margin: 0;
  }

  .tentang-section {
    background: #ffffff;
    border: 1px solid #ECDFDA;
    border-radius: 10px;
    padding: 24px 26px;
    margin-bottom: 1.6rem;
    max-width: 720px;
  }

  .tentang-section .rule {
    width: 28px;
    height: 2px;
    background: #C98A76;
    margin-bottom: 10px;
    display: block;
  }

  .tentang-section h2 {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.15rem;
    color: #2B1E22;
    margin: 0 0 12px;
  }

  .tentang-section p {
    color: #5C4A52;
    line-height: 1.7;
    font-size: 0.98rem;
    margin: 0;
  }

  .misi-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .misi-list li {
    display: flex;
    gap: 12px;
    padding: 12px;
    margin-bottom: 8px;
    border: 1px solid #ECDFDA;
    border-radius: 8px;
    color: #5C4A52;
    font-size: 0.98rem;
    line-height: 1.6;
  }

  .misi-list li:last-child {
    margin-bottom: 0;
  }

  .misi-list li .num {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    color: #C98A76;
    flex-shrink: 0;
  }

  .kontak-table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ECDFDA;
  }

  .kontak-table td {
    padding: 14px 16px;
    font-size: 0.98rem;
    color: #5C4A52;
    vertical-align: top;
    border: 1px solid #ECDFDA;
  }

  .kontak-table td.label {
    width: 160px;
    font-family: 'Fraunces', serif;
    font-weight: 600;
    color: #2B1E22;
    background: #FBF3EF;
  }
</style>

<div class="tentang-hero">
  <div class="brand-mark">Aveline</div>
  <h1>Tentang Kami</h1>
</div>

<div class="tentang-section">
  <span class="rule"></span>
  <h2>Tentang Kami</h2>
  <p>
    Aveline hadir sebagai teman setia dalam perjalanan kecantikan Anda. Kami percaya
    bahwa kecantikan sejati dimulai dari rasa percaya diri, dan setiap produk yang kami
    hadirkan dirancang untuk membantu Anda tampil maksimal setiap hari. Dengan
    memadukan kualitas, keamanan, dan harga yang bersahabat, Aveline berkomitmen
    menjadi pilihan kosmetik yang bisa diandalkan oleh siapa saja, kapan saja.
  </p>
</div>

<div class="tentang-section">
  <span class="rule"></span>
  <h2>Visi</h2>
  <p>
    Menjadi brand kosmetik lokal yang dipercaya dan dicintai, dengan menghadirkan
    produk kecantikan berkualitas tinggi, aman digunakan, dan terjangkau bagi
    semua kalangan.
  </p>
</div>

<div class="tentang-section">
  <span class="rule"></span>
  <h2>Misi</h2>
  <ul class="misi-list">
    <li><span class="num">01</span> Menyediakan produk kosmetik berkualitas dengan bahan yang aman dan telah teruji.</li>
    <li><span class="num">02</span> Memberikan pelayanan terbaik dan pengalaman berbelanja yang nyaman bagi setiap pelanggan.</li>
    <li><span class="num">03</span> Menghadirkan produk dengan harga yang terjangkau tanpa mengurangi kualitas.</li>
    <li><span class="num">04</span> Terus berinovasi mengikuti tren kecantikan sambil menjaga keaslian identitas brand Aveline.</li>
  </ul>
</div>

<div class="tentang-section">
  <span class="rule"></span>
  <h2>Hubungi Kami</h2>
  <table class="kontak-table">
    <tr>
      <td class="label">Alamat</td>
      <td>Jl. drs.moch hatta No.26</td>
    </tr>
    <tr>
      <td class="label">No. HP / WhatsApp</td>
      <td>0812-3456-7890</td>
    </tr>
  </table>
</div>

@endsection