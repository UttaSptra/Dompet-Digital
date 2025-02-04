
<div class="container">
    <h1>Halo, {{ auth()->user()->name }}!</h1>
    <div class="card mb-4">
        <div class="card-body text-center">
            <h4>Saldo Anda</h4>
            <h2>Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</h2>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <a href="#topup" class="btn btn-success w-100" data-bs-toggle="modal">Top Up</a>
        </div>
        <div class="col-md-4">
            <a href="#transfer" class="btn btn-primary w-100" data-bs-toggle="modal">Transfer</a>
        </div>
        <div class="col-md-4">
            <a href="#withdraw" class="btn btn-warning w-100" data-bs-toggle="modal">Tarik Tunai</a>
        </div>
    </div>
</div>

