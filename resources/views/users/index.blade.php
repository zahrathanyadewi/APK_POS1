@extends('layouts.app')

@section('title', 'Pengguna')

@section('content')

@include('layouts.navbar')

<style>
  h1 {
    font-family: 'Fraunces', serif;
    color: #2B1E22;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .btn-primary {
    background: #4A2C38 !important;
    border-color: #4A2C38 !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-primary:hover {
    background: #3A2029 !important;
    border-color: #3A2029 !important;
  }

  .form-control {
    border: 1.5px solid #ECDFDA;
  }
  .form-control:focus {
    border-color: #C98A76;
    box-shadow: 0 0 0 4px rgba(201, 138, 118, 0.18);
  }

  .btn-secondary {
    background: #8A7580 !important;
    border-color: #8A7580 !important;
  }
  .btn-secondary:hover {
    background: #6F5D66 !important;
    border-color: #6F5D66 !important;
  }

  .btn-warning {
    background: #C98A76 !important;
    border: 1px solid #B87560 !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-warning:hover {
    background: #B87560 !important;
    border-color: #A5644F !important;
    color: #ffffff !important;
  }

  .btn-danger {
    background: #7A4B57 !important;
    border: 1px solid #693F49 !important;
    color: #ffffff !important;
    font-weight: 500;
    border-radius: 8px;
  }
  .btn-danger:hover {
    background: #693F49 !important;
    border-color: #58333B !important;
  }

  .table {
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
  }
  .table thead th {
    background: #F8EFEA;
    color: #8A7580;
    font-weight: 600;
    border-bottom: 2px solid #ECDFDA;
  }
  .table td, .table th {
    border-color: #F1E5E0 !important;
    vertical-align: middle;
  }
  .table tbody tr:hover {
    background: #FBF4F1;
  }
</style>

<h1>Halaman Pengguna</h1>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3 d-flex gap-2">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        class="form-control"
        placeholder="Cari username atau email"
    >
    <button class="btn btn-secondary" type="submit">Cari</button>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah</a>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Peran</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
        <td>{{ $users->firstItem() + $loop->index }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        <td>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                Edit Akun
            </a>
            ||
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection