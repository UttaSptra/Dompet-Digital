<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah tempat untuk mendaftarkan web routes dalam aplikasi Laravel.
| Routes ini dimuat oleh RouteServiceProvider dan semuanya akan diberikan
| ke grup middleware yang sesuai.
|
*/

// Routes untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard umum (pastikan ada file `resources/views/dashboard.blade.php`)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Routes untuk Siswa
Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/topup', [TopUpController::class, 'create'])->name('student.topup');
    Route::post('/topup', [TopUpController::class, 'store']);
    
    Route::get('/transfer', function () {
        return view('student.transfer');
    })->name('student.transfer');
    Route::get('/history', [TransferController::class, 'history'])->name('student.history');
    Route::post('/transfer', [TransferController::class, 'transfer'])->name('student.transfer.post');
});

// Routes untuk Bank Mini
Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/bank/dashboard', [TopUpController::class, 'dashboard'])->name('bank.dashboard');
    Route::get('/bank/topups', [TopUpController::class, 'index'])->name('bank.topups');
    Route::post('/bank/topups/{id}/approve', [TopUpController::class, 'approve'])->name('bank.topups.approve');
    Route::post('/bank/topups/{id}/reject', [TopUpController::class, 'reject'])->name('bank.topups.reject');
});

Route::get('/dashboard', [TopUpController::class, 'index'])->name('dashboard');

// Route khusus untuk login sebagai siswa (untuk testing)
Route::get('/login-as-siswa', function () {
    $user = \App\Models\User::where('role_id', 3)->first();
    auth()->login($user);
    return redirect()->route('student.transfer');
})->name('login.as.siswa');



Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/create-user', [AdminController::class, 'create'])->name('admin.createUser');
    Route::post('/admin/store-user', [AdminController::class, 'store'])->name('admin.storeUser');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [TopUpController::class, 'index'])->name('dashboard');
});
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'edit'])->name('admin.editUser');
    Route::put('/admin/update-user/{id}', [AdminController::class, 'update'])->name('admin.updateUser');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'destroy'])->name('admin.deleteUser');
});