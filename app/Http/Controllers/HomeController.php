<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\KkDvVtKhac;
use App\KkDvVtXb;
use App\KkDvVtXk;
use App\KkDvVtXtx;
use App\KkGDvGs;
use App\KkGDvLt;
use App\KkGDvTaCn;
use App\Register;
use App\TtDn;
use App\Users;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt' ||session('admin')->sadmin == 'sa' )
                return redirect('cau_hinh_he_thong');
            else{
                if(session('admin')->sadmin == 'ssa'){

                    //dd(session('admin')->permission);
                    //dd(canGeneral('dvvt','dvvt'));
                    $cnttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Chờ duyệt')
                        ->count();
                    $btlttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Bị trả lại')
                        ->count();
                    $cnttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Chờ duyệt')
                        ->count();
                    $btlttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Bị trả lại')
                        ->count();
                    $cnttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Chờ duyệt')
                        ->count();
                    $btlttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgdvlt = KkGDvLt::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgdvlt = KkGDvLt::where('trangthai','Chờ nhận')
                        ->count();
                    $cnttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Chờ duyệt')
                        ->count();
                    $btlttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgvtxk = KkDvVtXk::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgvtxk = KkDvVtXk::where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgvtxb = KkDvVtXb::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgvtxb = KkDvVtXb::where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgvtxtx = KkDvVtXtx::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgvtxtx = KkDvVtXtx::where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgvtkhac = KkDvVtKhac::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgvtkhac = KkDvVtKhac::where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgs = KkGDvGs::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgs = KkGDvGs::where('trangthai','Bị trả lại')
                        ->count();
                    $cnkkgtacn = KkGDvTaCn::where('trangthai','Chờ nhận')
                        ->count();
                    $btlkkgtacn = KkGDvTaCn::where('trangthai','Bị trả lại')
                        ->count();
                }elseif(session('admin')->level == 'T' || session('admin') == 'H'){
                    $cnttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Chờ duyệt')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Chờ duyệt')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Chờ duyệt')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgdvlt = KkGDvLt::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgdvlt = KkGDvLt::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Chờ duyệt')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgvtxk = KkDvVtXk::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgvtxk = KkDvVtXk::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgvtxb = KkDvVtXb::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgvtxb = KkDvVtXb::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgvtxtx = KkDvVtXtx::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgvtxtx = KkDvVtXtx::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgvtkhac = KkDvVtKhac::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgvtkhac = KkDvVtKhac::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgs = KkGDvGs::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgs = KkGDvGs::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $cnkkgtacn = KkGDvTaCn::where('trangthai','Chờ nhận')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                    $btlkkgtacn = KkGDvTaCn::where('trangthai','Bị trả lại')
                        ->where('cqcq',session('admin')->cqcq)
                        ->count();
                }else{
                    $cnttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Chờ duyệt')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlttdndvlt = TtDn::where('pl','DVLT')
                        ->where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Chờ duyệt')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlttdndvgs = TtDn::where('pl','DVGS')
                        ->where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Chờ duyệt')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlttdndvtacn = TtDn::where('pl','DVTACN')
                        ->where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgdvlt = KkGDvLt::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgdvlt = KkGDvLt::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Chờ duyệt')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlttdndvvt = TtDn::where('pl','DVVT')
                        ->where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgvtxk = KkDvVtXk::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgvtxk = KkDvVtXk::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgvtxb = KkDvVtXb::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgvtxb = KkDvVtXb::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgvtxtx = KkDvVtXtx::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgvtxtx = KkDvVtXtx::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgvtkhac = KkDvVtKhac::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgvtkhac = KkDvVtKhac::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgs = KkGDvGs::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgs = KkGDvGs::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $cnkkgtacn = KkGDvTaCn::where('trangthai','Chờ nhận')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                    $btlkkgtacn = KkGDvTaCn::where('trangthai','Bị trả lại')
                        ->where('masothue',session('admin')->mahuyen)
                        ->count();
                }
                $array = '';
                $array['cnttdndvlt'] = $cnttdndvlt;
                $array['btlttdndvlt'] = $btlttdndvlt;
                $array['cnkkgdvlt'] = $cnkkgdvlt;
                $array['btlkkgdvlt'] = $btlkkgdvlt;
                $array['cnttdndvvt'] = $cnttdndvvt;
                $array['btlttdndvvt'] = $btlttdndvvt;
                $array['cnkkgvtxk'] = $cnkkgvtxk;
                $array['btlkkgvtxk'] = $btlkkgvtxk;
                $array['cnkkgvtxb'] = $cnkkgvtxb;
                $array['btlkkgvtxb'] = $btlkkgvtxb;
                $array['cnkkgvtxtx'] = $cnkkgvtxtx;
                $array['btlkkgvtxtx'] = $btlkkgvtxtx;
                $array['cnkkgvtkhac'] = $cnkkgvtkhac;
                $array['btlkkgvtkhac'] = $btlkkgvtkhac;
                $array['cnkkgs'] = $cnkkgs;
                $array['btlkkgs'] = $btlkkgs;
                $array['cnttdndvgs'] = $cnttdndvgs;
                $array['btlttdndvgs'] = $btlttdndvgs;
                $array['cnttdndvtacn']= $cnttdndvtacn;
                $array['btlttdndvtacn'] = $btlttdndvtacn;
                $array['cnkkgtacn'] = $cnkkgtacn;
                $array['btlkkgtacn'] = $btlkkgtacn;
                //dd($array);
                return view('dashboard')
                    ->with('sl',$array)
                    ->with('pageTitle','Tổng quan');
            }
        }else
            return view('welcome');

    }

    public function setting()
    {
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'ssa')
            {
                $model = GeneralConfigs::first();
                $setting = $model->setting;

                return view('system.general.setting')
                    ->with('model',$model)
                    ->with('setting',json_decode($setting))
                    ->with('pageTitle','Cấu hình chức năng chương trình');
            }else{
                return view('errors.perm');
            }

        }else
            return view('welcome');
    }

    public function upsetting(Request $request)
    {
        if (Session::has('admin')) {

            $update = $request->all();

            $model = GeneralConfigs::first();

            $update['roles'] = isset($update['roles']) ? $update['roles'] : null;
            $model->setting = json_encode($update['roles']);
            $model->urlwebcb = $update['urlwebcb'];
            $model->save();

            return redirect('cau_hinh_he_thong');
        }else
            return view('welcome');
    }

    public function regdvlt(){
        $model = DmDvQl::where('plql','TC')
            ->get();
        return view('system.register.dvlt.register')
            ->with('model',$model)
            ->with('pageTitle','Đăng ký thông tin doanh nghiệp cung cấp dịch vụ lưu trú');
    }

    public function regdvltstore(Request $request){
        $input = $request->all();
        if($input['g-recaptcha-response'] != '') {
            $check = DnDvLt::where('masothue', $input['masothue'])
                ->first();
            if (count($check) > 0) {
                return view('errors.register-errors');
            } else {
                $checkuser = User::where('username', $input['username'])->first();
                if (count($checkuser) > 0) {
                    return view('errors.register-errors');
                } else {

                    $ma = getdate()[0];
                    $model = new Register();
                    $model->tendn = $input['tendn'];
                    $model->masothue = $input['masothue'];
                    $model->diachi = $input['diachidn'];
                    $model->tel = $input['teldn'];
                    $model->fax = $input['faxdn'];
                    $model->email = $input['emaildn'];
                    $model->noidknopthue = $input['noidknopthue'];
                    $model->cqcq = $input['cqcq'];
                    $model->giayphepkd = $input['giayphepkd'];
                    $model->tailieu = $input['tailieu'];
                    $model->username = $input['username'];
                    $model->password = md5($input['rpassword']);
                    $model->pl = 'DVLT';
                    $model->diadanh = $input['diadanh'];
                    $model->nguoiky = $input['nguoiky'];
                    $model->chucdanh = $input['chucdanh'];
                    $model->setting = '';
                    $model->dvxk = 0;
                    $model->dvxb = 0;
                    $model->dvxtx = 0;
                    $model->dvk = 0;
                    $model->trangthai = 'Chờ duyệt';
                    $model->lydo = '';
                    $model->ma = $ma;
                    if ($model->save()) {
                        $tencqcq = DmDvQl::where('maqhns', $input['cqcq'])->first();
                        $data = [];
                        $data['tendn'] = $input['tendn'];
                        $data['tg'] = Carbon::now()->toDateTimeString();
                        $data['tencqcq'] = $tencqcq->tendv;
                        $data['masothue'] = $input['masothue'];
                        $data['user'] = $input['username'];
                        $data['madk'] = $ma;
                        $maildn = $input['emaildn'];
                        $tendn = $input['tendn'];
                        $mailql = $tencqcq->emailqt;
                        $tenql = $tencqcq->tendv;

                        Mail::send('mail.register', $data, function ($message) use ($maildn, $tendn, $mailql, $tenql) {
                            $message->to($maildn, $tendn)
                                ->to($mailql, $tenql)
                                ->subject('Thông báo đăng ký tài khoản');
                            $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                        });

                    }
                    return view('system.register.view.register-success')
                        ->with('ma', $ma);
                }
            }
        }else
            return view('errors.register-errors');
    }

    public function regdvvt(){
        $model = DmDvQl::where('plql','VT')
            ->get();
        return view('system.register.dvvt.register')
            ->with('model',$model)
            ->with('pageTitle','Đăng ký thông tin doanh nghiệp cung cấp dịch vụ vận tải');
    }

    public function regdvvtstore(Request $request){
        $input = $request->all();
        $ma = getdate()[0];
        $model = new Register();

        $model->tendn = $input['tendn'];
        $model->masothue = $input['masothue'];
        $model->diachi = $input['diachidn'];
        $model->tel = $input['teldn'];
        $model->fax = $input['faxdn'];
        $model->email = $input['emaildn'];
        $model->noidknopthue = $input['noidknopthue'];
        $model->giayphepkd = $input['giayphepkd'];
        $model->tailieu = $input['tailieu'];
        $model->cqcq = $input['cqcq'];
        $model->username = $input['username'];
        $model->password = md5($input['rpassword']);
        $model->pl = 'DVVT';

        $input['roles'] = isset($input['roles']) ? $input['roles'] : null;
        $model->setting = json_encode($input['roles']);
        $x = $input['roles'];
        $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
        $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
        $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
        $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;
        $model->trangthai = 'Chờ duyệt';
        $model->lydo='';
        $model->ma = $ma;
        $model->save();
        return view('system.register.view.register-success')
            ->with('ma',$ma);
    }

    public function regdverror(){
        return view('system.users.register.registererror.index')
            ->with('pageTitle','Thông tin tài khoản chưa được kích hoạt');
    }

    public function checkrgmasothue(Request $request){
        $input = $request->all();
        if ($input['pl'] == 'DVLT') {
            $model = DnDvLt::where('masothue', $input['masothue'])
                ->first();
            $modelrg = Register::where('masothue', $input['masothue'])
                ->where('pl','DVLT')
                ->first();
        }elseif($input['pl']=='DVVT'){
            $model = DonViDvVt::where('masothue',$input['masothue'])
                ->first();
            $modelrg = Register::where('masothue',$input['masothue'])
                ->where('pl','DVVT')
                ->first();
        }elseif($input['pl']=='DVGS'){
            $model = DnDvGs::where('masothue',$input['masothue'])
                ->first();
            $modelrg = Register::where('masothue',$input['masothue'])
                ->where('pl','DVGS')
                ->first();
        }
        if(isset($model)) {
            echo 'cancel';
        }else{
            if(isset($modelrg)){
                echo 'cancel';
            }else
                echo 'ok';
        }
    }

    public function checkrguser(Request $request){
        $input = $request->all();
        $model = User::where('username', $input['user'])
            ->first();
        $modelrg = Register::where('username', $input['user'])
            ->first();
        if(isset($model)) {
            echo 'cancel';
        }else{
            if(isset($modelrg)){
                echo 'cancel';
            }else
                echo 'ok';
        }
    }

    public function forgotpassword(){

        return view('system.users.forgotpassword.index')
            ->with('pageTitle','Quên mật khẩu???');
    }

    public function forgotpasswordw(Request $request){

        $input = $request->all();
        $model = Users::where('username',$input['username'])->first();
        if(isset($model)){
            if($model->email == $input['email']){
                $npass = getRandomPassword();
                $model->password = md5($npass);
                $model->save();

                $data = [];
                $data['tendn'] = $model->name;
                $data['username'] = $model->username;
                $data['npass'] = $npass;
                $maildn = $model->email;
                $tendn = $model->name;

                Mail::send('mail.successnewpassword', $data, function ($message) use ($maildn,$tendn) {
                    $message->to($maildn,$tendn)
                        ->subject('Thông báo thay đổi mật khẩu tài khoản');
                    $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                });
                return view('errors.forgotpass-success');
            }else
                return view('errors.forgotpass-errors');
        }else
            return view('errors.forgotpass-errors');

    }

    public function searchregister(){
        return view('system.register.search.index')
            ->with('pageTitle','Kiểm tra tài khoản!!!');
    }

    public function checksearchregister(Request $request){
        $input = $request->all();

        $check1 = Register::where('masothue',$input['masothue'])
            ->where('pl',$input['pl'])
            ->first();
        if(isset($check1)){
            if($check1->trangthai == 'Chờ duyệt'){
                return view('system.register.view.register-choduyet');
            }else
                return view('system.register.view.register-tralai')
                    ->with('lydo',$check1->lydo);
        }else{
            $check2 = Users::where('mahuyen',$input['masothue'])
                ->first();
            if(isset($check2)){
                return view('system.register.view.register-usersuccess');
            }else{
                return view('system.register.view.register-nouser');
            }
        }
    }

    public function show(){
        return view('system.register.search.show');
    }

    public function edit(Request $request){
        $input = $request->all();
        $model = Register::where('ma',$input['ma'])
            ->first();
        //dd($model);
        if(isset($model)){
            if($model->pl == 'DVLT'){
                $cqcq = DmDvQl::where('plql','TC')
                    ->get();
                return view('system.register.search.dvlt.edit')
                    ->with('cqcq',$cqcq)
                    ->with('model',$model)
                    ->with('pageTitle','Chỉnh sửa thông tin đăng ký tài khoản');
            }elseif($model->pl == 'DVVT'){
                $cqcq = DmDvQl::where('plql','VT')
                    ->get();
                return view('system.register.search.dvvt.edit')
                    ->with('cqcq',$cqcq)
                    ->with('model',$model)
                    ->with('pageTitle','Chỉnh sửa thông tin đăng ký tài khoản');
            }
            elseif($model->pl == 'DVGS'){
                $cqcq = DmDvQl::where('plql','CT')
                    ->get();
                return view('system.register.search.dvgs.edit')
                    ->with('cqcq',$cqcq)
                    ->with('model',$model)
                    ->with('pageTitle','Chỉnh sửa thông tin đăng ký tài khoản');
            }elseif($model->pl == 'DVTACN'){
                $cqcq = DmDvQl::where('plql','TC')
                    ->get();
                return view('system.register.search.dvtacn.edit')
                    ->with('cqcq',$cqcq)
                    ->with('model',$model)
                    ->with('pageTitle','Chỉnh sửa thông tin đăng ký tài khoản');
            }
        }else{
            return view('system.register.view.register-edit-errors');
        }
    }

    public function updatedvlt(Request $request, $id){
        $input = $request->all();
        $model = Register::findOrFail($id);
        $model->tendn = $input['tendn'];
        $model->masothue = $input['masothue'];
        $model->diachi = $input['diachidn'];
        $model->tel = $input['teldn'];
        $model->fax = $input['faxdn'];
        $model->email = $input['emaildn'];
        $model->noidknopthue = $input['noidknopthue'];
        $model->cqcq = $input['cqcq'];
        $model->giayphepkd = $input['giayphepkd'];
        $model->tailieu = $input['tailieu'];
        $model->username = $input['username'];
        $model->password = md5($input['rpassword']);
        $model->trangthai = 'Chờ duyệt';
        $model->chucdanh = $input['chucdanh'];
        $model->nguoiky = $input['nguoiky'];
        $model->diadanh = $input['diadanh'];
        if($model->save()){
            $tencqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
            $data=[];
            $data['tendn'] = $input['tendn'];
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['masothue'] = $input['masothue'];
            $data['user'] = $input['username'];
            $data['madk'] = $model->ma;
            $maildn = $input['emaildn'];
            $tendn  =  $input['tendn'];
            $mailql = $tencqcq->emailqt;
            $tenql = $tencqcq->tendv;
            Mail::send('mail.stlregister',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                $message->to($maildn,$tendn)
                    ->to($mailql,$tenql)
                    ->subject('Thông báo đăng ký tài khoản');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
        }
        return view('errors.register-success');
    }

    public function updatedvvt(Request $request, $id){
        $input = $request->all();
        $model = Register::findOrFail($id);

        $model->tendn = $input['tendn'];
        $model->masothue = $input['masothue'];
        $model->diachi = $input['diachidn'];
        $model->tel = $input['teldn'];
        $model->fax = $input['faxdn'];
        $model->email = $input['emaildn'];
        $model->noidknopthue = $input['noidknopthue'];
        $model->giayphepkd = $input['giayphepkd'];
        $model->tailieu = $input['tailieu'];
        $model->cqcq = $input['cqcq'];
        $model->username = $input['username'];
        $model->password = md5($input['rpassword']);

        $input['roles'] = isset($input['roles']) ? $input['roles'] : null;
        $model->setting = json_encode($input['roles']);
        $x = $input['roles'];
        $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
        $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
        $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
        $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;
        $model->trangthai = 'Chờ duyệt';
        if($model->save()){
            $tencqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
            $data=[];
            $data['tendn'] = $input['tendn'];
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['masothue'] = $input['masothue'];
            $data['user'] = $input['username'];
            $data['madk'] = $model->ma;
            $a = $input['emaildn'];
            $b  =  $input['tendn'];
            Mail::send('mail.stlregister',$data, function ($message) use($a,$b) {
                $message->to($a,$b )
                    ->subject('Thông báo đăng ký tài khoản');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
        }
        return view('errors.register-success');
    }

    public function updatedvgs(Request $request, $id){
        $input = $request->all();
        $model = Register::findOrFail($id);
        $model->tendn = $input['tendn'];
        $model->masothue = $input['masothue'];
        $model->diachi = $input['diachidn'];
        $model->tel = $input['teldn'];
        $model->fax = $input['faxdn'];
        $model->email = $input['emaildn'];
        $model->noidknopthue = $input['noidknopthue'];
        $model->cqcq = $input['cqcq'];
        $model->giayphepkd = $input['giayphepkd'];
        $model->tailieu = $input['tailieu'];
        $model->username = $input['username'];
        $model->password = md5($input['rpassword']);
        $model->trangthai = 'Chờ duyệt';
        $model->chucdanh = $input['chucdanh'];
        $model->nguoiky = $input['nguoiky'];
        $model->diadanh = $input['diadanh'];
        if($model->save()){
            $tencqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
            $data=[];
            $data['tendn'] = $input['tendn'];
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['masothue'] = $input['masothue'];
            $data['user'] = $input['username'];
            $data['madk'] = $model->ma;
            $maildn = $input['emaildn'];
            $tendn  =  $input['tendn'];
            $mailql = $tencqcq->emailqt;
            $tenql = $tencqcq->tendv;
            Mail::send('mail.stlregister',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                $message->to($maildn,$tendn)
                    ->to($mailql,$tenql)
                    ->subject('Thông báo đăng ký tài khoản');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
        }
        return view('errors.register-success');
    }


    public function dangkydvgs(){
        $model = DmDvQl::where('plql','CT')
            ->get();
        return view('system.register.dvgs.register')
            ->with('model',$model)
            ->with('pageTitle','Đăng ký dịch vụ giá sữa');
    }

    public function dangkydvgsstore(Request $request){
        $input = $request->all();
        if($input['g-recaptcha-response'] != '') {
            $check = DnDvLt::where('masothue', $input['masothue'])
                ->first();
            if (count($check) > 0) {
                return view('errors.register-errors');
            } else {
                $checkuser = User::where('username', $input['username'])->first();
                if (count($checkuser) > 0) {
                    return view('errors.register-errors');
                } else {

                    $ma = getdate()[0];
                    $model = new Register();
                    $model->tendn = $input['tendn'];
                    $model->masothue = $input['masothue'];
                    $model->diachi = $input['diachidn'];
                    $model->tel = $input['teldn'];
                    $model->fax = $input['faxdn'];
                    $model->email = $input['emaildn'];
                    $model->noidknopthue = $input['noidknopthue'];
                    $model->cqcq = $input['cqcq'];
                    $model->giayphepkd = $input['giayphepkd'];
                    $model->tailieu = $input['tailieu'];
                    $model->username = $input['username'];
                    $model->password = md5($input['rpassword']);
                    $model->pl = 'DVGS';
                    $model->diadanh = $input['diadanh'];
                    $model->nguoiky = $input['nguoiky'];
                    $model->chucdanh = $input['chucdanh'];
                    $model->setting = '';
                    $model->dvxk = 0;
                    $model->dvxb = 0;
                    $model->dvxtx = 0;
                    $model->dvk = 0;
                    $model->trangthai = 'Chờ duyệt';
                    $model->lydo = '';
                    $model->ma = $ma;
                    if ($model->save()) {
                        $tencqcq = DmDvQl::where('maqhns', $input['cqcq'])->first();
                        $data = [];
                        $data['tendn'] = $input['tendn'];
                        $data['tg'] = Carbon::now()->toDateTimeString();
                        $data['tencqcq'] = $tencqcq->tendv;
                        $data['masothue'] = $input['masothue'];
                        $data['user'] = $input['username'];
                        $data['madk'] = $ma;
                        $maildn = $input['emaildn'];
                        $tendn = $input['tendn'];
                        $mailql = $tencqcq->emailqt;
                        $tenql = $tencqcq->tendv;

                        Mail::send('mail.register', $data, function ($message) use ($maildn, $tendn, $mailql, $tenql) {
                            $message->to($maildn, $tendn)
                                ->to($mailql, $tenql)
                                ->subject('Thông báo đăng ký tài khoản');
                            $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                        });

                    }
                    return view('system.register.view.register-success')
                        ->with('ma', $ma);
                }
            }
        }else
            return view('errors.register-errors');
    }

    public function dangkydvtacn(){
        $model = DmDvQl::where('plql','TC')
            ->get();
        return view('system.register.dvtacn.register')
            ->with('model',$model)
            ->with('pageTitle','Đăng ký doanh nghiệp cung cấp thức ăn chăn nuôi');
    }

    public function dangkydvtacnstore(Request $request){
        $input = $request->all();
        if($input['g-recaptcha-response'] != '') {
            $check = DnDvLt::where('masothue', $input['masothue'])
                ->first();
            if (count($check) > 0) {
                return view('errors.register-errors');
            } else {
                $checkuser = User::where('username', $input['username'])->first();
                if (count($checkuser) > 0) {
                    return view('errors.register-errors');
                } else {

                    $ma = getdate()[0];
                    $model = new Register();
                    $model->tendn = $input['tendn'];
                    $model->masothue = $input['masothue'];
                    $model->diachi = $input['diachidn'];
                    $model->tel = $input['teldn'];
                    $model->fax = $input['faxdn'];
                    $model->email = $input['emaildn'];
                    $model->noidknopthue = $input['noidknopthue'];
                    $model->cqcq = $input['cqcq'];
                    $model->giayphepkd = $input['giayphepkd'];
                    $model->tailieu = $input['tailieu'];
                    $model->username = $input['username'];
                    $model->password = md5($input['rpassword']);
                    $model->pl = 'DVTACN';
                    $model->diadanh = $input['diadanh'];
                    $model->nguoiky = $input['nguoiky'];
                    $model->chucdanh = $input['chucdanh'];
                    $model->setting = '';
                    $model->dvxk = 0;
                    $model->dvxb = 0;
                    $model->dvxtx = 0;
                    $model->dvk = 0;
                    $model->trangthai = 'Chờ duyệt';
                    $model->lydo = '';
                    $model->ma = $ma;
                    if ($model->save()) {
                        $tencqcq = DmDvQl::where('maqhns', $input['cqcq'])->first();
                        $data = [];
                        $data['tendn'] = $input['tendn'];
                        $data['tg'] = Carbon::now()->toDateTimeString();
                        $data['tencqcq'] = $tencqcq->tendv;
                        $data['masothue'] = $input['masothue'];
                        $data['user'] = $input['username'];
                        $data['madk'] = $ma;
                        $maildn = $input['emaildn'];
                        $tendn = $input['tendn'];
                        $mailql = $tencqcq->emailqt;
                        $tenql = $tencqcq->tendv;

                        Mail::send('mail.register', $data, function ($message) use ($maildn, $tendn, $mailql, $tenql) {
                            $message->to($maildn, $tendn)
                                ->to($mailql, $tenql)
                                ->subject('Thông báo đăng ký tài khoản');
                            $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                        });

                    }
                    return view('system.register.view.register-success')
                        ->with('ma', $ma);
                }
            }
        }else
            return view('errors.register-errors');
    }

    public function updatedvtacn(Request $request, $id){
        $input = $request->all();
        $input['trangthai'] = 'Chờ duyệt';
        $input['password'] = md5($input['password']);
        $model = Register::findOrFail($id);
        if($model->update($input)){
            $tencqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
            $data=[];
            $data['tendn'] = $input['tendn'];
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['masothue'] = $input['masothue'];
            $data['user'] = $input['username'];
            $data['madk'] = $model->ma;
            $maildn = $input['emaildn'];
            $tendn  =  $input['tendn'];
            $mailql = $tencqcq->emailqt;
            $tenql = $tencqcq->tendv;
            Mail::send('mail.stlregister',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                $message->to($maildn,$tendn)
                    ->to($mailql,$tenql)
                    ->subject('Thông báo đăng ký tài khoản');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
        }
        return view('errors.register-success');
    }

}
