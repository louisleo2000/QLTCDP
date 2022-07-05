<?php

use App\Http\Controllers\api\v1\ChildController;
use App\Http\Controllers\api\v1\MedicalStaffController;
use App\Http\Controllers\api\v1\ParentController;
use App\Http\Controllers\api\v1\ScheduleController;
use App\Http\Controllers\api\v1\VaccinationDetailsController;
use App\Http\Controllers\ChildrentController;
use App\Http\Controllers\OAuthGGController;
use App\Http\Controllers\ParentAdminController;
use App\Http\Controllers\VaccineController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth:web','admin:web'])->name('home');

Route::get('/ouauth', [OAuthGGController::class,'index'])->name('oauth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web','admin:web'])->name('dashboard');


// Route::get('/childrent', [ChildController::class,'indexWeb'])->middleware(['auth:web','admin:web'])->name('child');
// Route::get('/allchild', [ChildController::class,'getAllChild'])->middleware(['auth:web','admin:web'])->name('child.all');

// Route::get('/vaccine', [VaccineController::class,'index'])->middleware(['auth:web','admin:web'])->name('vaccine');
// Route::get('/allvaccine', [VaccineController::class,'getAllVaccine'])->middleware(['auth:web','admin:web'])->name('vaccine.all');
// Route::post('/addvaccine', [VaccineController::class,'store'])->middleware(['auth:web','admin:web'])->name('vaccine.store');
// Route::get('/delvaccine/{id}', [VaccineController::class,'delete'])->middleware(['auth:web','admin:web'])->name('vaccine.delete');

// Route::get('/schedule', [ScheduleController::class,'index'])->middleware(['auth:web','admin:web'])->name('schedule');
// Route::get('/allschedule', [ScheduleController::class,'getSchedule'])->middleware(['auth:web','admin:web'])->name('schedule.all');
// Route::post('/addschedule', [ScheduleController::class,'store'])->middleware(['auth:web','admin:web'])->name('schedule.store');
// Route::get('/delschedule/{id}', [ScheduleController::class,'delete'])->middleware(['auth:web','admin:web'])->name('schedule.delete');

Route::get('/parent', [ParentController::class,'index'])->middleware(['auth:web','admin:web'])->name('parent');
Route::post('/addparent', [ParentController::class,'store'])->middleware(['auth:web','admin:web'])->name('parent.store');
Route::get('/allparent', [ParentController::class,'getAllParents'])->middleware(['auth:web','admin:web'])->name('parent.all');

Route::resource('schedule', ScheduleController::class)->middleware(['auth:web','admin:web']);
Route::resource('vaccinationdetails', VaccinationDetailsController::class)->middleware(['auth:web','admin:web']);
Route::resource('childrent', ChildrentController::class)->middleware(['auth:web','admin:web']);
Route::resource('parentadmin', ParentAdminController::class)->middleware(['auth:web','admin:web']);
Route::resource('medicalstaff', MedicalStaffController::class)->middleware(['auth:web','admin:web']);
Route::resource('vaccine', VaccineController::class)->middleware(['auth:web','admin:web']);
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
require __DIR__.'/auth.php';
