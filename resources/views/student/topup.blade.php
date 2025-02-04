<form action="{{ url('/topup') }}" method="POST">
    @csrf
    <label>Jumlah Top-up:</label>
    <input type="number" name="amount" required min="1000" placeholder="Minimal 1000">
    <button type="submit">Kirim</button>
</form>
@if(session('success')) <p>{{ session('success') }}</p> @endif
<div class="container">
    <h2>Selamat Datang, {{ Auth::user()->name }}</h2>

    @if($wallet)
        <h4>Saldo Anda: Rp {{ number_format($wallet->balance ?? 0, 0, ',', '.') }}</h4>
    @else
        <p>Saldo tidak ditemukan.</p>
    @endif
</div>