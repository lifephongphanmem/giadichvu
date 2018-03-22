<?php
Route::get('/ajax/checkngay','AjaxController@checkngay');
Route::get('/ajax/checkngaykk','AjaxController@checkngaykk');

Route::get('/test', 'MailController@test_mail');
Route::get('/testday','MailController@testday');
Route::post('/testday','MailController@testdaysm');

// <editor-fold defaultstate="collapsed" desc="--Hệ thống-Đăng ký--">
Route::get('/', 'HomeController@index');
Route::get('/setting','HomeController@setting');
Route::post('/setting','HomeController@upsetting');

Route::get('register/dich_vu_luu_tru','HomeController@regdvlt');
Route::get('checkrgmasothue','HomeController@checkrgmasothue');
Route::get('checkrguser','HomeController@checkrguser');
Route::post('register/dich_vu_luu_tru','HomeController@regdvltstore');

Route::get('register/dich_vu_van_tai','HomeController@regdvvt');

Route::post('register/dich_vu_van_tai','HomeController@regdvvtstore');
Route::get('forgot_password','HomeController@forgotpassword');
Route::post('forgot_password','HomeController@forgotpasswordw');
Route::get('register/tra_lai','HomeController@regdverror');

Route::get('dangkydichvugiasua','HomeController@dangkydvgs');
Route::post('dangkydichvugiasua','HomeController@dangkydvgsstore');

Route::get('dangkydichvuthucanchannuoi','HomeController@dangkydvtacn');
Route::post('dangkydichvuthucanchannuoi','HomeController@dangkydvtacnstore');


Route::get('search_register','HomeController@searchregister');
Route::post('search_register','HomeController@checksearchregister');
Route::get('search_register/show','HomeController@show');
Route::post('search_register/show','HomeController@edit');
Route::patch('register_editdvlt/id={id}','HomeController@updatedvlt');
Route::patch('register_editdvvt/id={id}','HomeController@updatedvvt');
Route::patch('register_editdvgs/id={id}','HomeController@updatedvgs');
Route::patch('register_editdvtacn/id={id}','HomeController@updatedvtacn');


// </editor-fold>//End Hệ thống- Đăng ký

// <editor-fold defaultstate="collapsed" desc="--Setting--">
Route::get('cau_hinh_he_thong','GeneralConfigsController@index');
Route::get('cau_hinh_he_thong/create','GeneralConfigsController@create');
Route::post('cau_hinh_he_thong','GeneralConfigsController@store');
Route::get('cau_hinh_he_thong/{id}/edit','GeneralConfigsController@edit');
Route::patch('cau_hinh_he_thong/{id}','GeneralConfigsController@update');
//Route::get('xetduyet_thaydoi_thongtindoanhnghiep/phanloai={pl}','XdTdTtDnController@index');
//Route::get('xetduyet_thaydoi_thongtindoanhnghiep/{id}/show','XdTdTtDnController@show');
//Route::get('xetduyet_thaydoi_thongtindoanhnghiep/{id}/duyet','XdTdTtDnController@duyet');
//Route::post('xetduyet_thaydoi_thongtindoanhnghiep/tralai','XdTdTtDnController@tralai');
//Route::post('xetduyet_thaydoi_thongtindoanhnghiep/delete','XdTdTtDnController@del');

Route::resource('xetduyet_thaydoi_ttdoanhnghiep','XdTdTtDnController');
Route::get('xetduyet_thaydoi_ttdoanhnghiep/{id}/duyet','XdTdTtDnController@duyet');
Route::post('xetduyet_thaydoi_ttdoanhnghiep/tralai','XdTdTtDnController@tralai');

//Users
Route::get('login','UsersController@login');
Route::post('signin','UsersController@signin');
Route::get('/change-password','UsersController@cp');
Route::post('/change-password','UsersController@cpw');
Route::get('/user_setting','UsersController@settinguser');
Route::post('/user_setting','UsersController@settinguserw');
Route::get('/checkpass','UsersController@checkpass');
Route::get('/checkuser','UsersController@checkuser');
Route::get('/checkmasothue','UsersController@checkmasothue');
Route::get('logout','UsersController@logout');
Route::get('users','UsersController@index');
Route::get('users/{id}/edit','UsersController@edit');
Route::patch('users/{id}','UsersController@update');
Route::get('users/{id}/phan-quyen','UsersController@permission');
Route::post('users/phan-quyen','UsersController@uppermission');
Route::post('users/delete','UsersController@destroy');
Route::get('users/lock/{id}/{pl}','UsersController@lockuser');
Route::get('users/unlock/{id}/{pl}','UsersController@unlockuser');
Route::get('users/create','UsersController@create');
Route::post('users','UsersController@store');


