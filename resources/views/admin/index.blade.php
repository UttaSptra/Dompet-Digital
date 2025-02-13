@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Dashboard Admin</h1>

    <div class="card shadow-sm p-4 mt-4">
        <h4 class="text-center">Daftar Pengguna</h4>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role_id === 1)
                                <span class="badge bg-primary">Admin</span>
                            @elseif($user->role_id === 2)
                                <span class="badge bg-warning">Bank Mini</span>
                            @else
                                <span class="badge bg-success">Siswa</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
