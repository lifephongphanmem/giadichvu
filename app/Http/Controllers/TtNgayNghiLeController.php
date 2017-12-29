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
}
