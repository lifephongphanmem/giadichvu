<?php

namespace App\Http\Controllers;

use App\GeneralConfigs;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class GeneralConfigsController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {
            $model = GeneralConfigs::first();

            return view('system.general.index')
                ->with('model',$model)
                ->with('pageTitle','Cấu hình hệ thống');

        }else
            return view('errors.notlogin');
    }
    public function edit($id)
    {
        if (Session::has('admin')) {
            $model = GeneralConfigs::findOrFail($id);

            return view('system.general.edit')
                ->with('model',$model)
                ->with('pageTitle','Chỉnh sửa cấu hình hệ thống');

        }else
            return view('errors.notlogin');
    }
    public function update(Request $request,$id)
    {
        if (Session::has('admin')) {
            $update = $request->all();
            $model = GeneralConfigs::findOrFail($id);
                if(isset($update['sodvlt']))
                    $model->sodvlt = $update['sodvlt'];
                if(isset($update['sodvvt']))
                    $model->sodvvt = $update['sodvvt'];
                if(isset($update['ttlhlt']))
                    $model->ttlhlt = $update['ttlhlt'];
                if(isset($update['ttlhvt']))
                    $model->ttlhvt = $update['ttlhvt'];
                $model->save();

            return redirect('cau_hinh_he_thong');

        }else
            return view('errors.notlogin');
    }


}
