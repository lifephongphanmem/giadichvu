<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmDvQlController extends Controller
{
    public function index(){

        if (Session::has('admin')) {
            $model = DmDvQl::all();
            return view('system.dmdvql.index')
                ->with('model',$model)
                ->with('pageTitle', 'Danh mục đơn vị quản lý');
        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {

            return view('system.dmdvql.create')
                ->with('pageTitle', 'Danh mục đơn vị quản lý');
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

            return redirect('danh_muc_don_vi_quan_ly');
        }else
            return view('errors.notlogin');
    }

    public function checkmaqhns(Request $request){
        $input = $request->all();
        $model = DmDvQl::where('maqhns',$input['maqhns'])
            ->first();
        if (isset($model)) {
            echo 'cancel';
        } else {
            echo 'ok';
        }
    }

    public function checktaikhoan(Request $request){
        $input = $request->all();
        $model = Users::where('username',$input['user'])
            ->first();
        if (isset($model)) {
            echo 'cancel';
        } else {
            echo 'ok';
        }
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = DmDvQl::findOrFail($id);
            return view('system.dmdvql.edit')
                ->with('model',$model)
                ->with('pageTitle', 'Danh mục đơn vị quản lý');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();

            $model = DmDvQl::findOrFail($id);
            $model->tendv = $input['tendv'];
            //$model->maqhns = $input['maqhns'];
            $model->diachi = $input['diachi'];
            $model->plql = $input['plql'];
            $model->sohsnhan = $input['sohsnhan'];
            $model->ttlh = $input['ttlh'];
            $model->email = $input['email'];
            $model->emailqt = $input['emailqt'];
            $model->save();

            return redirect('danh_muc_don_vi_quan_ly');
        }else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['iddelete'];
            $model = DmDvQl::findOrFail($id);
            $model->delete();
            return redirect('danh_muc_don_vi_quan_ly');
        }else
            return view('errors.notlogin');
    }
}
