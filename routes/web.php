<?php

use App\Http\Controllers\DownloadableFormController;
use App\Http\Controllers\Expense\AccountantController;
use App\Http\Controllers\Expense\AccountController;
use App\Http\Controllers\Expense\AuditorController;
use App\Http\Controllers\Expense\AuthController;
use App\Http\Controllers\Expense\BankDetailController;
use App\Http\Controllers\Expense\BookKeeperController;
use App\Http\Controllers\Expense\ChatController;
use App\Http\Controllers\Expense\CompanyController;
use App\Http\Controllers\Expense\DailyRequest;
use App\Http\Controllers\Expense\DashboardController;
use App\Http\Controllers\Expense\FinanceController;
use App\Http\Controllers\Expense\HomeController;
use App\Http\Controllers\Expense\JobOrderController;
use App\Http\Controllers\Expense\PresidentController;
use App\Http\Controllers\Expense\RequestApprovalController;
use App\Http\Controllers\Expense\RequestCommentController;
use App\Http\Controllers\Expense\RequestController;
use App\Http\Controllers\Expense\RequestDeliveryController;
use App\Http\Controllers\Expense\RequestExpenseController;
use App\Http\Controllers\Expense\RequestItemController;
use App\Http\Controllers\Expense\RequestLogsController;
use App\Http\Controllers\Expense\RequestVoucher;
use App\Http\Controllers\Expense\PastRequestController;
use App\Http\Controllers\Expense\UnitOfMeasureController;
use App\Http\Controllers\Expense\VatController;
use App\Http\Controllers\Income\CustomerController;
use App\Http\Controllers\Income\IncomeController;
use App\Http\Controllers\Income\QuoteController;
use App\Http\Controllers\Income\InvoiceController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PdfController;
use App\Http\Middleware\BankCodesData;
use App\Http\Middleware\BankData;
use App\Http\Middleware\CheckUserPin;
use App\Http\Middleware\CompanyData;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\ExpenseCategoryData;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {

    Route::get('/pin', [NavigationController::class, 'pin'])->name('pin');
    Route::post('/pin', [NavigationController::class, 'verifyPin']);

    Route::middleware([CheckUserPin::class])->get('/navigation', [NavigationController::class, 'index']);
    Route::middleware([CheckUserPin::class])->post('/logout', [AuthController::class, 'logout']);

});

