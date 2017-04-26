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
    public function index(){
        if (Session::has('admin')) {
            $model = DmDvQl::where('plql','TC')->get();
            if(session('admin')->level=='T'){
                $model_donvi = dndvlt::select('tendn','masothue')->get();
            }else{
                $model_donvi = dndvlt::select('tendn','masothue')->where('cqcq',session('admin')->cqcq)->get();
            }

            return view('reports.kkgdvlt.bcth.index')
                ->with('model',$model)
                ->with('model_donvi',$model_donvi)
                ->with('pageTitle', 'Báo cáo tổng hợp dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

    public function kkgdvltks($mahs){
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
            return view('reports.kkgdvlt.printks')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelkkct',$modelkkct)
                ->with('modelcqcq',$modelcqcq)
                ->with('pageTitle','Kê khai giá dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

    public function getttp($maloaip){


    }

    public function dvltbc1(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            if(session('admin')->level == 'T'){
                if($input['cqcq']=='all') {
                    $m_cqcq = DmDvQl::where('plql','TC')->get();
                    $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
                } else {
                    $m_cqcq = DmDvQl::where('maqhns',$input['cqcq'])->get();
                    $modelcqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
                }
            }else{
                $m_cqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->get();
                $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
            }

            $model=$this->get_KKG_TH($input);

            return view('reports.kkgdvlt.bcth.BC1')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('m_cqcq',$m_cqcq)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc2(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            //dd($input);
            if(session('admin')->level == 'T'){
                if($input['cqcq']=='all') {
                    $m_cqcq = DmDvQl::where('plql','TC')->get();
                    $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
                } else {
                    $m_cqcq = DmDvQl::where('maqhns',$input['cqcq'])->get();
                    $modelcqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
                }
            }else{
                $m_cqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->get();
                $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
            }
            $model=$this->get_KKG_TH($input);

            /*
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
            foreach($model as $kk){
                $modelcskd = CsKdDvLt::where('macskd',$kk->macskd)->first();
                $kk->tencskd = $modelcskd->tencskd;
                $kk->diachikd = $modelcskd->diachikd;
                $kk->telkd = $modelcskd->telkd;
                $kk->loaihang = $modelcskd->loaihang;
                $mahss = $mahss.$kk->mahs.',';

            }
            */
            $mahss = '';
            foreach($model as $kk){
                $mahss = $mahss.$kk->mahs.',';
            }
            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))->get();

            return view('reports.kkgdvlt.bcth.BC2')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('m_cqcq',$m_cqcq)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc3(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
            $m_donvi = DnDvLt::where('masothue',$input['masothue'])->first();
            $model=$this->get_KKG_CT($input);

            return view('reports.kkgdvlt.bcth.BC3')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('m_donvi',$m_donvi)
                ->with('pageTitle','Báo cáo tổng hợp hồ sơ kê khai giá');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc4(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();

            $modelcqcq = DmDvQl::where('maqhns',session('admin')->cqcq)->first();
            $m_donvi = DnDvLt::where('masothue',$input['masothue'])->first();
            $model=$this->get_KKG_CT($input);

            $mahss = '';
            foreach($model as $kk){
                $mahss = $mahss.$kk->mahs.',';
            }
            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))->get();

            return view('reports.kkgdvlt.bcth.BC4')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('m_donvi',$m_donvi)
                ->with('pageTitle','Báo cáo chi tiết hồ sơ kê khai giá');
        }else
            return view('errors.notlogin');
    }

    //Lấy dữ liệu kê khai giá theo đơn vị chủ quản
    function get_KKG_TH($input){
        if(session('admin')->level == 'T'){//Kết xuất báo cáo quyền Tỉnh
            if($input['cqcq']=='all'&&$input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('kkgdvlt.trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }elseif($input['cqcq']=='all'&&$input['loaihang']!='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }elseif($input['cqcq']!='all'&&$input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }
        }else{//Kết xuất báo cáo quyền Huyện
            if($input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('kkgdvlt.trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngayhieuluc')
                    ->get();
            }
        }

        return $model;
    }

    //Lấy dữ liệu kê khai giá theo đơn vị kê khai giá
    function get_KKG_CT($input){
        if($input['loaihang']=='all'){
            $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                ->where('kkgdvlt.trangthai', 'Chờ duyệt')
                ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                ->where('kkgdvlt.masothue',$input['masothue'])
                ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->orderBy('kkgdvlt.ngayhieuluc')
                ->get();
        }else{
            $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                ->where('trangthai', 'Chờ duyệt')
                ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                ->where('kkgdvlt.masothue',$input['masothue'])
                ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->where('cskddvlt.loaihang', $input['loaihang'])
                ->orderBy('kkgdvlt.ngayhieuluc')
                ->get();
        }

        return $model;
    }
}
