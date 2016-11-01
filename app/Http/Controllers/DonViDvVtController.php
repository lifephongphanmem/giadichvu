<?php

namespace App\Http\Controllers;

use App\DonViDvVt;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DonViDvVtController extends Controller
{
    public function index(){
        if (Session::has('admin')) {

            $model = DonViDvVt::where('trangthai','Kích hoạt')
                ->get();

            return view('system.dndvvt.index')
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp dịch vụ vận tải');

        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {

            return view('system.dndvvt.create')
                ->with('pageTitle','Thêm mới doanh nghiệp cung cấp dịch vụ vận tải');

        }else
            return view('errors.notlogin');
    }
    public function store(Request $request){
        if (Session::has('admin')) {
            $insert = $request->all();
            $model = new DonViDvVt();
            $model->tendonvi = $insert['tendonvi'];
            $model->masothue = $insert['masothue'];
            $model->diachi = $insert['diachi'];
            $model->dienthoai = $insert['dienthoai'];
            $model->fax = $insert['fax'];
            $model->dknopthue= $insert['dknopthue'];
            $model->giayphepkd = $insert['giayphepkd'];
            $model->chucdanh = $insert['chucdanh'];
            $model->nguoiky = $insert['nguoiky'];
            $model->diadanh = $insert['diadanh'];

            $insert['roles'] = isset($insert['roles']) ? $insert['roles'] : null;
            $model->setting = json_encode($insert['roles']);
            $x = $insert['roles'];
            $model->dvxk = isset($x['dvvt']['dvxk']) ? 1 : 0;
            $model->dvxb = isset($x['dvvt']['dvxb']) ? 1 : 0;
            $model->dvxtx = isset($x['dvvt']['dvxtx']) ? 1 : 0;
            $model->dvk = isset($x['dvvt']['dvk']) ? 1 : 0;

            $model->toado = $insert['diachi']!= '' ? getAddMap($insert['diachi']) : '';
            //$model->tailieu =$insert['tailieu'];
            $model->trangthai = 'Kích hoạt';
            $model->email = '';

            if($model->save()){
                $modeluser = new Users();
                $modeluser->name = $insert['tendonvi'];
                $modeluser->phone = $insert['dienthoai'];
                $modeluser->username = $insert['username'];
                $modeluser->password = md5($insert['password']);
                $modeluser->status = 'Kích hoạt';
                $modeluser->level = 'DVVT';
                $modeluser->mahuyen = $insert['masothue'];
                $modeluser->save();
            }
            return redirect('dn_dichvu_vantai');
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {

            $model = DonViDvVt::findOrFail($id);
            $setting = $model->setting;
            return view('system.dndvvt.edit')
                ->with('model',$model)
                ->with('setting',json_decode($setting))
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp dịch vụ vận tải');

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = DonViDvVt::findOrFail($id);

            $model->tendonvi = $input['tendonvi'];
            $model->masothue = $input['masothue'];
            $model->diachi = $input['diachi'];
            $model->dienthoai = $input['dienthoai'];
            $model->fax = $input['fax'];
            $model->dknopthue= $input['dknopthue'];
            $model->giayphepkd = $input['giayphepkd'];
            $model->chucdanh = $input['chucdanh'];
            $model->nguoiky = $input['nguoiky'];
            $model->diadanh = $input['diadanh'];

            $input['roles'] = isset($input['roles']) ? $input['roles'] : null;
            $model->setting = json_encode($input['roles']);

            $model->toado = getAddMap($input['diachi']);
            //$model->tailieu =$insert['tailieu'];
            $model->email = '';
            $model->save();

            return redirect('dn_dichvu_vantai');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = DonViDvVt::findOrFail($id);
            $model->delete();

            return redirect('dn_dichvu_vantai');

        }else
            return view('errors.notlogin');
    }
}
