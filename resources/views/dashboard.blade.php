@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">Selamat Datang, {{ auth()->user()->name }}!</h1>

    @if(auth()->user()->role_id === 3)
        {{-- Dashboard untuk Siswa --}}
        <div class="card shadow-sm p-4 mt-4">
            <h4 class="text-center">Saldo Anda</h4>
            <h2 class="text-center text-success">Rp {{ number_format(optional(auth()->user()->wallet)->balance ?? 0, 0, ',', '.') }}</h2>
        </div>
        
         {{-- Informasi Akun --}}
    <div class="card shadow-sm p-4 mt-4">
        <h4 class="text-center">Informasi Akun</h4>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nama:</strong> {{ auth()->user()->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ auth()->user()->email }}</li>
            <li class="list-group-item"><strong>Tanggal Bergabung:</strong> {{ auth()->user()->created_at->format('d M Y') }}</li>
        </ul>
    </div>

    

    @elseif(auth()->user()->role_id === 2)
        {{-- Dashboard untuk Bank Mini --}}
        <div class="card shadow-sm p-4 mt-4">
            <h4 class="text-center">Verifikasi Top Up</h4>
            <p class="text-center">Lihat dan kelola pengajuan top up dari siswa.</p>
            <a href="{{ route('bank.topups') }}" class="btn btn-warning w-100">Kelola Top Up</a>
        </div>

    @elseif(auth()->user()->role_id === 1)
        {{-- Dashboard untuk Admin --}}
        <div class="card shadow-sm p-4 mt-4">
            <h4 class="text-center">Manajemen Akun</h4>
            <p class="text-center">Buat akun baru dan kelola pengguna.</p>
            <a href="{{ route('admin.createUser') }}" class="btn btn-danger w-100">Tambah Pengguna</a>
        </div>

    @else
        <p class="text-center text-danger">Anda tidak memiliki akses ke halaman ini.</p>
    @endif
</div>
@endsection
