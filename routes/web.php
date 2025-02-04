<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopUpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan ada file view 'dashboard.blade.php'
})->name('dashboard');

// Untuk siswa
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/topup', [TopUpController::class, 'create']);
    Route::post('/topup', [TopUpController::class, 'store']);
});

// Untuk Bank Mini
Route::middleware(['auth', 'role:bank'])->group(function () {
    Route::get('/bank/topups', [TopUpController::class, 'index']);
    Route::post('/bank/topups/{id}/approve', [TopUpController::class, 'approve']);
    Route::post('/bank/topups/{id}/reject', [TopUpController::class, 'reject']);
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/topup', [StudentController::class, 'dashboard'])->name('student.topup');

});

Route::middleware(['auth', 'role:bank'])->group(function () {
    Route::get('/bank/topups', [BankController::class, 'topup'])->name('bank.topups');
    Route::post('/bank/approve/{id}', [BankController::class, 'approveTopup'])->name('bank.approve');
});


