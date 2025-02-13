@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Edit Pengguna</h1>

    <div class="card shadow-sm p-4 mt-4">
        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
    <input type="password" class="form-control" name="password" placeholder="Biarkan kosong jika tidak diubah">
</div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-control" name="role_id">
                    <option value="1" {{ $user->role_id === 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $user->role_id === 2 ? 'selected' : '' }}>Bank Mini</option>
                    <option value="3" {{ $user->role_id === 3 ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
