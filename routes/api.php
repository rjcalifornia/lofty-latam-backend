<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PropertyController;
use App\Http\Controllers\api\LeaseController;
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
//Route::get('/test', [PaymentsController::class, 'sendPaymentReceipt'])->middleware('auth:sanctum');

Route::prefix('/v1/administration')->group(function () {
    Route::get('/user/profile', [UsersController::class, 'userProfile'])->middleware('auth:sanctum');
});


Route::prefix('/v1/user')->group(function () {
    Route::get('/', [UsersController::class, 'getUserDetails'])->middleware('auth:sanctum');
    Route::patch('/update', [UsersController::class, 'updateUserDetails'])->middleware('auth:sanctum');
    Route::post('/change-password', [UsersController::class, 'changePassword'])->middleware('auth:sanctum');
    Route::get('/profile', [UsersController::class, 'userProfile'])->middleware('auth:sanctum');
    Route::post('/registration', [UsersController::class, 'userRegistration']);
    Route::post('/resend-validation-email', [UsersController::class, 'resendValidationEmail'])->middleware('auth:sanctum');
    Route::post('/deactivate-account', [UsersController::class, 'deactivateAccount'])->middleware('auth:sanctum');
});

Route::prefix('/v1/security')->group(function () {
    Route::post('/authenticate', [AuthController::class, 'login']);
   // Route::post('/registration', [AuthController::class, 'register']);
    Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix('v1/dashboard/properties')->group(function (){
    Route::post('/add-new', [PropertyController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/create-new-lease', [PropertyController::class, 'createLease'])->middleware('auth:sanctum');
    Route::get('/list', [PropertyController::class, 'listProperties'])->middleware('auth:sanctum');
});

Route::prefix('v1/property')->group(function (){
    Route::get('/{id}/view', [PropertyController::class, 'viewPropertyDetails'])->middleware('auth:sanctum');
    Route::delete('/{id}/view', [PropertyController::class, 'removeProperty'])->middleware('auth:sanctum');
    Route::patch('/{id}/update', [PropertyController::class, 'updatePropertyDetails'])->middleware('auth:sanctum');
    Route::get('/{id}/leases', [LeaseController::class, 'listLeases'])->middleware('auth:sanctum');
    Route::get('/lease/{id}/details', [LeaseController::class, 'viewLeaseDetails'])->middleware('auth:sanctum');
    Route::patch('/lease/{id}/details', [LeaseController::class, 'updateLeaseDetails'])->middleware('auth:sanctum');
    Route::delete('/lease/{id}/termination', [LeaseController::class, 'terminateLease'])->middleware('auth:sanctum');
    Route::post('/lease/{id}/print', [LeaseController::class, 'printLeaseContract'])->middleware('auth:sanctum');
    Route::post('/pictures/store', [PropertyController::class, 'addPropertyPicture'])->middleware('auth:sanctum');
    Route::get('/pictures/{id}/view', [PropertyController::class, 'viewPropertyPicture'])->middleware('auth:sanctum');
    Route::get('/pictures/placeholder', [PropertyController::class, 'placeholderPicture'])->middleware('auth:sanctum');
});


Route::prefix('v1/payments')->group(function (){
    Route::post('/store-rent-payment', [PaymentsController::class, 'storePayment'])->middleware('auth:sanctum');
    Route::get('/{id}/history',[PaymentsController::class, 'paymentsHistory'])->middleware('auth:sanctum');
    Route::post('/print-receipt', [PaymentsController::class, 'printPaymentReceipt'])->middleware('auth:sanctum');
    Route::post('/send-payment-receipt', [PaymentsController::class, 'sendPaymentReceipt'])->middleware('auth:sanctum');
});

Route::prefix('v1/receipt')->group(function (){
    Route::get('/{uuid}/view',[PaymentsController::class, 'viewReceiptAttestationPublic']);
    Route::get('/{uuid}/print',[PaymentsController::class, 'printReceiptAttestationPublic']);
});

Route::prefix('v1/notifications')->group(function (){
    Route::get('/payments/status',[NotificationsController::class, 'paymentStatus'])->middleware('auth:sanctum');
});

Route::prefix('v1/catalogs')->group(function (){
    Route::get('/rent-type/list', [CatalogsController::class, 'getRentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/payment-class/list', [CatalogsController::class, 'getPaymentClassCatalog'])->middleware('auth:sanctum');
    Route::get('/payment-type/list', [CatalogsController::class, 'getPaymentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/document-type/list', [CatalogsController::class, 'getDocumentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/property-type/list', [CatalogsController::class, 'getPropertyTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/departamentos', [CatalogsController::class, 'getDepartamentos']);
    Route::get('/municipios/{idDepartamento}', [CatalogsController::class, 'getMunicipios']);
    Route::get('/distritos/{idMunicipio}', [CatalogsController::class, 'getDistritos']);
});

