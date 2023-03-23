<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PropertyController;
use App\Http\Controllers\api\CatalogsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1/security')->group(function () {
    Route::post('/authenticate', [AuthController::class, 'login']);
    Route::post('/registration', [AuthController::class, 'register']);
});

Route::prefix('v1/dashboard/properties')->group(function (){
    Route::post('/add-new', [PropertyController::class, 'store'])->middleware('auth:sanctum');
    Route::post('/create-new-lease', [PropertyController::class, 'createLease'])->middleware('auth:sanctum');
    Route::get('/list', [PropertyController::class, 'listProperties'])->middleware('auth:sanctum');
});


Route::prefix('v1/catalogs')->group(function (){
    Route::get('/rent-type/list', [CatalogsController::class, 'getRentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/payment-type/list', [CatalogsController::class, 'getPaymentTypeCatalog'])->middleware('auth:sanctum');
    Route::get('/document-type/list', [CatalogsController::class, 'getDocumentTypeCatalog'])->middleware('auth:sanctum');
});

