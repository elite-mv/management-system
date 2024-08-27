<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\Expense\AccountantController;
use App\Http\Controllers\Expense\AuditorController;
use App\Http\Controllers\Expense\AuthController;
use App\Http\Controllers\Expense\BankDetailController;
use App\Http\Controllers\Expense\BookKeeperController;
use App\Http\Controllers\Expense\CompanyController;
use App\Http\Controllers\Expense\FinanceController;
use App\Http\Controllers\Expense\JobOrderController;
use App\Http\Controllers\Expense\PresidentController;
use App\Http\Controllers\Expense\RequestApprovalController;
use App\Http\Controllers\Expense\RequestCommentController;
use App\Http\Controllers\Expense\RequestController;
use App\Http\Controllers\Expense\RequestDeliveryController;
use App\Http\Controllers\Expense\RequestExpenseController;
use App\Http\Controllers\Expense\RequestItemController;
use App\Http\Controllers\Expense\RequestVoucher;
use App\Http\Controllers\Expense\VatController;
use App\Http\Controllers\Income\CustomerController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\Income\QuoteController;
use App\Http\Controllers\Income\InvoiceController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware\CheckUserPin;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\SetGlobalVariables;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::middleware([CheckUserPin::class])->get('/navigation', [NavigationController::class, 'index']);

Route::get('/pin', [NavigationController::class, 'pin'])->name('pin');
Route::post('/pin', [NavigationController::class, 'verifyPin']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::prefix('income')->middleware([CompanyMiddleware::class])->group(function () {

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
    Route::post('/quote/add_list', [QuoteController::class, 'add_list']);
    Route::post('/quote/add_item', [QuoteController::class, 'add_item']);
    Route::post('/quote/get_list', [QuoteController::class, 'get_list']);
    Route::get('/quote/get_navigation_list', [QuoteController::class, 'get_navigation_list']);
    Route::get('/quote/get_navigation_item', [QuoteController::class, 'get_navigation_item']);
    Route::get('/quote/get_navigation', [QuoteController::class, 'get_navigation']);
    Route::get('/quote/customer/get', [QuoteController::class, 'customer_get']);

    Route::get('/search-customer', [CustomerController::class, 'searchCustomer']);

    Route::get('/invoice', [InvoiceController::class, 'index']);
});


Route::get('/pdf', [PdfController::class, 'index']);

Route::prefix('expense')->group(function () {

    Route::middleware(['auth', SetGlobalVariables::class])->group(function () {

        Route::get('/request', [RequestController::class, 'index']);
        Route::get('/requests', [RequestController::class, 'getRequests']);
        Route::post('/api/request/status/{expenseRequest}', [RequestController::class, 'updateRequestStatus']);

        Route::post('/api/request/voucher/{expenseRequest}', [RequestVoucher::class, 'generate']);

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

        Route::get('/job-order', [JobOrderController::class, 'index']);
        Route::post('/job-order', [JobOrderController::class, 'addJobOrder']);
        Route::patch('/job-order/{jobOrder}', [JobOrderController::class, 'updateJobOrder']);
        Route::delete('/job-order/{jobOrder}', [JobOrderController::class, 'archiveJobOrder']);

        Route::post('/entity', [CompanyController::class, 'addCompany']);
        Route::get('/entity', [CompanyController::class, 'index']);
        Route::delete('/entity/{company}', [CompanyController::class, 'deleteCompany']);
        Route::patch('/entity/{company}', [CompanyController::class, 'updateCompany']);

        Route::post('/request', [RequestController::class, 'addRequest']);
        Route::get('/request/{id}', [RequestController::class, 'viewRequest'])->name('request');

        Route::post('/api/request-item/update/{requestItem}', [RequestItemController::class, 'updateRequestItem']);
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

        Route::post('/api/expense-request/expense-type/{expenseRequest}', [RequestExpenseController::class, 'updateRequestExpense']);

        Route::post('/api/expense-request/fund-status/{requestID}', [RequestController::class, 'updateFundStatus']);

        Route::post('/expense-request/book-keeper/approval/{requestID}', [RequestApprovalController::class, 'updateBookKeeper']);
        Route::post('/expense-request/accountant/approval/{requestID}', [RequestApprovalController::class, 'updateAccountant']);
        Route::post('/expense-request/finance/approval/{requestID}', [RequestApprovalController::class, 'updateFinance']);
        Route::post('/expense-request/auditor/approval/{requestID}', [RequestApprovalController::class, 'updateAuditor']);

        Route::post('/expense-request/expense/vat/purchase-order/{requestID}', [VatController::class, 'updatePurchaseOrder']);
        Route::post('/expense-request/expense/vat/invoice/{requestID}', [VatController::class, 'updateInvoice']);
        Route::post('/expense-request/expense/vat/bill/{requestID}', [VatController::class, 'updateBill']);
        Route::post('/expense-request/expense/vat/official-receipt/{requestID}', [VatController::class, 'updateOfficialReceipt']);

        Route::post('/expense-request/expense/vat/option-a/{requestID}', [VatController::class, 'updateOptionA']);
        Route::post('/expense-request/expense/vat/option-b/{requestID}', [VatController::class, 'updateOptionB']);

        Route::get('/expense-request/comments/{requestID}', [RequestCommentController::class, 'viewComments'])->name('comments');
        Route::post('/expense-request/comment/{requestID}', [RequestCommentController::class, 'addComment']);


    });
});

Route::get('/test/{expenseRequest}', [PdfController::class, 'test']);
Route::get('/test2/{expenseRequest}', [PdfController::class, 'test2']);
