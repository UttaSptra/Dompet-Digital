@extends('layouts.app')

@section('title', 'Riwayat Transfer')

@section('content')
<div class="container">
    <h2>Riwayat Transfer</h2>

    @if ($transfers->isEmpty())
        <p>Belum ada riwayat transfer.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Dari</th>
                    <th>Ke</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ $transfer->sender->name }}</td>
                        <td>{{ $transfer->receiver->name }}</td>
                        <td>Rp {{ number_format($transfer->amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($transfer->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
