<?php
Route::get('/', 'HomeController@index');
Route::get('/setting','HomeController@setting');
Route::post('/setting','HomeController@upsetting');

Route::get('register/dich_vu_luu_tru','HomeController@regdvlt');
Route::get('checkrgmasothue','HomeController@checkrgmasothue');
Route::get('checkrguser','HomeController@checkrguser');
Route::post('register/dich_vu_luu_tru','HomeController@regdvltstore');

Route::get('register/dich_vu_van_tai','HomeController@regdvvt');

Route::post('register/dich_vu_van_tai','HomeController@regdvvtstore');

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
Route::get('users/register/pl={pl}','UsersController@register');
Route::get('users/register/{id}/show','UsersController@registershow');
Route::post('register/createdvlt','UsersController@registerdvlt');
Route::post('register/createdvvt','UsersController@registerdvvt');
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
    //Ajax ttphong create
Route::get('ttphong/store','CsKdDvLtController@ttphongstore');
Route::get('ttphong/edit','CsKdDvLtController@ttphongedit');
Route::get('ttphong/update','CsKdDvLtController@ttphongupdate');
Route::get('ttphong/delete','CsKdDvLtController@ttphongdelete');
    //End Ajax ttphong create
Route::post('ttcskd_dich_vu_luu_tru','CsKdDvLtController@store');

Route::get('ttcskd_dich_vu_luu_tru/{id}/edit','CsKdDvLtController@edit');
    //Ajax ttphong edit
Route::get('ttphong/themmoi','CsKdDvLtController@ttphongthemmoi');
Route::get('ttphong/chinhsua','CsKdDvLtController@ttphongchinhsua');
Route::get('ttphong/capnhat','CsKdDvLtController@ttphongcapnhat');
Route::get('ttphong/xoa','CsKdDvLtController@ttphongxoa');
    //End Ajax ttphongedit
Route::patch('ttcskd_dich_vu_luu_tru/{id}','CsKdDvLtController@update');
Route::post('ttcskd_dich_vu_luu_tru/delete','CsKdDvLtController@destroy');

//Kê khai giá dịch vụ lưu trú
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh','KkGDvLtController@cskd');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}&nam={nam}','KkGDvLtController@index');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}/create','KkGDvLtController@create');
    //Ajax ttphong create
Route::get('/kkgdvlt/kkgia','KkGDvLtCtDfController@kkgia');
Route::get('/kkgdvlt/upkkgia','KkGDvLtCtDfController@upkkgia');
Route::get('kkgdvlt/storettp','KkGDvLtCtDfController@storettp');
Route::get('kkgdvlt/editttp','KkGDvLtCtDfController@editttp');
Route::get('kkgdvlt/update','KkGDvLtCtDfController@updatettp');
Route::get('kkgdvlt/delete','KkGDvLtCtDfController@destroy');
    //End Ajax ttphong create
Route::post('ke_khai_dich_vu_luu_tru','KkGDvLtController@store');
Route::get('ke_khai_dich_vu_luu_tru/{id}/edit','KkGDvLtController@edit');
    //Ajax ttphong edit
Route::get('/kkgdvlt/boxungttp','KkGDvLtCtController@boxungttp');
Route::get('/kkgdvlt/kkgiachinhsua','KkGDvLtCtController@kkgiachinhsua');
Route::get('/kkgdvlt/capnhatkkgia','KkGDvLtCtController@capnhatkkgia');
Route::get('/kkgdvlt/chinhsuattp','KkGDvLtCtController@chinhsuattp');
Route::get('/kkgdvlt/capnhatttp','KkGDvLtCtController@capnhatttp');
Route::get('/kkgdvlt/xoattp','KkGDvLtCtController@xoattp');
    //End Ajax ttphong edit
Route::patch('ke_khai_dich_vu_luu_tru/{id}','KkGDvLtController@update');
Route::post('ke_khai_dich_vu_luu_tru/chuyen','KkGDvLtController@chuyen');
Route::get('/kkgdvlt/viewlydo','KkGDvLtController@viewlydo');
Route::post('ke_khai_dich_vu_luu_tru/delete','KkGDvLtController@destroy');

    //Xét duyệt kê khai
Route::get('xet_duyet_ke_khai_dich_vu_luu_tru/thang={thang}&nam={nam}&pl={pl}','KkGDvLtXdController@index');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/tralai','KkGDvLtXdController@tralai');
Route::get('/xdkkgiadvlt/nhanhs','KkGDvLtXdController@getTTnHs');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/nhanhs','KkGDvLtXdController@nhanhs');
Route::get('/xdkkgiadvlt/nhanhsedit','KkGDvLtXdController@getTTnHsedit');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/nhanhsedit','KkGDvLtXdController@updatettnhs');
    //End xét duyệt kê khai
    //Search kê khai
Route::get('search_ke_khai_dich_vu_luu_tru','KkGDvLtController@search');
Route::get('search_ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}&namhs={nam}','KkGDvLtController@viewsearch');
    //End search kê khai
    //Print Kê khai
Route::get('ke_khai_dich_vu_luu_tru/report_ke_khai/{mahs}','ReportsController@kkgdvlt');
//End kê khai giá dịch vụ lưu trú


//End Thông tin CSKD
    //End Dịch vụ lưu trú


    //Dịch vụ vận tải
