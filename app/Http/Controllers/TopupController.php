<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    public function dashboard() {
        return view('dashboard');
    }
    // Form pengajuan top-up
    public function create() {
        return view('student.topup');
    }

    // Proses pengajuan top-up
    public function store(Request $request) {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        TopUp::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan top-up berhasil dikirim!');
    }

    // Menampilkan daftar top-up untuk Bank Mini
    public function index() {
        $students = User::all(); 
        $topups = TopUp::where('status', 'pending')->get();
        return view('bank.bank', compact('topups','students'));
    }

    // Proses persetujuan atau penolakan
    public function approve($id) {
        $topup = TopUp::findOrFail($id);
        $topup->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        // Update saldo
        $wallet = Wallet::firstOrCreate(['user_id' => $topup->user_id]);
        $wallet->balance += $topup->amount;
        $wallet->save();

        return back()->with('success', 'Top-up berhasil disetujui!');
    }

    public function reject($id) {
        $topup = TopUp::findOrFail($id);
        $topup->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('error', 'Top-up ditolak.');
    }
    
}