Route::get('users/register','UsersController@register');
Route::get('users/register/{id}/show','UsersController@registershow');
Route::get('users/register/{id}/edit','UsersController@registeredit');
Route::patch('users/register/dvlt/{id}','UsersController@registerdvltupdate');
Route::patch('users/register/dvvt/{id}','UsersController@registerdvvtupdate');
Route::patch('users/register/dvgs/{id}','UsersController@registerdvgsupdate');
Route::patch('users/register/dvtacn/{id}','UsersController@registerdvtacnupdate');
Route::post('register/createdvlt','UsersController@registerdvlt');
Route::post('register/createdvvt','UsersController@registerdvvt');
Route::post('register/createdvgs','UsersController@registerdvgs');
Route::post('register/createdvtacn','UsersController@registerdvtacn');
Route::post('users/register/tralai','UsersController@tralaidktk');

Route::post('register/delete','UsersController@registerdelete');
Route::get('users/print/pl={pl}','UsersController@prints');

Route::resource('quanlytaikhoandangky','QlTkDkController');
//EndUsers

//DN Dịch vụ lưu trú
Route::get('dn_dichvu_luutru','DnDvLtController@index');
Route::get('dn_dichvu_luutru/create','DnDvLtController@create');
Route::post('dn_dichvu_luutru','DnDvLtController@store');
Route::get('dn_dichvu_luutru/{id}/edit','DnDvLtController@edit');
Route::patch('dn_dichvu_luutru/{id}','DnDvLtController@update');
Route::post('dn_dichvu_luutru/delete','DnDvLtController@destroy');
Route::get('dn_dichvu_luutru/print','DnDvLtController@prints');
//End DN Dịch vụ lưu trú

//DN Dịch vụ vận tải
Route::get('dn_dichvu_vantai','DonViDvVtController@index');
Route::get('dn_dichvu_vantai/create','DonViDvVtController@create');
Route::post('dn_dichvu_vantai','DonViDvVtController@store');
Route::get('dn_dichvu_vantai/{id}/edit','DonViDvVtController@edit');
Route::patch('dn_dichvu_vantai/{id}','DonViDvVtController@update');
Route::post('dn_dichvu_vantai/delete','DonViDvVtController@destroy');
Route::get('dn_dichvu_vantai/print','DonViDvVtController@prints');
//End Dn Dịch vụ vận tải

//DN Dịch vụ giá sữa
Route::resource('dn_dichvu_giasua','DnDvGsController');
Route::get('dn_dichvu_giasua/print','DnDvGsController@prints');
//End DN Dịch vụ giá sữa

//Dn Thức ăn chăn nuôi
Route::resource('dn_thuc_an_chan_nuoi','DnTaCnController');
//End Dn Thức ăn chăn nuôi

//DN cung cấp dịch vụ
Route::resource('doanhnghiepcungcapdichvu','DoanhNghiepCcDvController');

//DS Đơn vị quản lý
Route::resource('danh_muc_don_vi_quan_ly','DmDvQlController');
Route::get('/checkmaqhns','DmDvQlController@checkmaqhns');
Route::get('checktaikhoan','DmDvQlController@checktaikhoan');
Route::get('/checkuser','DmDvQlController@checkmaqhns');
Route::post('danh_muc_don_vi_quan_ly/delete','DmDvQlController@delete');
//End DS đơn vị quản lý
// </editor-fold>//End Setting

// <editor-fold defaultstate="collapsed" desc="--Báo cáo--">
//Reports
    //Dịch vụ lưu trú
Route::get('reports/dich_vu_luu_tru','ReportsController@index');
Route::post('reports/dich_vu_luu_tru/BC1','ReportsController@dvltbc1');
Route::post('reports/dich_vu_luu_tru/BC2','ReportsController@dvltbc2');
Route::post('reports/dich_vu_luu_tru/BC3','ReportsController@dvltbc3');
Route::post('reports/dich_vu_luu_tru/BC4','ReportsController@dvltbc4');
Route::post('reports/dich_vu_luu_tru/BC5','ReportsController@dvltbc5');
Route::post('reports/dich_vu_luu_tru/BC6','ReportsController@dvltbc6');

Route::post('reports/dich_vu_luu_tru/BC1_excel','ReportsController@dvltbc1_excel');
Route::post('reports/dich_vu_luu_tru/BC2_excel','ReportsController@dvltbc2_excel');
Route::post('reports/dich_vu_luu_tru/BC3_excel','ReportsController@dvltbc3_excel');
Route::post('reports/dich_vu_luu_tru/BC4_excel','ReportsController@dvltbc4_excel');
Route::post('reports/dich_vu_luu_tru/BC5_excel','ReportsController@dvltbc5_excel');
Route::post('reports/dich_vu_luu_tru/BC6_excel','ReportsController@dvltbc6_excel');
    //End Dịch vụ lưu trú
    //Dịch vụ vận tải
    //End Dịch vụ vận tải

// </editor-fold>//End Reports

// <editor-fold defaultstate="collapsed" desc="--Quản lý--">

    //Dịch vụ luu trú
//Thông tin doanh nghiệp
Route::get('ttdn_dich_vu_luu_tru','DnDvLtController@ttdn');
Route::get('ttdn_dich_vu_luu_tru/{id}/edit','DnDvLtController@ttdnedit');
Route::get('ttdn_dich_vu_luu_tru/{id}/chinhsua','DnDvLtController@ttdnchinhsua');
Route::patch('ttdn_dich_vu_luu_tru/{id}','DnDvLtController@ttdnupdate');
Route::patch('ttdn_dich_vu_luu_tru/df/{id}','DnDvLtController@ttdncapnhat');
Route::get('ttdn_dich_vu_luu_tru/{id}/chuyen','DnDvLtController@ttdnchuyen');
//End Thông tin doanh nghiệp
//Thông tin CSKD
Route::get('ttcskd_dich_vu_luu_tru','CsKdDvLtController@index');
Route::get('ttcskd_dich_vu_luu_tru/create','CsKdDvLtController@create');
    /*Form quản lý*/
Route::get('ttcskd_dich_vu_luu_tru/masothue={masothue}','CsKdDvLtController@showcskd');
Route::get('ttcskd_dich_vu_luu_tru/masothue={masothue}/create','CsKdDvLtController@createcskd');

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
//Đối tượng áp dụng
Route::get('doi_tuong_ap_dung','DoiTuongApDungDvLtController@cskd');
Route::get('doi_tuong_ap_dung/masothue={masothue}','DoiTuongApDungDvLtController@showcskd');
Route::get('doi_tuong_ap_dung/co_so_kinh_doanh={macskd}','DoiTuongApDungDvLtController@index');
Route::post('doi_tuong_ap_dung','DoiTuongApDungDvLtController@store');
Route::get('doi_tuong_ap_dung/edit','DoiTuongApDungDvLtController@edit');
Route::post('doi_tuong_ap_dung/update','DoiTuongApDungDvLtController@update');
Route::post('doi_tuong_ap_dung/delete','DoiTuongApDungDvLtController@delete');
//End đối tượng áp dụng

//Kê khai giá dịch vụ lưu trú
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh','KkGDvLtController@cskd');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}&nam={nam}','KkGDvLtController@index');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}/create','KkGDvLtController@create');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}/create_dk','KkGDvLtController@create_dk');//
Route::post('ke_khai_dich_vu_luu_tru/copy','KkGDvLtController@copy');
Route::get('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh={macskd}/copy','KkGDvLtController@saochep');

    //Ajax ttphong create
Route::get('/kkgdvlt/kkgia','KkGDvLtCtDfController@kkgia');
Route::get('/kkgdvlt/upkkgia','KkGDvLtCtDfController@upkkgia');
Route::get('kkgdvlt/storettp','KkGDvLtCtDfController@storettp');
Route::get('kkgdvlt/editttp','KkGDvLtCtDfController@editttp');
Route::get('kkgdvlt/update','KkGDvLtCtDfController@updatettp');
Route::get('kkgdvlt/delete','KkGDvLtCtDfController@destroy');
    //End Ajax ttphong create
Route::post('ke_khai_dich_vu_luu_tru','KkGDvLtController@store');
Route::post('ke_khai_dich_vu_luu_tru/store_dk','KkGDvLtController@store_dk');//
Route::get('ke_khai_dich_vu_luu_tru/{id}/edit','KkGDvLtController@edit');
Route::get('ke_khai_dich_vu_luu_tru/{id}/edit_dk','KkGDvLtController@edit_dk');//
Route::patch('ke_khai_dich_vu_luu_tru/{id}/update_dk','KkGDvLtController@update_dk');
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
Route::post('ke_khai_dich_vu_luu_tru/chuyenhscham','KkGDvLtController@chuyenhscham');
Route::get('/kkgdvlt/viewlydo','KkGDvLtController@viewlydo');
Route::get('/kkgdvlt/checkngay','KkGDvLtController@checkngay');
Route::post('ke_khai_dich_vu_luu_tru/delete','KkGDvLtController@destroy');

        //Kê khai lưu tru KS 45 sao
Route::get('ke_khai_dich_vu_luu_tru/khach_san={macskd}/create','KkGiaDvLt45sController@create');
Route::post('ke_khai_dich_vu_luu_tru/khach_san','KkGiaDvLt45sController@store');
Route::get('ke_khai_dich_vu_luu_tru/khach_san/{id}/edit','KkGiaDvLt45sController@edit');
Route::patch('ke_khai_dich_vu_luu_tru/khach_san/{id}','KkGiaDvLt45sController@update');
    //Ajax create
Route::get('/kkgdvlt45s/addttp','KkGiaDvLt45sCtDfController@addttp');
Route::get('/kkgdvlt45s/editttp','KkGiaDvLt45sCtDfController@editttp');
Route::get('/kkgdvlt45s/updatettp','KkGiaDvLt45sCtDfController@updatettp');
Route::get('/kkgdvlt45s/updatettp','KkGiaDvLt45sCtDfController@updatettp');
Route::get('/kkgdvlt45s/deletettp','KkGiaDvLt45sCtDfController@delete');
Route::get('/kkgdvlt45s/kkgia','KkGiaDvLt45sCtDfController@kkgia');
Route::get('/kkgdvlt45s/upkkgia','KkGiaDvLt45sCtDfController@upkkgia');
    //End Ajax create
    //Ajax edit
