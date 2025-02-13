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
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6'
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    // Jika password diisi, update password
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.dashboard')->with('success', 'User berhasil diperbarui!');
}
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('login')->with('success', 'User berhasil dihapus!');
    }
}
