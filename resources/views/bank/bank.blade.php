<h2>Daftar Pengajuan Top-up</h2>
@foreach ($topups as $topup)
    <div>
        <p>Siswa: {{ $topup->user->name }}</p>
        <p>Jumlah: Rp{{ number_format($topup->amount, 0, ',', '.') }}</p>

        <form action="{{ url('/bank/topups/'.$topup->id.'/approve') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Setujui</button>
        </form>

        <form action="{{ url('/bank/topups/'.$topup->id.'/reject') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Tolak</button>
        </form>
    </div>
@endforeach
@if(session('success')) <p>{{ session('success') }}</p> @endif
@if(session('error')) <p>{{ session('error') }}</p> @endif
@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

