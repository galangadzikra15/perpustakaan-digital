<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendBookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\FrontendLoanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// Route LOGOUT - PASTIKAN PAKAI POST
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Atau jika mau pakai GET (tidak direkomendasikan untuk keamanan)
// Route::get('/logout', [LoginController::class, 'logout']);

// Route yang membutuhkan login
Route::middleware(['checkLogin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Resource CRUD
    Route::resource('books', FrontendBookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);
    
    // Route tambahan
    Route::get('/loans/return/{id}', [LoanController::class, 'returnBook'])->name('loans.return');

    Route::post('/books/import', [FrontendBookController::class, 'import'])->name('books.import');


Route::get('/loans', [FrontendLoanController::class, 'index']);
Route::post('/loans/export/excel', [FrontendLoanController::class, 'exportExcel']);
Route::post('/loans/export/pdf', [FrontendLoanController::class, 'exportPdf']);
});