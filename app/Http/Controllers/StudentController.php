<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Balance;
use App\Models\User;
use App\Models\Wallet; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function dashboard()
{
    $wallet = Wallet::where('user_id', Auth::id())->first();

   

    return view('student.topup', compact('wallet'));
    }
    
}