Route::get('/kkgdvlt45s/themttp','KkGiaDvLt45sCtController@addttp');
Route::get('/kkgdvlt45s/csttp','KkGiaDvLt45sCtController@editttp');
Route::get('/kkgdvlt45s/tdttp','KkGiaDvLt45sCtController@updatettp');
Route::get('/kkgdvlt45s/xoattp','KkGiaDvLt45sCtController@delete');
Route::get('/kkgdvlt45s/cskkgia','KkGiaDvLt45sCtController@kkgia');
Route::get('/kkgdvlt45s/tdkkgia','KkGiaDvLt45sCtController@upkkgia');
    //End Ajax edit

        //End Kê khai lưu trú KS 45 sao

    //Xét duyệt kê khai
//Route::get('xet_duyet_ke_khai_dich_vu_luu_tru/thang={thang}&nam={nam}&pl={pl}','KkGDvLtXdController@index');
Route::get('xet_duyet_ke_khai_dich_vu_luu_tru','KkGDvLtXdController@index');
Route::get('xdkkgiadvlt/tralai','KkGDvLtXdController@gettttralai');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/tralai','KkGDvLtXdController@tralai');
Route::get('/xdkkgiadvlt/nhanhs','KkGDvLtXdController@getTTnHs');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/nhanhs','KkGDvLtXdController@nhanhs');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/huyduyet','KkGDvLtXdController@huyduyet');
Route::get('/xdkkgiadvlt/tthuyduyet','KkGDvLtXdController@gettthuyduyet');
Route::get('/xdkkgiadvlt/nhanhsedit','KkGDvLtXdController@getTTnHsedit');
Route::post('xet_duyet_ke_khai_dich_vu_luu_tru/nhanhsedit','KkGDvLtXdController@updatettnhs');
Route::get('ke_khai_dich_vu_luu_tru/{mahs}/history', 'KkGDvLtXdController@history');
Route::get('ke_khai_dich_vu_luu_tru/history/mahsh={mahsh}', 'KkGDvLtXdController@showhis');
Route::get('ke_khai_dich_vu_luu_tru/historyks/mahsh={mahsh}', 'KkGDvLtXdController@showhis45s');

Route::get('ke_khai_dich_vu_luu_tru/{macskd}/hsdakk', 'KkGDvLtXdController@hsdakk');
    //End xét duyệt kê khai
    //Search kê khai
Route::get('search_ke_khai_dich_vu_luu_tru','KkGDvLtController@search');
//Route::get('search_ke_khai_dich_vu_luu_tru/doanh_nghiep={masothue}&co_so_kinh_doanh={macskd}&namhs={nam}','KkGDvLtController@viewsearch');
    //End search kê khai
    //Print Kê khai
Route::get('ke_khai_dich_vu_luu_tru/report_ke_khai/{mahs}','ReportsController@kkgdvlt');
Route::get('ke_khai_dich_vu_luu_tru/report_ke_khai/khach_san/{mahs}','ReportsController@kkgdvltks');
//End kê khai giá dịch vụ lưu trú


//End Thông tin CSKD
    //End Dịch vụ lưu trú


    //Dịch vụ vận tải
