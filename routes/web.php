<?php
Route::get('/', 'HomeController@index');
Route::get('/setting','HomeController@setting');
Route::post('/setting','HomeController@upsetting');

Route::get('cau_hinh_he_thong','GeneralConfigsController@index');
Route::get('cau_hinh_he_thong/{id}/edit','GeneralConfigsController@edit');
Route::patch('cau_hinh_he_thong/{id}','GeneralConfigsController@update');
//Users
Route::get('login','UsersController@login');
Route::post('signin','UsersController@signin');
Route::get('/change-password','UsersController@cp');
Route::post('/change-password','UsersController@cpw');
Route::get('/checkpass','UsersController@checkpass');
Route::get('/checkuser','UsersController@checkuser');
Route::get('/checkmasothue','UsersController@checkmasothue');
Route::get('logout','UsersController@logout');
Route::get('users/pl={pl}','UsersController@index');
Route::get('users/{id}/edit','UsersController@edit');
Route::patch('users/{id}','UsersController@update');
Route::get('users/{id}/phan-quyen','UsersController@permission');
Route::post('users/phan-quyen','UsersController@uppermission');
Route::post('users/delete','UsersController@destroy');
Route::get('users/lock/{id}','UsersController@lockuser');
Route::get('users/unlock/{id}','UsersController@unlockuser');


Route::get('dn_dichvu_luutru','DnDvLtController@index');
Route::get('dn_dichvu_luutru/create','DnDvLtController@create');
Route::post('dn_dichvu_luutru','DnDvLtController@store');
Route::get('dn_dichvu_luutru/{id}/edit','DnDvLtController@edit');
Route::patch('dn_dichvu_luutru/{id}','DnDvLtController@update');
Route::post('dn_dichvu_luutru/delete','DnDvLtController@destroy');

Route::get('dn_dichvu_vantai','DonViDvVtController@index');
Route::get('dn_dichvu_vantai/create','DonViDvVtController@create');
Route::post('dn_dichvu_vantai','DonViDvVtController@store');
Route::get('dn_dichvu_vantai/{id}/edit','DonViDvVtController@edit');
Route::patch('dn_dichvu_vantai/{id}','DonViDvVtController@update');
Route::post('dn_dichvu_vantai/delete','DonViDvVtController@destroy');

//EndUsers



