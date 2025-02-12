<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
{
    $users = User::all(); // Ambil semua user
    return view('admin.index', compact('users'));
}
    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.create-user');
    }

    // Simpan user baru ke database
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role_id' => 'required|in:1,2,3',
    ]);

    // Buat user baru dengan role yang dipilih
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
    ]);

    // Jika role-nya siswa, buatkan saldo awal (Rp 0)
    if ($request->role_id == 3) {
        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);
    }

    return redirect()->route('admin.createUser')->with('success', 'User berhasil ditambahkan!');
}
}
