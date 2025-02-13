@extends('layouts.app')

@section('title', 'Daftar Pengajuan Top-up')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pengajuan Top-up</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="card shadow-sm p-4">
        @if($topups->isEmpty())
            <p class="text-center text-muted">Tidak ada pengajuan top-up saat ini.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topups as $topup)
                            <tr>
                                <td>{{ $topup->user->name }}</td>
                                <td>Rp{{ number_format($topup->amount, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ url('/bank/topups/'.$topup->id.'/approve') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Setujui</button>
                                    </form>
                                    <form action="{{ url('/bank/topups/'.$topup->id.'/reject') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection