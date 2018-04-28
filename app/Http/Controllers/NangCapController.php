<?php

namespace App\Http\Controllers;

use App\CbKkDvGs;
use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DnDvLt;
use App\KkGDvLt;
use App\KkGDvLtH;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NangCapController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            if (session('admin')->username == 'minhtran') {
                $inputs = $request->all();
                $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');

                $model = KkGDvLtH::whereMonth('ngaynhap',$inputs['thang'])
                    ->whereYear('ngaynhap', $inputs['nam'])
                    ->get();

                return view('manage.nangcap.index')
                    ->with('model', $model)
                    ->with('thang', $inputs['thang'])
                    ->with('nam', $inputs['nam'])
                    ->with('pageTitle', 'Nâng cấp Db');
            }else
                dd('Không đủ quyền');

        }else
            return view('errors.notlogin');
    }

    public function nangcapdl(Request $request){
        $inputs = $request->all();
        $model = KkGDvLtH::whereMonth('ngaynhap',$inputs['thang'])
            ->whereYear('ngaynhap', $inputs['nam'])
            ->get();
        foreach($model as $tt){
            $modeldn = DnDvLt::where('masothue',$tt->masothue)->first();
            $modelcskd = CsKdDvLt::where('macskd',$tt->macskd)->first();
            $modelup = KkGDvLtH::where('id',$tt->id)->first();

            $modelup->tendn = isset($modeldn) ? $modeldn->tendn : 'Chưa xác định';
            $modelup->tencskd = isset($modelcskd) ? $modelcskd->tencskd : 'Chưa xác định';
            $modelup->loaihang = isset($modelcskd) ?$modelcskd->loaihang : 'Chưa xác định';
            $modelup->save();
        }
        return redirect('nangcap?&thang='.$inputs['thang'].'&nam='.$inputs['nam']);

    }
}
