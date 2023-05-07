<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PropertyController;
use App\Http\Controllers\api\CatalogsController;
use App\Http\Controllers\api\PaymentsController;
use App\Http\Controllers\api\UsersController;
use App\Http\Controllers\api\NotificationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('/user', [AuthController::class, 'getUserDetails'])->middleware('auth:sanctum');

Route::prefix('/v1/administration')->group(function () {
    Route::get('/user/profile', [UsersController::class, 'userProfile'])->middleware('auth:sanctum');
});

Route::prefix('/v1/security')->group(function () {
    Route::post('/authenticate', [AuthController::class, 'login']);
    Route::post('/registration', [AuthController::class, 'register']);
    Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('v1/dashboard/properties')->group(function (){
    Route::post('/add-new', [PropertyController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/create-new-lease', [PropertyController::class, 'createLease'])->middleware('auth:sanctum');
    Route::get('/list', [PropertyController::class, 'listProperties'])->middleware('auth:sanctum');
});

Route::prefix('v1/property')->group(function (){
    Route::get('/{id}/view', [PropertyController::class, 'viewPropertyDetails'])->middleware('auth:sanctum');
    Route::get('/{id}/leases', [PropertyController::class, 'listLeases'])->middleware('auth:sanctum');
    Route::get('/lease/{id}/details', [PropertyController::class, 'viewLeaseDetails'])->middleware('auth:sanctum');
    Route::post('/pictures/store', [PropertyController::class, 'addPropertyPicture'])->middleware('auth:sanctum');
    Route::get('/pictures/{id}/view', [PropertyController::class, 'viewPropertyPicture'])->middleware('auth:sanctum');
});


Route::prefix('v1/payments')->group(function (){
    Route::post('/store-rent-payment', [PaymentsController::class, 'storePayment'])->middleware('auth:sanctum');
    Route::get('/{id}/history',[PaymentsController::class, 'paymentsHistory'])->middleware('auth:sanctum');
    Route::post('/print-receipt', [PaymentsController::class, 'printPaymentReceipt'])->middleware('auth:sanctum');
});

Route::prefix('v1/notifications')->group(function (){
    Route::get('/payments/status',[NotificationsController::class, 'paymentStatus'])->middleware('auth:sanctum');
});

Route::prefix('v1/catalogs')->group(function (){
    Route::get('/rent-type/list', [CatalogsController::class, 'getRentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/payment-type/list', [CatalogsController::class, 'getPaymentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/document-type/list', [CatalogsController::class, 'getDocumentTypeCatalog'])->middleware('auth:sanctum');
});

