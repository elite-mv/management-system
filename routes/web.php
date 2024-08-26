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
use App\Http\Controllers\Expense\RequestDeliveryController;
use App\Http\Controllers\Expense\RequestItemController;
use App\Http\Controllers\Income\CustomerController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\Income\QuoteController;
use App\Http\Controllers\Income\InvoiceController;
use App\Http\Middleware\SetGlobalVariables;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::prefix('income')->group(function () {
    Route::get('/', [IncomeController::class, 'index']);

    Route::get('/customer', [CustomerController::class, 'index']);

    Route::post('/customer/add', [CustomerController::class, 'customer_add']);
    Route::get('/customer/get', [CustomerController::class, 'customer_get']);
    Route::get('/customer/select', [CustomerController::class, 'customer_select']);
    Route::put('/customer/update', [CustomerController::class, 'customer_update']);

    Route::post('/customer/salutation/add', [CustomerController::class, 'salutation_add']);
    Route::get('/customer/salutation/get', [CustomerController::class, 'salutation_get']);

    Route::post('/customer/currency/add', [CustomerController::class, 'currency_add']);
    Route::get('/customer/currency/get', [CustomerController::class, 'currency_get']);

    Route::get('/quote', [QuoteController::class, 'index']);
    Route::post('/quote/addList', [QuoteController::class, 'addQuotationList']);
    Route::post('/quote/ReaddList', [QuoteController::class, 'ReaddQuotationList']);
    Route::post('/quote/addItem', [QuoteController::class, 'addQuotationItem']);
    Route::get('/quote/selectList', [QuoteController::class, 'getQuotationList']);
    Route::get('/quote/selectItem', [QuoteController::class, 'getQuotationItem']);
    Route::get('/quote/selectNavigation', [QuoteController::class, 'getQuotationNavigation']);
    Route::post('/quote/customer/add', [QuoteController::class, 'addCustomerData']);
    Route::get('/quote/customer/get', [QuoteController::class, 'ReaddCustomerData']);

    Route::get('/invoice', [InvoiceController::class, 'index']);
});

Route::prefix('expense')->group(function () {

    Route::middleware(['auth', SetGlobalVariables::class])->group(function () {

        Route::get('/request', [RequestController::class, 'index']);
        Route::get('/requests', [RequestController::class, 'getRequests']);
        Route::get('/api/my-requests', [RequestController::class, 'getRequestsData']);

        Route::get('/book-keeper', [BookKeeperController::class, 'index']);
        Route::get('/api/book-keeper', [BookKeeperController::class, 'getRequests']);

        Route::get('/accountant', [AccountantController::class, 'index']);
        Route::get('/api/accountant', [AccountantController::class, 'getRequests']);

        Route::get('/finance', [FinanceController::class, 'index']);
        Route::get('/api/finance', [FinanceController::class, 'getRequests']);

        Route::get('/president', [PresidentController::class, 'index']);
        Route::get('/api/president', [PresidentController::class, 'getRequests']);

        Route::get('/auditor', [AuditorController::class, 'index']);
        Route::get('/api/auditor', [AuditorController::class, 'getRequests']);

        Route::get('/entity', [CompanyController::class, 'index']);

        Route::post('/request', [RequestController::class, 'addRequest']);
        Route::get('/request/{id}', [RequestController::class, 'viewRequest']);

        Route::post('/api/request-item', [RequestItemController::class, 'addRequestItem']);
        Route::get('/api/request-item', [RequestItemController::class, 'getRequestItems']);

        Route::get('/api/request-item/total', [RequestItemController::class, 'getRequestTotal']);
        Route::get('/api/request-item/{id}', [RequestItemController::class, 'getRequestItem']);

        Route::delete('/api/request-item/{id}', [RequestItemController::class, 'removeItem']);
        Route::post('/api/request-item/{id}', [RequestItemController::class, 'updateItem']);

        Route::post('/api/request-item/file/{id}', [RequestItemController::class, 'addRequestItemImage']);

        Route::post('/api/expense-request/bank-details', [BankDetailController::class, 'addBankDetails']);
        Route::delete('/api/expense-request/bank-details/{requestID}', [BankDetailController::class, 'removeBankDetails']);

        Route::post('/api/expense-request/delivery/status/{requestID}', [RequestDeliveryController::class, 'addDelivery']);
        Route::delete('/api/expense-request/delivery/status/{requestID}', [RequestDeliveryController::class, 'deleteDelivery']);

        Route::post('/api/expense-request/delivery/supplier/{requestID}', [RequestDeliveryController::class, 'verifySupplier']);
        Route::delete('/api/expense-request/delivery/supplier/{requestID}', [RequestDeliveryController::class, 'deleteSupplier']);


        Route::post('/api/expense-request/payment-method/{requestID}', [RequestController::class, 'updatePaymentMethod']);

        Route::post('/api/expense-request/attachment/{id}', [RequestController::class, 'updateAttachment']);
        Route::post('/api/expense-request/type/{id}', [RequestController::class, 'updateType']);
        Route::post('/api/expense-request/receipt/{id}', [RequestController::class, 'updateReceipt']);
        Route::post('/api/expense-request/priority-level/{id}', [RequestController::class, 'updatePriorityLevel']);

    });

});
