@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Transfer Saldo</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('transfer') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="target_user_id" class="form-label">Pilih Penerima</label>
            <select name="target_user_id" id="target_user_id" class="form-control" required>
                <option value="">-- Pilih Penerima --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="amount" class="form-label">Jumlah Transfer</label>
            <input type="number" name="amount" id="amount" class="form-control" min="1000" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
