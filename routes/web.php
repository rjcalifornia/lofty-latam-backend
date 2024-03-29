<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('/account/verify/{token}', [UsersController::class, 'verifyAccount'])->name('verify-account'); 


Route::view('/swagger', 'swagger');