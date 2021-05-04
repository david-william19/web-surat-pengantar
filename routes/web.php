<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

include __DIR__.'/user_admin.php';
include __DIR__.'/user_keluarga.php';

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
Route::view('login','auth.login');

Route::get('registrasi/keluarga','MyAuthController@viewRegisterKK');
Route::post('registrasi/kepala-keluarga/proceed','KeluargaController@keluargaRegister');



Route::post('/login/admin/proc', 'Auth\LoginController@adminLogin')->name('login-admin');
Route::post('/login/proc', 'Auth\LoginController@checkLogin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
