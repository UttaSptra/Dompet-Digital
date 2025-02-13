<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dompet Digital')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .user-info {
            padding: 15px;
            background-color: #212529;
            color: white;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
    @stack('styles')
</head>
<body>
    @php 
        $user = auth()->user();
        $role = $user->role_id;
    @endphp
    <div class="sidebar">
        <h4 class="text-center">Bank Sekolah</h4>
        <hr>
        <div class="user-info">
            <p><strong>{{ $user->name }}</strong></p>
         
            @if($role == 3)
                <p>No Rekening: {{ $user->account_number }}</p>
            @endif
        </div>
        @if($role == 1)
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.createUser') }}">Buat Pengguna</a> 
        @elseif($role == 2)
            <a href="{{ route('bank.dashboard') }}">Dashboard</a>
            <a href="{{ route('bank.topups') }}">Persetujuan Top-Up</a>
        @elseif($role == 3)
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('student.topup') }}">Top-Up Saldo</a>
            <a href="{{ route('student.transfer') }}">Transfer</a>
            <a href="{{ route('student.history') }}">Riwayat Transaksi</a>
        @endif
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>