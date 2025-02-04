@extends('layouts.app')

@section('content')
<h1>Riwayat Transaksi</h1>
<a href="#topup" class="btn btn-success mb-3" data-bs-toggle="modal">Top Up</a>
<a href="#transfer" class="btn btn-primary mb-3" data-bs-toggle="modal">Transfer</a>
<a href="#withdraw" class="btn btn-warning mb-3" data-bs-toggle="modal">Tarik Tunai</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tipe</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Tujuan</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

<!-- Modal Top Up -->
<div class="modal fade" id="topup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('student.topup') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Top Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <input type="number" name="amount" id="amount" class="form-control" min="1000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal Transfer -->
<div class="modal fade" id="transfer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form action="{{ route('student.transfer') }}" method="POST">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Top Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah</label>
                <input type="number" name="amount" id="amount" class="form-control" min="1000" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Kirim</button>
        </div>
    </div>
</form>

    </div>
</div>

<!-- Modal Tarik Tunai -->
<div class="modal fade" id="withdraw" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('student.withdraw') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tarik Tunai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah</label>
                        <input type="number" name="amount" id="amount" class="form-control" min="1000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Tarik</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection