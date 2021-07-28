<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Car CRUD
Route::get('/cars',[CarController::class,'index']);
Route::post('/cars',[CarController::class,'store']);
Route::get('/cars/{id}',[CarController::class,'show']);
Route::put('/carsupdate/{id}',[CarController::class,'update']);
Route::delete('/carsdelete/{id}',[CarController::class,'destroy']);
Route::get('/money',[CarController::class,'money']);
Route::get('/convertCurrency',[CarController::class,'convertCurrency']);


//Category CRUD
Route::resource('/category', CategoryController::class);
Route::get('/category/{id}',[CategoryController::class,'show']);
Route::put('/categoryupdate/{id}',[CategoryController::class,'update']);
Route::delete('/categorydelete/{id}',[CategoryController::class,'destroy']);



