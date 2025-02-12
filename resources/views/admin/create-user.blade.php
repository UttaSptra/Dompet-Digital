@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="container">
    <h1>Tambah User Baru</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.storeUser') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
    <label for="role_id" class="form-label">Role</label>
    <select name="role_id" class="form-control" required>
        <option value="1">Admin</option>
        <option value="2">Bank Mini</option>
        <option value="3" selected>Siswa</option>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Tambah User</button>
    </form>
</div>
@endsection
