<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestItemController;

Route::get('/', [AuthController::class,'index'])->name('login');;
Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class,'logout']);

    Route::get('/request', [RequestController::class,'index']);
    Route::get('/requests', [RequestController::class,'getRequests']);
    Route::get('/api/my-requests', [RequestController::class,'getRequestsData']);

    Route::get('/entities', [CompanyController::class,'index']);

    Route::post('/request', [RequestController::class,'addRequest']);

    Route::post('/api/request-item', [RequestItemController::class,'addRequestItem']);
    Route::get('/api/request-item', [RequestItemController::class,'getRequestItems']);

    Route::get('/api/request-item/total', [RequestItemController::class,'getRequestTotal']);
    Route::get('/api/request-item/{id}', [RequestItemController::class,'getRequestItem']);

    Route::delete('/api/request-item/{id}', [RequestItemController::class,'removeItem']);
    Route::post('/api/request-item/{id}', [RequestItemController::class,'updateItem']);

    Route::post('/api/request-item/file/{id}', [RequestItemController::class,'addRequestItemImage']);
});