Route::group(['prefix'=>'dich_vu_van_tai'],function(){
    //Thông tin đơn vi
    Route::group(['prefix'=>'thong_tin_don_vi'],function(){
        Route::get('', 'DonViDvVtController@TtDnIndex');
        Route::get('{id}/edit', 'DonViDvVtController@TtDnedit');
        Route::get('{id}/chinhsua','DonViDvVtController@ttdnchinhsua');
        Route::patch('{id}/update', 'DonViDvVtController@TtDnupdate');
        Route::patch('{id}/capnhat', 'DonViDvVtController@ttdncapnhat');
    });
    //End Thông tin đơn vị

    //<editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải chở hàng--">
    Route::group(['prefix'=>'dich_vu_cho_hang'],function(){
        Route::group(['prefix'=>'danh_muc'],function(){
            Route::get('','DmDvVtKhacController@index');
            Route::get('/ma_so={masothue}','DmDvVtKhacController@show');
            Route::get('add','DmDvVtKhacController@add');
            Route::get('get','DmDvVtKhacController@get');
            Route::get('del','DmDvVtKhacController@destroy');
        });

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('/nam={nam}','KkDvVtKhacController@index');
            Route::get('edit/{id}','KkDvVtKhacController@edit');
            Route::get('create/ma_so={masothue}','KkDvVtKhacController@create');
            Route::patch('store','KkDvVtKhacController@store');
            Route::patch('update/{id}','KkDvVtKhacController@update');

            Route::get('don_vi/ma_so={masothue}','KkDvVtKhacController@show');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtKhacController@destroy');
            Route::get('chuyen', 'KkDvVtKhacController@chuyen');
            Route::get('nhanhs', 'KkDvVtKhacController@nhanhs');

            Route::get('update_giadv', 'KkDvVtKhacController@update_giadv');
            Route::get('del_giadv', 'KkDvVtKhacController@del_giadv');
            Route::get('get_giadv', 'KkDvVtKhacController@get_giadv');

            Route::get('update_giadv_temp', 'KkDvVtKhacController@update_giadv_temp');
            Route::get('del_giadv_temp', 'KkDvVtKhacController@del_giadv_temp');
            Route::get('get_giadv_temp', 'KkDvVtKhacController@get_giadv_temp');

            Route::get('kkgia','KkDvVtKhacController@kkgia');
            Route::get('kkgia_temp','KkDvVtKhacController@kkgia_temp');

            Route::get('getpag_temp', 'KkDvVtKhacController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtKhacController@updatepag_temp');
            Route::get('getpag', 'KkDvVtKhacController@getpag');
            Route::get('updatepag', 'KkDvVtKhacController@updatepag');
        });

        //Xét duyệt dịch vụ xe khách - giao diện sở -
        Route::group(['prefix'=>'xet_duyet'],function() {
            Route::get('/thang={thang}&nam={nam}&pl={pl}','KkDvVtKhacController@indexXD');
            Route::get('duyet','KkDvVtKhacController@accept');
            Route::get('tra_lai','KkDvVtKhacController@tralai');
            //Route::get('search','KkDvVtXkController@search');
        });

        Route::group(['prefix'=>'tim_kiem'],function() {
            Route::get('/masothue={masothue}&nam={nam}','KkDvVtKhacController@search');
            //Route::get('ket_qua','KkDvVtXkController@getsearch');
        });

        //Printf
        Route::get('in/ma_so={masokk}','KkDvVtKhacController@printKK');
        Route::get('inPAG/ma_so={masokk}','KkDvVtKhacController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe buýt--">
    Route::group(['prefix'=>'dich_vu_xe_bus'],function(){
        Route::group(['prefix'=>'danh_muc'],function(){
            Route::get('','DmDvVtXbController@index');
            Route::get('/ma_so={masothue}','DmDvVtXbController@show');
            Route::get('add','DmDvVtXbController@add');
            Route::get('get','DmDvVtXbController@get');
            Route::get('del','DmDvVtXbController@destroy');
        });

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('/nam={nam}','KkDvVtXbController@index');
            Route::get('edit/{id}','KkDvVtXbController@edit');
            Route::get('create/ma_so={masothue}','KkDvVtXbController@create');
            Route::patch('store','KkDvVtXbController@store');
            Route::patch('update/{id}','KkDvVtXbController@update');

            Route::get('don_vi/ma_so={masothue}','KkDvVtXbController@show');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXbController@destroy');
            Route::get('chuyen', 'KkDvVtXbController@chuyen');
            Route::get('nhanhs', 'KkDvVtXbController@nhanhs');

            Route::get('update_giadv', 'KkDvVtXbController@update_giadv');
            Route::get('del_giadv', 'KkDvVtXbController@del_giadv');
            Route::get('get_giadv', 'KkDvVtXbController@get_giadv');

            Route::get('update_giadv_temp', 'KkDvVtXbController@update_giadv_temp');
            Route::get('del_giadv_temp', 'KkDvVtXbController@del_giadv_temp');
            Route::get('get_giadv_temp', 'KkDvVtXbController@get_giadv_temp');

            Route::get('getpag_temp', 'KkDvVtXbController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXbController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXbController@getpag');
            Route::get('updatepag', 'KkDvVtXbController@updatepag');

            Route::get('kkgia','KkDvVtXbController@kkgia');
            Route::get('kkgia_temp','KkDvVtXbController@kkgia_temp');

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
        Route::get('in/ma_so={masokk}','KkDvVtXbController@printKK');
        Route::get('inPAG/ma_so={masokk}','KkDvVtXbController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe khách--">
    Route::group(['prefix'=>'dich_vu_xe_khach'],function(){
        Route::group(['prefix'=>'danh_muc'],function(){
            Route::get('/ma_so={masothue}','DmDvVtXkController@show');
            Route::get('','DmDvVtXkController@index');
            Route::get('add','DmDvVtXkController@add');
            Route::get('get','DmDvVtXkController@get');
            Route::get('del','DmDvVtXkController@destroy');
        });
        Route::group(['prefix'=>'danh_muc_hl'],function(){
            Route::get('/ma_so={masothue}','DmGiaHLController@show');
            Route::get('','DmGiaHLController@index');
            Route::get('add','DmGiaHLController@add');
            Route::get('get','DmGiaHLController@get');
            Route::get('del','DmGiaHLController@destroy');
        });

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('/nam={nam}','KkDvVtXkController@index');
            Route::get('edit/{id}','KkDvVtXkController@edit');
            Route::get('create/ma_so={masothue}','KkDvVtXkController@create');
            Route::patch('store','KkDvVtXkController@store');
            Route::patch('update/{id}','KkDvVtXkController@update');

            Route::get('don_vi/ma_so={masothue}','KkDvVtXkController@show');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXkController@destroy');
            Route::get('chuyen', 'KkDvVtXkController@chuyen');
            Route::get('nhanhs', 'KkDvVtXkController@nhanhs');

            Route::get('update_giadv', 'KkDvVtXkController@update_giadv');
            Route::get('del_giadv', 'KkDvVtXkController@del_giadv');
            Route::get('get_giadv', 'KkDvVtXkController@get_giadv');

            Route::get('update_giadv_temp', 'KkDvVtXkController@update_giadv_temp');
            Route::get('del_giadv_temp', 'KkDvVtXkController@del_giadv_temp');
            Route::get('get_giadv_temp', 'KkDvVtXkController@get_giadv_temp');

            Route::get('kkgia','KkDvVtXkController@kkgia');
            Route::get('kkgia_temp','KkDvVtXkController@kkgia_temp');

            Route::get('getpag_temp', 'KkDvVtXkController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXkController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXkController@getpag');
            Route::get('updatepag', 'KkDvVtXkController@updatepag');

            Route::get('update_giahl', 'KkDvVtXkController@update_giahl');
            Route::get('del_giahl', 'KkDvVtXkController@del_giahl');
            Route::get('get_giahl', 'KkDvVtXkController@get_giahl');

            Route::get('update_giahl_temp', 'KkDvVtXkController@update_giahl_temp');
            Route::get('del_giahl_temp', 'KkDvVtXkController@del_giahl_temp');
            Route::get('get_giahl_temp', 'KkDvVtXkController@get_giahl_temp');

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
        Route::get('in/ma_so={masokk}','KkDvVtXkController@printKK');
        Route::get('inPAG/ma_so={masokk}','KkDvVtXkController@printPAG');
    });
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Dịch vụ vận tải xe taxi--">
    Route::group(['prefix'=>'dich_vu_xe_taxi'],function(){
        Route::group(['prefix'=>'danh_muc'],function(){
            Route::get('/ma_so={masothue}','DmDvVtXtxController@show');
            Route::get('','DmDvVtXtxController@index');
            Route::get('add','DmDvVtXtxController@add');
            Route::get('get','DmDvVtXtxController@get');
            Route::get('del','DmDvVtXtxController@destroy');
        });

        Route::group(['prefix'=>'ke_khai'],function(){
            Route::get('nam={nam}','KkDvVtXtxController@index');
            Route::get('edit/{id}','KkDvVtXtxController@edit');
            Route::get('create/ma_so={masothue}','KkDvVtXtxController@create');
            Route::patch('store','KkDvVtXtxController@store');
            Route::patch('update/{id}','KkDvVtXtxController@update');
            Route::get('getpag_temp', 'KkDvVtXtxController@getpag_temp');
            Route::get('updatepag_temp', 'KkDvVtXtxController@updatepag_temp');
            Route::get('getpag', 'KkDvVtXtxController@getpag');
            Route::get('updatepag', 'KkDvVtXtxController@updatepag');

            Route::get('don_vi/ma_so={masothue}','KkDvVtXtxController@show');
        });

        Route::group(['prefix'=>'thao_tac'],function() {
            Route::post('xoa', 'KkDvVtXtxController@destroy');
            Route::get('chuyen', 'KkDvVtXtxController@chuyen');
            Route::get('nhanhs', 'KkDvVtXtxController@nhanhs');

            Route::get('update_giadv', 'KkDvVtXtxController@update_giadv');
            Route::get('del_giadv', 'KkDvVtXtxController@del_giadv');
            Route::get('get_giadv', 'KkDvVtXtxController@get_giadv');

            Route::get('update_giadv_temp', 'KkDvVtXtxController@update_giadv_temp');
            Route::get('del_giadv_temp', 'KkDvVtXtxController@del_giadv_temp');
            Route::get('get_giadv_temp', 'KkDvVtXtxController@get_giadv_temp');
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
        Route::get('in/ma_so={masokk}','KkDvVtXtxController@printKK');
        Route::get('inPAG/ma_so={masokk}','KkDvVtXtxController@printPAG');
    });
    // </editor-fold>

});
//Dịch vụ xe taxi mới

Route::get('/ke_khai_dich_vu_van_tai/xe_taxi','KkGiaDvVtTaxiController@index');
Route::get('/ke_khai_dich_vu_van_tai/xe_taxi/masothue={masothue}&nam={nam}','KkGiaDvVtTaxiController@kekhaigia');
Route::get('/ke_khai_dich_vu_van_tai/xe_taxi/nam={nam}','KkGiaDvVtTaxiController@kekhaigiadv');
Route::get('/ke_khai_dich_vu_van_tai/xe_taxi/masothue={masothue}/create','KkGiaDvVtTaxiController@create');
Route::post('/ke_khai_dich_vu_van_tai/xe_taxi','KkGiaDvVtTaxiController@store');
Route::get('/ke_khai_dich_vu_van_tai/xe_taxi/{id}/edit','KkGiaDvVtTaxiController@edit');
Route::patch('/ke_khai_dich_vu_van_tai/xe_taxi/{id}','KkGiaDvVtTaxiController@update');
Route::post('/ke_khai_dich_vu_van_tai/xe_taxi/delete','KkGiaDvVtTaxiController@delete');
Route::post('/ke_khai_dich_vu_van_tai/xe_taxi/chuyen','KkGiaDvVtTaxiController@chuyen');
Route::get('ke_khai_dich_vu_van_tai/xe_taxi/report_ke_khai/{masokk}','KkGiaDvVtTaxiController@show');
    //Ajax create
Route::get('/kkgiadvvtxtx/storedv','KkGiaDvVtTaxiCtDfController@storedv');
Route::get('/kkgiadvvtxtx/editdv','KkGiaDvVtTaxiCtDfController@editdv');
Route::get('/kkgiadvvtxtx/updatedv','KkGiaDvVtTaxiCtDfController@updatedv');
Route::get('/kkgiadvvtxtx/kkgiadv','KkGiaDvVtTaxiCtDfController@kkgiadv');
Route::get('/kkgiadvvtxtx/upkkgiadv','KkGiaDvVtTaxiCtDfController@upkkgiadv');
Route::get('/kkgiadvvtxtx/deldv','KkGiaDvVtTaxiCtDfController@delkkgiadv');
Route::get('/kkgiadvvtxtx/get_pag_temp','KkGiaDvVtTaxiCtDfController@get_pag');
Route::get('/kkgiadvvtxtx/update_pag_temp','KkGiaDvVtTaxiCtDfController@update_pag');
    //end ajax create
    //Ajax edit
Route::get('/kkgiadvvtxtx/boxungdv','KkGiaDvVtTaxiCtController@storedv');
Route::get('/kkgiadvvtxtx/chinhsuadv','KkGiaDvVtTaxiCtController@editdv');
Route::get('/kkgiadvvtxtx/capnhatdv','KkGiaDvVtTaxiCtController@updatedv');
Route::get('/kkgiadvvtxtx/kkgiadvedit','KkGiaDvVtTaxiCtController@kkgiadv');
Route::get('/kkgiadvvtxtx/capnhatkkgiadv','KkGiaDvVtTaxiCtController@upkkgiadv');
Route::get('/kkgiadvvtxtx/xoadv','KkGiaDvVtTaxiCtController@delkkgiadv');
Route::get('/kkgiadvvtxtx/get_pag','KkGiaDvVtTaxiCtController@get_pag');
Route::get('/kkgiadvvtxtx/update_pag','KkGiaDvVtTaxiCtController@update_pag');
    //end ajax edit


//End Dịch vụ xe taxi mới
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

    //Dịch vụ giá sữa
Route::get('ttdn_dich_vu_gia_sua','DnDvGsController@ttdn');
Route::get('ttdn_dich_vu_gia_sua/{id}/edit','DnDvGsController@ttdnedit');
Route::get('ttdn_dich_vu_gia_sua/{id}/chinhsua','DnDvGsController@ttdnchinhsua');
Route::patch('ttdn_dich_vu_gia_sua/{id}','DnDvGsController@ttdnupdate');
Route::patch('ttdn_dich_vu_gia_sua/df/{id}','DnDvGsController@ttdncapnhat');
Route::get('ttdn_dich_vu_gia_sua/{id}/chuyen','DnDvGsController@ttdnchuyen');

Route::get('thong_tin_dn_kkgsua','KkGDvGsController@ttdn');
//Kê khai giá
Route::resource('ke_khai_gia_sua','KkGDvGsController');
Route::get('ke_khai_gia_sua/masothue={masothue}/create','KkGDvGsController@create');
Route::post('ke_khai_gia_sua/delete','KkGDvGsController@delete');
Route::get('kkgdvgs/checkngay','KkGDvGsController@checkngay');
Route::post('ke_khai_gia_sua/chuyen','KkGDvGsController@chuyen');
Route::get('kkgdvgs/viewlydo','KkGDvGsController@viewlydo');


Route::get('ke_khai_gia_sua/report_ke_khai/{mahs}','ReportsController@kkgdgs');
    //Ajax create
Route::get('/kkgdvgs/storetthh','KkGDvGsCtDfController@storetthh');
Route::get('/kkgdvgs/editthh','KkGDvGsCtDfController@editthh');
Route::get('/kkgdvgs/updatehh','KkGDvGsCtDfController@updatehh');
Route::get('/kkgdvgs/deletehh','KkGDvGsCtDfController@deletehh');
Route::get('/kkgdvgs/kkgiahh','KkGDvGsCtDfController@kkgiahh');
Route::get('kkgdvgs/upkkgiahh','KkGDvGsCtDfController@updatekkgiahh');

    //End Ajax create
    //Ajax edit
Route::get('/kkgdvgsedit/storehh','KkGDvGsCtController@storetthh');
Route::get('/kkgdvgsedit/editthh','KkGDvGsCtController@editthh');
Route::get('/kkgdvgsedit/updatehh','KkGDvGsCtController@updatehh');
Route::get('/kkgdvgsedit/deletehh','KkGDvGsCtController@deletehh');
Route::get('/kkgdvgsedit/kkgiahh','KkGDvGsCtController@kkgiahh');
Route::get('kkgdvgsedit/upkkgiahh','KkGDvGsCtController@updatekkgiahh');
    //End Ajax edit
//End kê khai giá
//Xd Kk giá dv giá sữa
Route::resource('xet_duyet_ke_khai_gia_sua','KkGDvGsXdController');
Route::post('xet_duyet_ke_khai_gia_sua/tralai','KkGDvGsXdController@tralai');
Route::post('xet_duyet_ke_khai_gia_sua/nhanhs','KkGDvGsXdController@nhanhs');
    //Ajax
Route::get('ttkkgiasua','KkGDvGsXdController@getTtKkGs');
Route::get('/xdkkgiasua/nhanhs','KkGDvGsXdController@getTTnHs');
    //EndAjax
//End Xd Kk giá dv giá sữa
    //End dịch vụ giá sữa

    //Dịch vụ thức ăn chăn nuôi
Route::get('ttdn_thuc_an_chan_nuoi','DnTaCnController@ttdn');
Route::get('ttdn_thuc_an_chan_nuoi/{id}/edit','DnTaCnController@ttdnedit');
Route::get('ttdn_thuc_an_chan_nuoi/{id}/chinhsua','DnTaCnController@ttdnchinhsua');
Route::patch('ttdn_thuc_an_chan_nuoi/{id}','DnTaCnController@ttdnupdate');
Route::patch('ttdn_thuc_an_chan_nuoi/df/{id}','DnTaCnController@ttdncapnhat');
Route::get('ttdn_thuc_an_chan_nuoi/{id}/chuyen','DnTaCnController@ttdnchuyen');

Route::get('thong_tin_dn_kktacn','KkGDvTaCnController@ttdn');
Route::get('ke_khai_thuc_an_chan_nuoi/report_ke_khai/{mahs}','ReportsController@kkgdvtacn');
//Kê khai giá
Route::resource('ke_khai_thuc_an_chan_nuoi','KkGDvTaCnController');
Route::get('ke_khai_thuc_an_chan_nuoi/masothue={masothue}/create','KkGDvTaCnController@create');
Route::post('ke_khai_thuc_an_chan_nuoi/delete','KkGDvTaCnController@delete');
Route::get('kkdvtacn/checkngay','KkGDvTaCnController@checkngay');
Route::post('ke_khai_thuc_an_chan_nuoi/chuyen','KkGDvTaCnController@chuyen');
Route::get('kkdvtacn/viewlydo','KkGDvTaCnController@viewlydo');
//Ajax create
Route::get('/kkgtacn/storetthh','KkGDvTaCnCtDfController@storetthh');
Route::get('/kkgtacn/editthh','KkGDvTaCnCtDfController@editthh');
Route::get('/kkgtacn/updatehh','KkGDvTaCnCtDfController@updatehh');
Route::get('/kkgtacn/deletehh','KkGDvTaCnCtDfController@deletehh');
Route::get('/kkgtacn/kkgiahh','KkGDvTaCnCtDfController@kkgiahh');
Route::get('kkgtacn/upkkgiahh','KkGDvTaCnCtDfController@updatekkgiahh');

//End Ajax create
//Ajax edit
Route::get('/kkgtacnedit/storehh','KkGDvTaCnCtController@storetthh');
Route::get('/kkgtacnedit/editthh','KkGDvTaCnCtController@editthh');
Route::get('/kkgtacnedit/updatehh','KkGDvTaCnCtController@updatehh');
Route::get('/kkgtacnedit/deletehh','KkGDvTaCnCtController@deletehh');
Route::get('/kkgtacnedit/kkgiahh','KkGDvTaCnCtController@kkgiahh');
Route::get('kkgtacnedit/upkkgiahh','KkGDvTaCnCtController@updatekkgiahh');
//End Ajax edit
//Xd Kk giá dv TACN
Route::resource('xd_ke_khai_thucan_channuoi','KkGDvTaCnXdController');
Route::post('xd_ke_khai_thucan_channuoi/tralai','KkGDvTaCnXdController@tralai');
Route::post('xd_ke_khai_thucan_channuoi/nhanhs','KkGDvTaCnXdController@nhanhs');
//Ajax
Route::get('ttkktacn','KkGDvTaCnXdController@getTtKkTaCn');
Route::get('/xdkktacn/nhanhs','KkGDvTaCnXdController@getTTnHs');
//EndAjax
//End Xd Kk giá dv TACN
    //End Dịch vụ thức ăn chăn nuôi
// </editor-fold>//End Manage

Route::resource('thongtinngaynghile','TtNgayNghiLeController');
Route::post('thongtinngaynghile/delete','TtNgayNghiLeController@delete');
Route::get('/thongtinngaynghile/show','TtNgayNghiLeController@show');


