@extends('layouts.app')

@section('title', 'Transfer')

@section('content')
<div class="container">
    <div class="transfer-container mx-auto">
        <h2 class="text-center mb-4">Form Transfer Antar Siswa</h2>

        <form method="POST" action="{{ route('student.transfer.post') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Dari Rekening:</label>
                <input type="text" class="form-control" name="from_account" value="{{ auth()->user()->account_number }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Ke Rekening:</label>
                <input type="text" class="form-control" name="to_account" placeholder="Masukkan nomor rekening tujuan" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Transfer:</label>
                <input type="number" class="form-control" name="amount" min="1000" placeholder="Minimal transfer Rp 1.000" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Kirim Transfer</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .transfer-container {
        max-width: 500px;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
