<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function dvltbc1(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            /*$model = KkGDvLt::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            foreach($model as $kk){
                $modelcskd = CsKdDvLt::where('macskd',$kk->macskd)->first();
                $kk->tencskd = $modelcskd->tencskd;
                $kk->diachikd = $modelcskd->diachikd;
                $kk->telkd = $modelcskd->telkd;
                $kk->loaihang = $modelcskd->loaihang;

            }*/

            return view('reports.kkgdvlt.bcth.BC1')
                ->with('input',$input)
                //->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }
    public function dvltbc2(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            /*$model = KkGDvLt::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            $mahss = '';
            foreach($model as $kk){
                $modelcskd = CsKdDvLt::where('macskd',$kk->macskd)->first();
                $kk->tencskd = $modelcskd->tencskd;
                $kk->diachikd = $modelcskd->diachikd;
                $kk->telkd = $modelcskd->telkd;
                $kk->loaihang = $modelcskd->loaihang;
                $mahss = $mahss.$kk->mahs.',';

            }

            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))
                ->get();*/


            return view('reports.kkgdvlt.bcth.BC2')
                ->with('input',$input)
                //->with('model',$model)
                //->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }
}
