<?php

namespace App\Http\Controllers;

use App\TtNgayNghiLe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TtNgayNghiLeController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $model = TtNgayNghiLe::whereYear('ngaytu', $inputs['nam'])->get();
            return view('manage.ttngaynghile.index')
                ->with('model',$model)
                ->with('nam',$inputs['nam'])
                ->with('pageTitle','Thông tin ngày nghỉ lễ');
        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            $arraynn = getSoNnSelectOptions();
            return view('manage.ttngaynghile.create')
                ->with('arraynn',$arraynn)
                ->with('pageTitle','Thêm mới thông tin ngày nghỉ lễ');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['ngaytu'] = getDateToDb($inputs['ngaytu']);
            $inputs['ngayden'] = getDateToDb($inputs['ngayden']);
            $model = new TtNgayNghiLe();
            $model->create($inputs);
            return redirect('thongtinngaynghile');
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = TtNgayNghiLe::find($id);
            $arraynn = getSoNnSelectOptions();
            return view('manage.ttngaynghile.edit')
                ->with('model',$model)
                ->with('arraynn',$arraynn)
                ->with('pageTitle','Thêm mới thông tin ngày nghỉ lễ');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = TtNgayNghiLe::find($id);
            $inputs['ngaytu'] = getDateToDb($inputs['ngaytu']);
            $inputs['ngayden'] = getDateToDb($inputs['ngayden']);
            $model->update($inputs);
            return redirect('thongtinngaynghile');
        }else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = TtNgayNghiLe::find($id)->delete();
            return redirect('thongtinngaynghile');
        }else
            return view('errors.notlogin');
    }

}
