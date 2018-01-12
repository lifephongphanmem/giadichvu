<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\GeneralConfigs;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class GeneralConfigsController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt' || session('admin')->sadmin == 'sa') {
                if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                    $model = DmDvQl::all();
                    return view('system.general.indexql')
                        ->with('model', $model)
                        ->with('pageTitle', 'Cấu hình hệ thống');
                } else {
                    $model = DmDvQl::where('maqhns', session('admin')->cqcq)
                        ->first();
                    return view('system.general.index')
                        ->with('model', $model)
                        ->with('pageTitle', 'Cấu hình hệ thống');

                }
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                return view('system.general.create')
                    ->with('pageTitle', 'Thêm mới thông tin cấu hình hệ thống');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();

            $model = new DmDvQl();
            $model->tendv = $input['tendv'];
            $model->maqhns = $input['maqhns'];
            $model->diachi = $input['diachi'];
            $model->plql = $input['plql'];
            $model->level = $input['level'];
            $model->username = $input['taikhoan'];
            $model->password = md5($input['password']);
            $model->sohsnhan = $input['sohsnhan'];
            $model->ttlh = $input['ttlh'];
            $model->email = $input['email'];
            $model->emailqt = $input['emailqt'];
            if($model->save()){
                $modeluser = new Users();
                $modeluser->name = $input['tendv'];
                $modeluser->username = $input['taikhoan'];
                $modeluser->password = md5($input['password']);
                $modeluser->status = 'Kích hoạt';
                $modeluser->level = $input['level'];
                $modeluser->cqcq = $input['maqhns'];
                $modeluser->save();
            }

            return redirect('cau_hinh_he_thong');
        }else
            return view('errors.notlogin');
    }

    public function edit($id)
    {
        if (Session::has('admin')) {
            $model = DmDvQl::findOrFail($id);
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt' || session('admin')->sadmin == 'sact') {
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->maqhns) {
                    return view('system.general.edit')
                        ->with('model', $model)
                        ->with('pageTitle', 'Chỉnh sửa cấu hình hệ thống');
                }else{
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }
    public function update(Request $request,$id)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            $model = DmDvQl::findOrFail($id);
            if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->maqhns) {
                if (session('admin')->sadmin == 'ssa') {
                    $model->maqhns = $input['maqhns'];
                    $model->tendv = $input['tendv'];
                    $model->plql = $input['plql'];
                    $model->level = $input['level'];
                }
                $model->diachi = $input['diachi'];
                $model->sohsnhan = $input['sohsnhan'];
                $model->ttlh = $input['ttlh'];
                $model->email = $input['email'];
                $model->emailqt = $input['emailqt'];
                $model->save();
            }else{
                return view('errors.noperm');
            }

            return redirect('cau_hinh_he_thong');

        }else
            return view('errors.notlogin');
    }


}
