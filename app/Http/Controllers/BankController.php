<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topup;  // Tambahkan ini untuk mengimpor model Topup
use App\Models\Wallet; // Pastikan juga model Wallet diimpor jika diperlukan
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function topup()
{
    // Hanya ambil topup dengan status 'pending'
    $topups = Topup::where('status', 'pending')->get();

    return view('bank.bank', compact('topups'));
}


    public function __construct()
    {
        $this->middleware('role:bank');
    }

    public function approveTopup($id)
    {
        $topup = Topup::findOrFail($id);
    
        // Cek apakah topup sudah disetujui sebelumnya
        if ($topup->status == 'approved') {
            return redirect()->back()->with('error', 'Top-up ini sudah disetujui sebelumnya.');
        }
    
        $topup->status = 'approved';
        $topup->save();
    
        // Update saldo siswa
        $wallet = Wallet::firstOrCreate(['user_id' => $topup->user_id]);
        $wallet->balance += $topup->amount;
        $wallet->save();
    
        return redirect()->back()->with('success', 'Top-up berhasil disetujui.');
    }
    public function dashboard()
{
    // Pastikan hanya user dengan role_id = 2 (Bank Mini) yang bisa melihat
    if (Auth::user()->role_id !== 2) {
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses.');
    }

    // Ambil daftar top-up yang belum diproses
    $topups = TopUp::where('status', 'pending')->get();

    // Kirim data ke view
    return view('bank.bank', compact('topups'));
}
}
