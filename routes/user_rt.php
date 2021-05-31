<?php

use Illuminate\Support\Facades\Route;


//nanti dikasih middleware, hehe, sekarang belom -Henry

Route::group(['middleware' => ['rt']], function () {

    Route::get('/rt','RTHomeController@home');
    Route::get('rt/{id}/keluarga','RTController@viewListKeluarga');
    Route::get('/rt/{id}/getKeluargaAjax', 'RTController@getKeluargaAjax');
    Route::get('/rt/{id}/ganti-password', 'RTController@viewChangePassword');
    Route::post('/rt/{id}/ganti-password', 'RTController@changePassword');
    Route::get('/list_keluarga','RTController@listKeluarga');

    Route::get('/rt/{id}/surat-pengantar', 'SuratController@viewTrackingByRT');

});



