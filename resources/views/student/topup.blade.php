@extends('layouts.app')

@section('title', 'Top Up Saldo')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto shadow-sm p-4" style="max-width: 500px;">
        <h3 class="text-center mb-3">Top Up Saldo</h3>

        <form action="{{ route('student.topup') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Top Up</label>
                <input type="number" class="form-control" name="amount" min="1000" placeholder="Minimal Rp 1.000" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Top Up</button>
        </form>
    </div>
</div>
@endsection
