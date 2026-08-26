@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

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
</style>

<h1>Halaman Users</h1>
<a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>

<form action="{{ route('admin.users') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search username or email"
        >
        <button class="btn btn-secondary" type="submit">Search</button>
    </div>
</form>
    
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
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