<?php

use App\Http\Controllers\ordersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/orders', [ordersController::class,'index']);
Route::post('/orders', [ordersController::class,'store']);

Route::get('/change_status/{order_id}/{status}', [ordersController::class,'changeStatus']);

// Route::resource('drivers' , [DriversController::class]);

