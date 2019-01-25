<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DnDvLt;
use App\KkGDvLtH;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HoatDongCsKdController extends Controller
{
    public function ttcskd(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                if (session('admin')->sadmin == 'ssa') {
                    $model = CsKdDvLt::join('dndvlt','dndvlt.masothue','=','cskddvlt.masothue')
                        ->select('cskddvlt.*','dndvlt.tendn')
                        ->get();
                } else {
                    $model = CsKdDvLt::join('dndvlt','dndvlt.masothue','=','cskddvlt.masothue')
                        ->select('cskddvlt.*','dndvlt.tendn')
                        ->where('cskddvlt.cqcq', session('admin')->cqcq)
                        ->get();
                }
                return view('manage.dvlt.hoatdongcskd.cskd.index')
                    ->with('model', $model)
                    ->with('pageTitle', 'Thông tin cơ sở kinh doanh dịch vụ lưu trú');

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $model = KkGDvLtH::where('macskd',$inputs['macskd'])
                    ->get();

                $modelcskd = CsKdDvLt::where('macskd',$inputs['macskd'])->first();
                $modeldn = DnDvLt::where('masothue',$modelcskd->masothue)->first();


                return view('manage.dvlt.hoatdongcskd.hoatdong.index')
                    ->with('model', $model)
                    ->with('modelcskd',$modelcskd)
                    ->with('pageTitle', 'Thông tin cơ sở kinh doanh dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }
}
