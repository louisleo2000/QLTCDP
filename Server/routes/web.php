<?php

use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
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
});
Route::get('/send-mail', function () {
   
    $details = [
        'title' => 'Mail từ Quản lý tiêm chủng',
        'body' => 'Đây là mail test từ Quản lý tiêm chủng'
    ];
   
    Mail::to('hoangtugio579@gmail.com')->send(new RegisterMail($details));
   
    dd("Email is Sent.");
});
