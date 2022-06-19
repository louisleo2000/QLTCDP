<?php

use App\DataTables\ScheduleDataTable;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ChildController;
use App\Http\Controllers\api\v1\ParentController;
use App\Http\Controllers\api\v1\ScheduleController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::middleware('auth:api')->get('/me', [AuthController::class, 'me']);
    Route::middleware('auth:api')->get('/logout', [AuthController::class, 'logout']);
    Route::post('/forgot-password',  [PasswordResetLinkController::class, 'store'])->middleware('guest:api');
});
Route::prefix('/child')->group(function () {
    Route::middleware('auth:api')->get('/all', [ChildController::class,'index'])->name('all');
    Route::middleware('auth:api')->get('/del/{id}', [ChildController::class,'del'])->name('del');
    Route::middleware('auth:api')->post('/add', [ChildController::class,'create']);
    Route::middleware('auth:api')->get('/my-child', [ChildController::class,'getMy']);
    // Route::post('/parent', [ParentController::class,'store']);
});

Route::prefix('/schedule')->group(function () {
    Route::middleware('auth:api')->get('/all', [ScheduleController::class,'indexAPI'])->name('all');
    // Route::post('/parent', [ParentController::class,'store']);
});