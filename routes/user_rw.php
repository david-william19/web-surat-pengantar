<?php

use Illuminate\Support\Facades\Route;


Route::get('/rw','RWHomeController@home');

Route::get('rw/{id}/keluarga','RWController@viewListKeluarga');
Route::get('/rw/{id}/getKeluargaAjax', 'RWController@getKeluargaAjax');
Route::get('/rw/ganti-password', 'RWController@viewChangePassword');


#Bisa Diakses Admin Juga Ini
Route::get('/rw/{id}/rt-anggota', 'RWController@viewMember');

Route::get('/rw/{id}/ganti-password', 'RWController@viewChangePassword');
Route::post('/rw/{id}/ganti-password', 'RWController@changePassword');

Route::get('/rw/{id}/surat-pengantar', 'SuratController@viewTrackingByRW');

Route::get('/list_keluarga','RWController@listKeluarga');
