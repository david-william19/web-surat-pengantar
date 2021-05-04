<?php

use Illuminate\Support\Facades\Route;


Route::get('/keluarga', 'KeluargaController@dashboard');
Route::get('/member/getAnggotaAjax', 'KeluargaController@getAnggotaAjax');

Route::get('/member/{id}/edit','KeluargaController@viewEdit');
Route::post('/member/{id}/update','KeluargaController@updateMember');
Route::delete('/member/{id}/deleteAjax','KeluargaController@deleteMemberAjax');

Route::group(['prefix' => 'keluarga', 'middleware' => ['keluarga']], function () {


    Route::post('changeKKPhoto', 'KeluargaController@changeKKPhoto');
    Route::post('updateData', 'KeluargaController@keluargaUpdate');
    
    Route::get('/member/tambah', 'KeluargaController@viewAddMember');
    Route::get('/member/manage', 'KeluargaController@viewManageMember');
    Route::post('/member/simpan', 'KeluargaController@storeMember');



    Route::get('/news/create', 'NewsController@viewAdminCreate');
    Route::get('/news/manage', 'NewsController@viewAdminManage');
    Route::post('/news/manage', 'NewsController@viewAdminManage');

    Route::post('/rw/insertAjax', 'RWAdminController@insertAjax');
    Route::delete('/rw/{id}/delete', 'RWAdminController@deleteAjax');
    Route::get('/rw/manage', 'RWAdminController@viewAdminManage');

    Route::post('/rt/insertAjax', 'RTAdminController@insertAjax');
    Route::delete('/rt/{id}/delete', 'RTAdminController@deleteAjax');
    Route::get('/rt/manage', 'RTAdminController@viewAdminManage');
});
