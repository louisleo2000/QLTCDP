<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/all-user', [UserController::class,'index'])->name('all-user');

Route::get('/show-user/{id}', [UserController::class,'show']);

Route::post('/login', [UserController::class,'login']);

Route::post('/signup', [UserController::class,'store']);

Route::get('/all-child', [ChildController::class,'index'])->name('all-child');
Route::get('/del-child/{id}', [ChildController::class,'del'])->name('del-child');

Route::post('/add-child', [ChildController::class,'create']);
Route::get('/my-child/{id}', [ChildController::class,'getMy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/file', [FileController::class,'store']);
