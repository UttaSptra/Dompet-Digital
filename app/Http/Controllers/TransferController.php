<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
use App\Models\Wallet;
use App\Models\Transfer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function transfer(Request $request)
    {

        
        Log::info('User Authenticated:', ['user' => auth()->user()]);
        Log::info('User Role:', ['role_id' => auth()->user()->role_id]);
    
        if (!auth()->check()) {
            return response()->json(['message' => 'User is not authenticated'], 403);
        }
    
        // Pastikan role siswa
        if (auth()->user()->role_id != 3) {
            return response()->json(['message' => 'Hanya siswa yang dapat melakukan transfer'], 403);
        }
        // Validasi input
        $request->validate([
            'from_account' => 'required|exists:users,account_number',
            'to_account' => 'required|exists:users,account_number|different:from_account',
            'amount' => 'required|numeric|min:1',
        ]);

        // Ambil pengguna pengirim dan penerima berdasarkan account_number
        $fromUser = User::where('account_number', $request->from_account)->first();
        $toUser = User::where('account_number', $request->to_account)->first();
        $amount = $request->amount;

        // Pastikan kedua pengguna adalah siswa
        if ($fromUser->role_id != 3 || $toUser->role_id != 3) {
            return response()->json(['message' => 'Hanya siswa yang dapat melakukan transfer'], 403);
        }

        // Ambil saldo pengirim dan penerima dari tabel balances
        $fromBalance = Wallet::firstOrCreate(
            ['user_id' => $fromUser->id],
            ['balance' => 0] // Jika tidak ada, buat dengan saldo awal 0
        );
        
        $toBalance = Wallet::firstOrCreate(
            ['user_id' => $toUser->id],
            ['balance' => 0] // Jika tidak ada, buat dengan saldo awal 0
        );
               


        // Cek apakah saldo mencukupi
        if (!$fromBalance || $fromBalance->balance < $amount) {
            return response()->json(['message' => 'Saldo tidak cukup'], 400);
        }

        // Lakukan transaksi transfer
        DB::transaction(function () use ($fromUser, $toUser, $fromBalance, $toBalance, $amount) {
            $fromBalance->decrement('balance', $amount);
            $toBalance->increment('balance', $amount);

             // Simpan history transfer
             Transfer::create([
                'from_user_id' => $fromUser->id,
                'to_user_id' => $toUser->id,
                'amount' => $amount,
                'status' => 'success',
            ]);
        });

        
    
        return response()->json([
            'authenticated' => auth()->check(),
            'user' => auth()->user(),
            'role' => auth()->user()->role_id,
        ], 200);
        
        
    }

    // Fungsi untuk melihat riwayat transfer siswa
    public function history()
    {
        $transfers = Transfer::where('from_user_id', auth()->id())
            ->orWhere('to_user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.history', compact('transfers'));
    }
}


