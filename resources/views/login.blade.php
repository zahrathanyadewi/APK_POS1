@extends('layouts.app')

@section('title', 'Ini Halaman Ujicoba')

@section('content')

<style>
  body {
    background: linear-gradient(160deg, #EAF3EF 0%, #DCEAE6 100%);
    min-height: 100vh;
  }

  .login-card {
    width: 20rem;
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 40px -18px rgba(34, 66, 58, 0.25);
  }

  .login-card .card-header {
    background: #3F7D6E;
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.02em;
    border-bottom: none;
    padding: 14px;
  }

  .login-card .card-body {
    background: #ffffff;
    padding: 28px 26px;
  }

  .login-card .form-label {
    color: #5C7D74;
    font-weight: 500;
    font-size: 0.85rem;
    text-align: left;
    display: block;
  }

  .login-card .form-control {
    background: #F7FAF9;
    border: 1.5px solid #D9E7E2;
    border-radius: 10px;
    padding: 10px 12px;
  }

  .login-card .form-control:focus {
    border-color: #3F7D6E;
    background: #fff;
    box-shadow: 0 0 0 4px #E4F0EC;
  }

  .login-card .btn-primary {
    background: #3F7D6E;
    border: none;
    border-radius: 10px;
    padding: 10px 24px;
    font-weight: 600;
    width: 100%;
    transition: background 0.15s ease;
  }

  .login-card .btn-primary:hover {
    background: #34675A;
  }

  .login-card .badge.text-bg-danger {
    background-color: #C0654F !important;
    font-weight: 400;
    margin-top: 6px;
  }
</style>

<div class="card text-center login-card position-absolute top-50 start-50 translate-middle">
  <h5 class="card-header">Login POS</h5>
  <div class="card-body">
    <form action="{{ route('auth') }}" method="POST">
        @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control"
     id="exampleInputEmail1" aria-describedby="emailHelp">
     @error('email')
        <div class="badge text-bg-danger">{{ $message }}</div>
     @enderror
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password"  name="password" class="form-control" 
    id="exampleInputPassword1">
    @error('password')
        <div class="badge text-bg-danger">{{ $message }}</div>
     @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>

@endsection