Route::prefix('income')->middleware([CompanyMiddleware::class])->group(function () {

    Route::get('/', [IncomeController::class, 'index']);

    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/{id}', [CustomerController::class, 'getCustomer']);
    Route::post('/customer', [CustomerController::class, 'addCustomer']);

    Route::get('/api/customers', [CustomerController::class, 'getCustomers']);

    Route::post('/customer/add', [CustomerController::class, 'customer_add']);
    Route::get('/customer/get', [CustomerController::class, 'customer_get']);
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

Route::prefix('expense')->group(function () {
    Route::middleware(['auth', CheckUserPin::class])->group(function () {

        Route::get('/home', [HomeController::class, 'index']);
        Route::get('/request', [RequestController::class, 'index']);

        Route::get('/pdf/request/{requestID}', [PdfController::class, 'downloadPDF']);

        Route::middleware([CompanyData::class])->get('/forms', [DownloadableFormController::class, 'index']);
        Route::post('/forms/excel', [DownloadableFormController::class, 'generateExcel']);

        Route::get('/next-request/{requestID}', [RequestController::class, 'nextRequest']);
        Route::get('/prev-request/{requestID}', [RequestController::class, 'prevRequest']);
        Route::middleware([CompanyData::class])->get('/requests', [RequestController::class, 'getRequests']);
        Route::get('/daily-request', [DailyRequest::class, 'index']);

        Route::middleware([CompanyData::class])->get('/book-keeper', [BookKeeperController::class, 'index']);
        Route::middleware([CompanyData::class])->get('/accountant', [AccountantController::class, 'index']);
        Route::middleware([CompanyData::class])->get('/finance', [FinanceController::class, 'index']);
        Route::middleware([CompanyData::class])->get('/president', [PresidentController::class, 'index']);
        Route::middleware([CompanyData::class])->get('/auditor', [AuditorController::class, 'index']);

        Route::get('/job-order', [JobOrderController::class, 'index']);
        Route::post('/job-order', [JobOrderController::class, 'addJobOrder']);
        Route::patch('/job-order/{jobOrder}', [JobOrderController::class, 'updateJobOrder']);
        Route::delete('/job-order/{jobOrder}', [JobOrderController::class, 'archiveJobOrder']);

        Route::post('/entity', [CompanyController::class, 'addCompany']);
        Route::get('/entity', [CompanyController::class, 'index']);
        Route::delete('/entity/{company}', [CompanyController::class, 'deleteCompany']);
        Route::patch('/entity/{company}', [CompanyController::class, 'updateCompany']);

        Route::get('/unit-of-measure', [UnitOfMeasureController::class, 'index']);
        Route::patch('/unit-of-measure/{measurement}', [UnitOfMeasureController::class, 'updateMeasurement']);
        Route::delete('/unit-of-measure/{measurement}', [UnitOfMeasureController::class, 'deleteMeasurement']);
        Route::post('/unit-of-measure', [UnitOfMeasureController::class, 'addMeasurement']);

        Route::post('/request', [RequestController::class, 'addRequest']);

        Route::middleware([ExpenseCategoryData::class, BankData::class, BankCodesData::class])
            ->get('/request/{id}', [RequestController::class, 'viewRequest'])
            ->name('request');


        Route::post('/expense-request/book-keeper/approval/{requestID}', [RequestApprovalController::class, 'updateBookKeeper']);
        Route::post('/expense-request/accountant/approval/{requestID}', [RequestApprovalController::class, 'updateAccountant']);
        Route::post('/expense-request/finance/approval/{requestID}', [RequestApprovalController::class, 'updateFinance']);
        Route::post('/expense-request/auditor/approval/{requestID}', [RequestApprovalController::class, 'updateAuditor']);

        Route::prefix('/expense-request')->group(function () {

            // expense/expense-request/expense/
            Route::prefix('/expense/vat')->group(function () {
                Route::post('/purchase-order/{requestID}', [VatController::class, 'updatePurchaseOrder']);
                Route::post('/invoice/{requestID}', [VatController::class, 'updateInvoice']);
                Route::post('/bill/{requestID}', [VatController::class, 'updateBill']);
                Route::post('/official-receipt/{requestID}', [VatController::class, 'updateOfficialReceipt']);
                Route::post('/option-a/{requestID}', [VatController::class, 'updateOptionA']);
                Route::post('/option-b/{requestID}', [VatController::class, 'updateOptionB']);
            });


            Route::post('/terms/{requestID}', [RequestController::class, 'updateTerms']);
            Route::post('/paid-to/{requestID}', [RequestController::class, 'updatePaidTo']);

            Route::get('/comments/{requestID}', [RequestCommentController::class, 'viewComments'])->name('comments');
            Route::post('/comment/{requestID}', [RequestCommentController::class, 'addComment']);

        });

        Route::prefix('/api')->group(function () {
            Route::post('/request/status/{expenseRequest}', [RequestController::class, 'updateRequestStatus']);
            Route::post('/request/voucher/{expenseRequest}', [RequestVoucher::class, 'generate']);
            Route::get('/my-requests', [RequestController::class, 'getRequestsData']);
            Route::get('/book-keeper', [BookKeeperController::class, 'getRequests']);
            Route::get('/accountant', [AccountantController::class, 'getRequests']);
            Route::get('/finance', [FinanceController::class, 'getRequests']);
            Route::get('/president', [PresidentController::class, 'getRequests']);
            Route::get('/auditor', [AuditorController::class, 'getRequests']);
            Route::post('/request-item/update/{requestItem}', [RequestItemController::class, 'updateRequestItem']);
            Route::post('/request-item', [RequestItemController::class, 'addRequestItem']);
            Route::get('/request-item', [RequestItemController::class, 'getRequestItems']);
            Route::get('/request-item/total', [RequestItemController::class, 'getRequestTotal']);
            Route::get('/request-item/{id}', [RequestItemController::class, 'getRequestItem']);

            Route::post('/request-item/delete/{id}', [RequestItemController::class, 'removeItem']);

            Route::post('/request-item/{id}', [RequestItemController::class, 'updateItem']);
            Route::post('/request-item/file/{id}', [RequestItemController::class, 'addRequestItemImage']);
            Route::post('/expense-request/bank-details', [BankDetailController::class, 'addBankDetails']);
            Route::delete('/expense-request/bank-details/{requestID}', [BankDetailController::class, 'removeBankDetails']);
            Route::post('/expense-request/delivery/status/{requestID}', [RequestDeliveryController::class, 'addDelivery']);
            Route::delete('/expense-request/delivery/status/{requestID}', [RequestDeliveryController::class, 'deleteDelivery']);
            Route::post('/expense-request/delivery/supplier/{requestID}', [RequestDeliveryController::class, 'verifySupplier']);
            Route::delete('/expense-request/delivery/supplier/{requestID}', [RequestDeliveryController::class, 'deleteSupplier']);
            Route::post('/expense-request/payment-method/{requestID}', [RequestController::class, 'updatePaymentMethod']);
            Route::post('/expense-request/attachment/{id}', [RequestController::class, 'updateAttachment']);
            Route::post('/expense-request/type/{id}', [RequestController::class, 'updateType']);
            Route::post('/expense-request/receipt/{id}', [RequestController::class, 'updateReceipt']);
            Route::post('/expense-request/priority-level/{id}', [RequestController::class, 'updatePriorityLevel']);
            Route::post('/expense-request/expense-type/{expenseRequest}', [RequestExpenseController::class, 'updateRequestExpense']);
            Route::post('/expense-request/fund-status/{requestID}', [RequestController::class, 'updateFundStatus']);
        });

        Route::post('/expense-request/received-by/{requestID}', [RequestController::class, 'updateReceivedBy']);
        Route::post('/expense-request/audited-by/{requestID}', [RequestController::class, 'auditedBy']);

        Route::get('/account', [AccountController::class, 'index']);
        Route::post('/account/update/name', [AccountController::class, 'update_name']);
        Route::post('/account/update/secret_pin', [AccountController::class, 'update_secret_pin']);
        Route::post('/account/update/password', [AccountController::class, 'update_password']);

        Route::middleware([ExpenseCategoryData::class, BankData::class, BankCodesData::class])->get('/past_request', [PastRequestController::class, 'index']);

        Route::get('/accounts', [AccountController::class, 'accounts']);

        Route::get('/logs', [RequestLogsController::class, 'index']);

        Route::get('/chats', [ChatController::class, 'chatDetails']);
        Route::get('/chat', [ChatController::class, 'index']);
        Route::post('/chat', [ChatController::class, 'addMessage']);

        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
});

Route::get('/tae', function (){
    return view('check');
});

Route::get('/check', [PdfController::class, 'check']);
Route::get('/excel-test', [PdfController::class, 'index']);


Route::post('/test-pdf', [PdfController::class, 'downloadMultiplePDF']);
Route::get('/test', [PdfController::class, 'index']);
Route::get('/test/{expenseRequest}', [PdfController::class, 'test']);
Route::get('/test2/{requestID}', [PdfController::class, 'test2']);
