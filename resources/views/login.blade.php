@extends('layouts.app')

@section('title', 'Login Aveline')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Italiana&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
  body {
    background: linear-gradient(180deg, #F3E4DE 0%, #F8F0EC 100%);
    min-height: 100vh;
    font-family: 'Inter', sans-serif;
  }

  .login-card {
    width: 22rem;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 24px 60px -24px rgba(74, 44, 56, 0.25);
    background: #FFFDFB;
  }

  .login-card .card-header {
    background: none;
    border-bottom: none;
    padding: 40px 26px 8px;
    text-align: center;
  }

  .brand-mark {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 10px;
  }

  .brand-mark .dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #C98A76;
  }

  .brand-mark span {
    font-family: 'Italiana', serif;
    font-weight: 700;
    font-size: 26px;
    color: #4A2C38;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  .login-card h1.card-title {
    font-family: 'Fraunces', serif;
    font-weight: 500;
    font-size: 20px;
    color: #2B1E22;
    margin: 0 0 2px;
  }

  .login-card .subtitle {
    color: #8A7580;
    font-size: 13.5px;
    margin: 0;
  }

  .login-card .card-body {
    background: #FFFDFB;
    padding: 20px 30px 32px;
  }

  .login-card .form-label {
    color: #4A2C38;
    font-weight: 500;
    font-size: 0.85rem;
    text-align: left;
    display: block;
  }

  .login-card .form-control {
    background: #FFFDFB;
    border: 1.5px solid #ECDFDA;
    border-radius: 10px;
    padding: 10px 12px;
  }

  .login-card .form-control:focus {
    border-color: #C98A76;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(201, 138, 118, 0.18);
  }

  .login-card .btn-primary {
    background: #4A2C38;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    font-weight: 600;
    width: 100%;
    transition: background 0.15s ease;
  }

  .login-card .btn-primary:hover {
    background: #3A2029;
  }

  .login-card .badge.text-bg-danger {
    background-color: #C0654F !important;
    font-weight: 400;
    margin-top: 6px;
  }
</style>

<div class="card text-center login-card position-absolute top-50 start-50 translate-middle">
  <div class="card-header">
    <div class="brand-mark">
      <span class="dot"></span>
      <span>Aveline</span>
    </div>
    <h1 class="card-title">Masuk ke akun</h1>
    <p>Selamat Datang Di Toko Kosmetik AVELINE</p>

  </div>
  <div class="card-body">
    <form action="{{ route('auth') }}" method="POST">
        @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
    <input type="email" name="email" class="form-control"
     id="exampleInputEmail1" aria-describedby="emailHelp">
     @error('email')
        <div class="badge text-bg-danger">{{ $message }}</div>
     @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Kata Sandi</label>
    <input type="password"  name="password" class="form-control" 
    id="exampleInputPassword1">
    @error('password')
        <div class="badge text-bg-danger">{{ $message }}</div>
     @enderror
  </div>
  <button type="submit" class="btn btn-primary">Masuk</button>
</form>
  </div>
</div>

@endsection