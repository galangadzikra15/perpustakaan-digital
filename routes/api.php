<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\LoanController;

Route::apiResource(
    'books',
    BookController::class
);

Route::apiResource(
    'members',
    MemberController::class
);

Route::apiResource(
    'loans',
    LoanController::class
);