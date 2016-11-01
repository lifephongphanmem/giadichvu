<?php

namespace App\Http\Controllers;

use App\DnDvLt;
use App\DnDvLtReg;
use App\DonViDvVt;
use App\GeneralConfigs;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        if (Session::has('admin')) {
            if(session('admin')->username == 'sa')
                return redirect('cau-hinh-he-thong');
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
        return view('system.register.dvlt.register')
            ->with('pageTitle','Đăng ký thông tin doanh nghiệp cung cấp dịch vụ lưu trú');
    }

    public function regdvltstore(Request $request){
        $input = $request->all();
        $model = new DnDvLtReg();
        $model->tendn = $input['tendn'];
        $model->masothue = $input['masothue'];
        $model->diachidn = $input['diachidn'];
        $model->teldn  = $input['teldn'];
        $model->faxdn= $input['faxdn'];
        $model->noidknopthue = $input['noidknopthue'];
        $model->giayphepkd = $input['giayphepkd'];
        $model->tailieu = $input['tailieu'];
        $model->username = $input['username'];
        $model->password = md5($input['rpassword']);
        $model->save();
        return view('errors.register-success');
    }

    public function checkrgmasothue(Request $request){
        $input = $request->all();
        if ($input['pl'] == 'DVLT') {
            $model = DnDvLt::where('masothue', $input['masothue'])
                ->first();
            $modelrg = DnDvLtReg::where('masothue', $input['masothue'])
                ->first();
        }elseif($input['pl']=='DVVT'){
            $model = DonViDvVt::where('masothue',$input['masothue'])
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
            $modelrg = DnDvLtReg::where('username', $input['user'])
                ->first();
        }elseif($input['pl']=='DVVT'){
            $model = User::where('username', $input['user'])
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


}
