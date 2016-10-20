<?php
Route::get('/', 'HomeController@index');
Route::get('/setting','HomeController@setting');
Route::post('/setting','HomeController@upsetting');

// <editor-fold defaultstate="collapsed" desc="--Setting--">
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
//EndUsers

//DN Dịch vụ lưu trú
Route::get('dn_dichvu_luutru','DnDvLtController@index');
Route::get('dn_dichvu_luutru/create','DnDvLtController@create');
Route::post('dn_dichvu_luutru','DnDvLtController@store');
Route::get('dn_dichvu_luutru/{id}/edit','DnDvLtController@edit');
Route::patch('dn_dichvu_luutru/{id}','DnDvLtController@update');
Route::post('dn_dichvu_luutru/delete','DnDvLtController@destroy');
//End DN Dịch vụ lưu trú

//DN Dịch vụ vận tải
Route::get('dn_dichvu_vantai','DonViDvVtController@index');
Route::get('dn_dichvu_vantai/create','DonViDvVtController@create');
Route::post('dn_dichvu_vantai','DonViDvVtController@store');
Route::get('dn_dichvu_vantai/{id}/edit','DonViDvVtController@edit');
Route::patch('dn_dichvu_vantai/{id}','DonViDvVtController@update');
Route::post('dn_dichvu_vantai/delete','DonViDvVtController@destroy');
//End Dn Dịch vụ vận tải
// </editor-fold>//End Setting

// <editor-fold defaultstate="collapsed" desc="--Báo cáo--">
//Reports
    //Dịch vụ lưu trú
Route::get('reports/dich_vu_luu_tru', function() {
    return view('reports.kkgdvlt.bcth.index')
        ->with('pageTitle', 'Báo cáo tổng hợp dịch vụ lưu trú');
});
Route::post('reports/dich_vu_luu_tru/BC1','ReportsController@dvltbc1');
Route::post('reports/dich_vu_luu_tru/BC2','ReportsController@dvltbc2');
    //End Dịch vụ lưu trú
    //Dịch vụ vận tải
    //End Dịch vụ vận tải

// </editor-fold>//End Reports

// <editor-fold defaultstate="collapsed" desc="--Quản lý--">

    //Dịch vụ luu trú
//Thông tin doanh nghiệp
Route::get('ttdn_dich_vu_luu_tru','DnDvLtController@ttdn');
Route::get('ttdn_dich_vu_luu_tru/{id}/edit','DnDvLtController@ttdnedit');
Route::patch('ttdn_dich_vu_luu_tru/{id}','DnDvLtController@ttdnupdate');
//End Thông tin doanh nghiệp
//Thông tin CSKD
Route::get('ttcskd_dich_vu_luu_tru','CsKdDvLtController@index');
Route::get('ttcskd_dich_vu_luu_tru/create','CsKdDvLtController@create');
Route::post('ttcskd_dich_vu_luu_tru','CsKdDvLtController@store');

Route::get('ttphong/store','CsKdDvLtController@ttphongstore');
Route::get('ttphong/edit','CsKdDvLtController@ttphongedit');
Route::get('ttphong/update','CsKdDvLtController@ttphongupdate');
Route::get('ttphong/delete','CsKdDvLtController@ttphongdelete');

Route::get('ttcskd_dich_vu_luu_tru/{id}/edit','CsKdDvLtController@ttdnedit');
Route::patch('ttcskd_dich_vu_luu_tru/{id}','CsKdDvLtController@ttdnupdate');
//End Thông tin CSKD
    //End Dịch vụ lưu trú
    //Dịch vụ vận tải
        //Vận tải xe khách
        //End Vận tải xe khách
        //Vận tải xe buýt
        //End Vận tải xe buýt
        //Vận tải taxi
        //End Vạn tải taxi
        //Vận tải chở hàng
        //End Vận tải chở hàng
    //End Dịch vụ vận tải

// </editor-fold>//End Manage



