<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\GeneralConfigs;
use App\Register;
use App\Users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt')
                return redirect('cau_hinh_he_thong');
            else
                return view('dashboard')
                    ->with('pageTitle','Tổng quan');
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
                    ->with('setting',json_decode($setting))
                    ->with('pageTitle','Cấu hình chức năng chương trình');
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
        $model->setting = '';
        $model->dvxk = 0;
        $model->dvxb = 0;
        $model->dvxtx = 0;
        $model->dvk = 0;
        $model->trangthai = 'Chờ duyệt';
        $model->lydo='';
        $model->save();
        return view('errors.register-success');
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

        $model->save();
        return view('errors.register-success');
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
        if ($input['pl'] == 'DVLT') {
            $model = User::where('username', $input['user'])
                ->first();
            $modelrg = Register::where('username', $input['user'])
                ->first();
        }elseif($input['pl']=='DVVT'){
            $model = User::where('username', $input['user'])
                ->first();
            $modelrg = Register::where('username', $input['user'])
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

    public function forgotpassword(){

        return view('system.users.forgotpassword.index')
            ->with('pageTitle','Quên mật khẩu???');
    }

    public function forgotpasswordw(Request $request){

        $input = $request->all();

        $model = Users::where('username',$input['username'])->first();

        if(isset($model)){
            if($model->emailxt == $input['emailxt'] && $model->question == $input['question']  && $model->answer == $input['answer']){
                $model->password = 'e10adc3949ba59abbe56e057f20f883e';
                $model->save();
                return view('errors.forgotpass-success');
            }else
                return view('errors.forgotpass-errors');
        }else
            return view('errors.forgotpass-errors');

    }


}
