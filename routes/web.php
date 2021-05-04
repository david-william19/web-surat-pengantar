<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

include __DIR__.'/user_admin.php';

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


Auth::routes();


Route::redirect('/','/login/admin');

Route::view('login/admin','auth.login_admin');

Route::view('registrasi/kepala-keluarga','MyAuthController@viewRegisterKK');

Route::post('/login/admin/proc', 'Auth\LoginController@adminLogin')->name('login-admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
