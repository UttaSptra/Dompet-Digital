@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2>Daftar Pengguna</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No Rekening</th> 
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->role_id == 3 ? $student->account_number : '-' }}</td> 
            <td>{{ $student->name }}</td> 
            <td>{{ $student->email }}</td> 
            <td>
                @if($student->role_id == 1)
                    Admin
                @elseif($student->role_id == 2)
                    Bank
                @elseif($student->role_id == 3)
                    Siswa
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