Route::group(['prefix'=>'dich_vu_van_tai'],function(){
    //Thông tin đơn vi
    Route::group(['prefix'=>'thong_tin_don_vi'],function(){
        Route::get('', 'DonViDvVtController@TtDnIndex');
        Route::get('{id}/edit', 'DonViDvVtController@TtDnedit');
        Route::patch('{id}/update', 'DonViDvVtController@TtDnupdate');
    });
    //End Thông tin đơn vị

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe khách--">
    Route::group(['prefix'=>'dich_vu_xe_khach'],function(){
        //Danh mục dịch vụ
        Route::get('danh_muc','DmDvVtXkController@index');
        Route::get('adddm','DmDvVtXkController@AddDM');
        Route::get('deldm','DmDvVtXkController@destroy');

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('','KkDvVtXkController@index');
            Route::get('edit/{id}','KkDvVtXkController@edit');
            Route::get('create','KkDvVtXkController@create');
            Route::patch('store','KkDvVtXkController@store');
            Route::patch('update/{id}','KkDvVtXkController@update');
            Route::get('getpag_temp', 'KkDvVtXkController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXkController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXkController@getpag');
            Route::get('updatepag', 'KkDvVtXkController@updatepag');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXkController@destroy');
            Route::get('chuyen', 'KkDvVtXkController@chuyen');
            Route::get('updategiadv', 'KkDvVtXkController@updategiadv');
            Route::get('updategiadvct', 'KkDvVtXkController@updategiadvct');
            Route::get('nhanhs', 'KkDvVtXkController@nhanhs');
        });

        //Xét duyệt dịch vụ xe khách - giao diện sở -
        Route::group(['prefix'=>'xet_duyet'],function() {
            Route::get('/thang={thang}&nam={nam}&pl={pl}','KkDvVtXkController@indexXD');
            Route::get('duyet','KkDvVtXkController@accept');
            Route::get('tra_lai','KkDvVtXkController@tralai');
            //Route::get('search','KkDvVtXkController@search');
        //End Xét duyệt
        });
        //Tìm kiếm
        Route::group(['prefix'=>'tim_kiem'],function() {
            Route::get('/masothue={masothue}&nam={nam}','KkDvVtXkController@search');
            //Route::get('ket_qua','KkDvVtXkController@getsearch');
        });
        //Printf
        Route::get('in/{masokk}','KkDvVtXkController@printKK');
        Route::get('inPAG/{masokk}','KkDvVtXkController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe buýt--">
    Route::group(['prefix'=>'dich_vu_xe_bus'],function(){
        //Danh mục dịch vụ
        Route::get('danh_muc','DmDvVtXbController@index');
        Route::get('adddm','DmDvVtXbController@AddDM');
        Route::get('deldm','DmDvVtXbController@destroy');

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('','KkDvVtXbController@index');
            Route::get('edit/{id}','KkDvVtXbController@edit');
            Route::get('create','KkDvVtXbController@create');
            Route::patch('store','KkDvVtXbController@store');
            Route::patch('update/{id}','KkDvVtXbController@update');
            Route::get('getpag_temp', 'KkDvVtXbController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXbController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXbController@getpag');
            Route::get('updatepag', 'KkDvVtXbController@updatepag');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXbController@destroy');
            Route::get('chuyen', 'KkDvVtXbController@chuyen');
            Route::get('updategiadv', 'KkDvVtXbController@updategiadv');
            Route::get('updategiadvct', 'KkDvVtXbController@updategiadvct');
            Route::get('nhanhs', 'KkDvVtXbController@nhanhs');
        });

        //Xét duyệt dịch vụ xe khách - giao diện sở -
        Route::group(['prefix'=>'xet_duyet'],function() {
            Route::get('/thang={thang}&nam={nam}&pl={pl}','KkDvVtXbController@indexXD');
            Route::get('duyet','KkDvVtXbController@accept');
            Route::get('tra_lai','KkDvVtXbController@tralai');
            //Route::get('search','KkDvVtXkController@search');
            //End Xét duyệt
        });
        //Tìm kiếm
        Route::group(['prefix'=>'tim_kiem'],function() {
            Route::get('/masothue={masothue}&nam={nam}','KkDvVtXbController@search');
            //Route::get('ket_qua','KkDvVtXkController@getsearch');
        });
        //Printf
        Route::get('in/{masokk}','KkDvVtXbController@printKK');
        Route::get('inPAG/{masokk}','KkDvVtXbController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe taxi--">
    Route::group(['prefix'=>'dich_vu_xe_taxi'],function(){
        //Danh mục dịch vụ
        Route::get('danh_muc','DmDvVtXtxController@index');
        Route::get('adddm','DmDvVtXtxController@AddDM');
        Route::get('deldm','DmDvVtXtxController@destroy');

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('','KkDvVtXtxController@index');
            Route::get('edit/{id}','KkDvVtXtxController@edit');
            Route::get('create','KkDvVtXtxController@create');
            Route::patch('store','KkDvVtXtxController@store');
            Route::patch('update/{id}','KkDvVtXtxController@update');
            Route::get('getpag_temp', 'KkDvVtXtxController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXtxController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXtxController@getpag');
            Route::get('updatepag', 'KkDvVtXtxController@updatepag');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXtxController@destroy');
            Route::get('chuyen', 'KkDvVtXtxController@chuyen');
            Route::get('updategiadv', 'KkDvVtXtxController@updategiadv');
            Route::get('updategiadvct', 'KkDvVtXtxController@updategiadvct');
            Route::get('nhanhs', 'KkDvVtXtxController@nhanhs');
        });

        //Xét duyệt dịch vụ xe khách - giao diện sở -
        Route::group(['prefix'=>'xet_duyet'],function() {
            Route::get('/thang={thang}&nam={nam}&pl={pl}','KkDvVtXtxController@indexXD');
            Route::get('duyet','KkDvVtXtxController@accept');
            Route::get('tra_lai','KkDvVtXtxController@tralai');
            //Route::get('search','KkDvVtXkController@search');
            //End Xét duyệt
        });
        //Tìm kiếm
        Route::group(['prefix'=>'tim_kiem'],function() {
            Route::get('/masothue={masothue}&nam={nam}','KkDvVtXtxController@search');
            //Route::get('ket_qua','KkDvVtXkController@getsearch');
        });
        //Printf
        Route::get('in/{masokk}','KkDvVtXtxController@printKK');
        Route::get('inPAG/{masokk}','KkDvVtXtxController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải chở hàng--">
    Route::group(['prefix'=>'dich_vu_cho_hang'],function(){
        //Danh mục dịch vụ
        Route::get('danh_muc','DmDvVtKhacController@index');
        Route::get('adddm','DmDvVtKhacController@AddDM');
        Route::get('deldm','DmDvVtKhacController@destroy');

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('','KkDvVtKhacController@index');
            Route::get('edit/{id}','KkDvVtKhacController@edit');
            Route::get('create','KkDvVtKhacController@create');
            Route::patch('store','KkDvVtKhacController@store');
            Route::patch('update/{id}','KkDvVtKhacController@update');
            Route::get('getpag_temp', 'KkDvVtKhacController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtKhacController@updatepag_temp');
            Route::get('getpag', 'KkDvVtKhacController@getpag');
            Route::get('updatepag', 'KkDvVtKhacController@updatepag');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtKhacController@destroy');
            Route::get('chuyen', 'KkDvVtKhacController@chuyen');
            Route::get('updategiadv', 'KkDvVtKhacController@updategiadv');
            Route::get('updategiadvct', 'KkDvVtKhacController@updategiadvct');
            Route::get('nhanhs', 'KkDvVtKhacController@nhanhs');
        });

        //Xét duyệt dịch vụ xe khách - giao diện sở -
        Route::group(['prefix'=>'xet_duyet'],function() {
            Route::get('/thang={thang}&nam={nam}&pl={pl}','KkDvVtKhacController@indexXD');
            Route::get('duyet','KkDvVtKhacController@accept');
            Route::get('tra_lai','KkDvVtKhacController@tralai');
            //Route::get('search','KkDvVtXkController@search');
            //End Xét duyệt
        });
        //Tìm kiếm
        Route::group(['prefix'=>'tim_kiem'],function() {
            Route::get('/masothue={masothue}&nam={nam}','KkDvVtKhacController@search');
            //Route::get('ket_qua','KkDvVtXkController@getsearch');
        });
        //Printf
        Route::get('in/{masokk}','KkDvVtKhacController@printKK');
        Route::get('inPAG/{masokk}','KkDvVtKhacController@printPAG');
    });
    // </editor-fold>
});

    //Báo cáo dịch vụ vận tải
Route::group(['prefix'=>'bao_cao'],function(){
    //Xe khách
    Route::group(['prefix'=>'dich_vu_xe_khach'],function(){
        Route::get('','ReportsDvVtController@indexxk');
        Route::post('BC1','ReportsDvVtController@dvxkbc1');
        Route::post('BC2','ReportsDvVtController@dvxkbc2');
    });
    //
    //Xe buýt
    Route::group(['prefix'=>'dich_vu_xe_bus'],function(){
        Route::get('','ReportsDvVtController@indexxb');
        Route::post('BC1','ReportsDvVtController@dvxbbc1');
        Route::post('BC2','ReportsDvVtController@dvxbbc2');
    });
    //
    //Xe taxi
    Route::group(['prefix'=>'dich_vu_xe_taxi'],function(){
        Route::get('','ReportsDvVtController@indexxtx');
        Route::post('BC1','ReportsDvVtController@dvxtxbc1');
        Route::post('BC2','ReportsDvVtController@dvxtxbc2');
    });
    //
    //Chở hàng
    Route::group(['prefix'=>'dich_vu_cho_hang'],function(){
        Route::get('','ReportsDvVtController@indexch');
        Route::post('BC1','ReportsDvVtController@dvchbc1');
        Route::post('BC2','ReportsDvVtController@dvchbc2');
    });
    //
});
    //End Dịch vụ vận tải
// </editor-fold>//End Manage



