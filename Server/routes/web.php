<?php

use App\Http\Controllers\api\v1\ChildController;
use App\Http\Controllers\api\v1\ParentController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web','role:web'])->name('dashboard');

Route::get('/childrent', [ChildController::class,'indexWeb'])->middleware(['auth:web','role:web'])->name('child');
Route::get('/parent', [ParentController::class,'index'])->middleware(['auth:web','role:web'])->name('parent');
Route::post('/addparent', [ParentController::class,'store'])->middleware(['auth:web','role:web'])->name('parent.store');
Route::get('/allchild', [ChildController::class,'getAllChild'])->middleware(['auth:web','role:web'])->name('child.all');
Route::get('/allparent', [ParentController::class,'getAllParents'])->middleware(['auth:web','role:web'])->name('parent.all');
require __DIR__.'/auth.php';
