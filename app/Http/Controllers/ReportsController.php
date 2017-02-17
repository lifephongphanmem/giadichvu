<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvLt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function kkgdvlt($mahs){
        if (Session::has('admin')) {
            //dd($id);
            $modelkk = KkGDvLt::where('mahs',$mahs)->first();
            //dd($modelkk);
            $modeldn = DnDvLt::where('masothue',$modelkk->masothue)
                ->first();
            //dd($modeldn);
            //dd($modelkk->masothue);
            $modelcskd = CsKdDvLt::where('macskd',$modelkk->macskd)
                ->first();
            $modelkkct = KkGDvLtCt::where('mahs',$modelkk->mahs)
                ->get();
            $modelcqcq = DmDvQl::where('maqhns',$modeldn->cqcq)
                ->first();
            return view('reports.kkgdvlt.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }
    public function dvltbc1(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            if(session('admin')->level == 'T') {
                $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                    ->OrWhere('trangthai', 'Duyệt')
                    ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cqcq',$input['cqcq'])
                    ->orderBy('id')
                    ->get();
                $modelcqcq = DmDvQl::where('maqhns',$input['cqcq'])
                    ->first();

            }else {
                $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                    ->OrWhere('trangthai', 'Duyệt')
                    ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cqcq',session('admin')->cqcq)
                    ->orderBy('id')
                    ->get();
                $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)
                    ->first();
            }
            //dd($model);
            foreach($model as $kk){
                $modelcskd = CsKdDvLt::where('macskd',$kk->macskd)->first();
                $kk->tencskd = $modelcskd->tencskd;
                $kk->diachikd = $modelcskd->diachikd;
                $kk->telkd = $modelcskd->telkd;
                $kk->loaihang = $modelcskd->loaihang;

            }



            return view('reports.kkgdvlt.bcth.BC1')
                ->with('$modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }
    public function dvltbc2(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            if(session('admin')->level == 'T'){
                $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                    ->OrWhere('trangthai', 'Duyệt')
                    ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cqcq',$input['cqcq'])
                    ->orderBy('id')
                    ->get();
                $modelcqcq = DmDvQl::where('maqhns',$input['cqcq'])
                    ->first();
            }else {
                $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                    ->OrWhere('trangthai', 'Duyệt')
                    ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cqcq',session('admin')->cqcq)
                    ->orderBy('id')
                    ->get();
                $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)
                    ->first();
                //dd($model);
            }
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
                ->get();


            return view('reports.kkgdvlt.bcth.BC2')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }
}
