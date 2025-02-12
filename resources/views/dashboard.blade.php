@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
@if(auth()->user()->role_id === 3)
<div class="container">
    <h1>Halo, {{ auth()->user()->name }}!</h1>

    <div class="card mb-4">
        <div class="card-body text-center">
            <h4>Saldo Anda</h4>
            <h2>Rp {{ number_format(optional(auth()->user()->wallet)->balance ?? 0, 0, ',', '.') }}</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <a href="#topupModal" class="btn btn-success w-100" data-bs-toggle="modal">Top Up</a>
        </div>
       
        <div class="col-md-4">
            <a href="#withdrawModal" class="btn btn-warning w-100" data-bs-toggle="modal">Tarik Tunai</a>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('student.history') }}" class="btn btn-info">Riwayat Transfer</a>
        </div>
    </div>

    <!-- Tombol Logout -->
    
</div>

@include('student.topup')

@elseif(auth()->user()->role_id === 2)
    {{-- Tampilan untuk Bank Mini --}}
    @include('bank.bank', ['topups' => $topups ?? collect()])

@elseif(auth()->user()->role_id === 1)
    {{-- Tampilan untuk Admin --}}
    @include('admin.index', ['students' => $students ?? collect()])

@else
    {{-- Jika role tidak dikenali --}}
    <p class="text-center text-danger">Anda tidak memiliki akses ke halaman ini.</p>
@endif
<div class="mt-4 text-center">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
@endsection
