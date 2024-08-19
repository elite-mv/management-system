<?php

use App\Http\Controllers\Expense\AccountantController;
use App\Http\Controllers\Expense\AuditorController;
use App\Http\Controllers\Expense\AuthController;
use App\Http\Controllers\Expense\BankDetailController;
use App\Http\Controllers\Expense\BookKeeperController;
use App\Http\Controllers\Expense\CompanyController;
use App\Http\Controllers\Expense\FinanceController;
use App\Http\Controllers\Expense\PresidentController;
use App\Http\Controllers\Expense\RequestController;
use App\Http\Controllers\Expense\RequestItemController;
use App\Http\Controllers\Income\CustomerController;
use App\Http\Controllers\Income\ExpenseController;
use App\Http\Middleware\SetGlobalVariables;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class,'index'])->name('login');
Route::post('/login', [AuthController::class,'login']);


// All routes for income
Route::prefix('income')->group(function () {

    //need auth
//    Route::middleware(['auth'])->group(function () {
//
//    });

    Route::get('/customer', [CustomerController::class,'index']);

    //public access
    Route::get('/', [ExpenseController::class,'index']);
});


Route::prefix('income')->group(function () {

    Route::post('/logout', [AuthController::class,'logout']);

    Route::get('/request', [RequestController::class,'index']);
    Route::get('/requests', [RequestController::class,'getRequests']);
    Route::get('/api/my-requests', [RequestController::class,'getRequestsData']);

    Route::get('/book-keeper', [BookKeeperController::class,'index']);
    Route::get('/api/book-keeper', [BookKeeperController::class,'getRequests']);

    Route::get('/accountant', [AccountantController::class,'index']);
    Route::get('/api/accountant', [AccountantController::class,'getRequests']);

    Route::get('/finance', [FinanceController::class,'index']);
    Route::get('/api/finance', [FinanceController::class,'getRequests']);

    Route::get('/president', [PresidentController::class,'index']);
    Route::get('/api/president', [PresidentController::class,'getRequests']);

    Route::get('/auditor', [AuditorController::class,'index']);
    Route::get('/api/auditor', [AuditorController::class,'getRequests']);

    Route::get('/entity', [CompanyController::class,'index']);

    Route::post('/request', [RequestController::class,'addRequest']);
    Route::get('/request/{id}', [RequestController::class,'viewRequest']);

    Route::post('/api/request-item', [RequestItemController::class,'addRequestItem']);
    Route::get('/api/request-item', [RequestItemController::class,'getRequestItems']);

    Route::get('/api/request-item/total', [RequestItemController::class,'getRequestTotal']);
    Route::get('/api/request-item/{id}', [RequestItemController::class,'getRequestItem']);

    Route::delete('/api/request-item/{id}', [RequestItemController::class,'removeItem']);
    Route::post('/api/request-item/{id}', [RequestItemController::class,'updateItem']);

    Route::post('/api/request-item/file/{id}', [RequestItemController::class,'addRequestItemImage']);

    Route::post('/api/expense-request/bank-details', [BankDetailController::class,'addBankDetails']);
    Route::delete('/api/expense-request/bank-details/{requestID}', [BankDetailController::class,'removeBankDetails']);
});





Route::middleware(['auth', SetGlobalVariables::class])->group(function () {



});
