<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnTaCn;
use App\KkGDvGs;
use App\KkGDvGsCt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtH;
use App\KkGDvTaCn;
use App\KkGDvTaCnCt;
use App\TtNgayNghiLe;
use App\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Maatwebsite\Excel;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class ReportsController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = DmDvQl::where('plql','TC')->get();
            if(session('admin')->level=='T'){
                $model_donvi = dndvlt::select('tendn','masothue')->get();
                $model_cskd = CsKdDvLt::select('tencskd','macskd')->get();
            }else{
                $model_donvi = dndvlt::select('tendn','masothue')->where('cqcq',session('admin')->cqcq)->get();
                $arraymasothue = '[]';
                foreach($model_donvi as $masothue){
                    $arraymasothue = $arraymasothue.$masothue->masothue.',';
                }
                $model_cskd = CsKdDvLt::whereIn('masothue',explode(',',$arraymasothue))
                    ->select('tencskd','macskd')->get();
            }

            return view('reports.kkgdvlt.bcth.index')
                ->with('model',$model)
                ->with('model_donvi',$model_donvi)
                ->with('model_cskd',$model_cskd)
                ->with('pageTitle', 'Báo cáo tổng hợp dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

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
                ->orderBy('loaip', 'asc')
                ->orderBy('id', 'asc')
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

    public function kkgdgs($mahs){
        if (Session::has('admin')) {
            $modelkk = KkGDvGs::where('mahs',$mahs)->first();
            $modeldn = DnDvGs::where('masothue',$modelkk->masothue)->first();
            $modelcqcq = DmDvQl::where('maqhns',$modelkk->cqcq)->first();
            $modelkkct = KkGDvGsCt::where('mahs',$mahs)->get();
            //dd($modelcqcq);
            return view('reports.kkgdvgs.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelcqcq',$modelcqcq)
                ->with('modelkkct',$modelkkct)
                ->with('pageTitle','Kê khai giá mặt hàng sữa');

        }else
            return view('errors.notlogin');
    }

    public function kkgdvtacn($mahs){
        if (Session::has('admin')) {
            $modelkk = KkGDvTaCn::where('mahs',$mahs)->first();
            $modeldn = DnTaCn::where('masothue',$modelkk->masothue)->first();
            $modelcqcq = DmDvQl::where('maqhns',$modelkk->cqcq)->first();
            $modelkkct = KkGDvTaCnCt::where('mahs',$mahs)->get();
            //dd($modelcqcq);
            return view('reports.kkgdvtacn.print')
                ->with('modelkk',$modelkk)
                ->with('modeldn',$modeldn)
                ->with('modelcqcq',$modelcqcq)
                ->with('modelkkct',$modelkkct)
                ->with('pageTitle','Kê khai giá thức ăn chăn nuôi');

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

    public function dvltbc1_excel(Request $request){
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
            Excel::create('BaoCao1',function($excel) use($modelcqcq,$input,$model,$m_cqcq){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$input,$model,$m_cqcq){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC1')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('input',$input)
                        ->with('model',$model)
                        ->with('m_cqcq',$m_cqcq)
                        ->with('pageTitle','Báo cáo thống kê');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    $sheet->setWidth('C', 10);
                    $sheet->setWidth('D', 30);
                    $sheet->setWidth('E', 15);
                    $sheet->setWidth('F', 15);
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');

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
            //$model=$this->get_KKG_TH($input);

            if(session('admin')->level == 'T'){//Kết xuất báo cáo quyền Tỉnh
                if($input['cqcq']=='all'&&$input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }elseif($input['cqcq']=='all'&&$input['loaihang']!='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cskddvlt.loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }elseif($input['cqcq']!='all'&&$input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',$input['cqcq'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }else{
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',$input['cqcq'])
                        ->where('loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }
            }else{//Kết xuất báo cáo quyền Huyện
                if($input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',session('admin')->cqcq)
                        ->orderBy('ngaychuyen')
                        ->get();
                }else{
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',session('admin')->cqcq)
                        ->where('loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }
            }

            $mahss = '';
            foreach($model as $kk){
                $mahss = $mahss.$kk->mahs.',';
            }
            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))->get();

            foreach($modelctkk as $ttct){
                if($ttct->mucgialk>0) {
                    if ($ttct->mucgialk > $ttct->mucgiakk) {
                        $ttct->muctg = '-' . ($ttct->mucgialk - $ttct->mucgiakk);
                        $ttct->muctgpt = '-' . round(($ttct->mucgialk - $ttct->mucgiakk) / $ttct->mucgialk * 100, 2) . '%';
                    }else {
                        $ttct->muctg = $ttct->mucgiakk - $ttct->mucgialk;
                        $ttct->muctgpt = round(($ttct->mucgiakk - $ttct->mucgialk) / $ttct->mucgiakk * 100, 2) . '%';
                    }
                }
            }

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

    public function dvltbc2_excel(Request $request){
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
            //$model=$this->get_KKG_TH($input);
            if(session('admin')->level == 'T'){//Kết xuất báo cáo quyền Tỉnh
                if($input['cqcq']=='all'&&$input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }elseif($input['cqcq']=='all'&&$input['loaihang']!='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }elseif($input['cqcq']!='all'&&$input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',$input['cqcq'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }else{
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',$input['cqcq'])
                        ->where('loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }
            }else{//Kết xuất báo cáo quyền Huyện
                if($input['loaihang']=='all'){
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',session('admin')->cqcq)
                        ->orderBy('ngaychuyen')
                        ->get();
                }else{
                    $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                        ->OrWhere('trangthai', 'Duyệt')
                        ->whereMonth('ngaychuyen',$input['thang'])
                        ->whereYear('ngaychuyen',$input['nam'])
                        ->where('cqcq',session('admin')->cqcq)
                        ->where('loaihang', $input['loaihang'])
                        ->orderBy('ngaychuyen')
                        ->get();
                }
            }

            $mahss = '';
            foreach($model as $kk){
                $mahss = $mahss.$kk->mahs.',';
            }
            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))->get();

            foreach($modelctkk as $ttct){
                if($ttct->mucgialk>0) {
                    if ($ttct->mucgialk > $ttct->mucgiakk) {
                        $ttct->muctg = '-' . ($ttct->mucgialk - $ttct->mucgiakk);
                        $ttct->muctgpt = '-' . round(($ttct->mucgialk - $ttct->mucgiakk) / $ttct->mucgialk * 100, 2) . '%';
                    }else {
                        $ttct->muctg = $ttct->mucgiakk - $ttct->mucgialk;
                        $ttct->muctgpt = round(($ttct->mucgiakk - $ttct->mucgialk) / $ttct->mucgiakk * 100, 2) . '%';
                    }
                }
            }

            Excel::create('BaoCao2',function($excel) use($modelcqcq,$input,$model,$m_cqcq,$modelctkk){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$input,$model,$m_cqcq,$modelctkk){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC2')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('input',$input)
                        ->with('model',$model)
                        ->with('m_cqcq',$m_cqcq)
                        ->with('modelctkk',$modelctkk)
                        ->with('pageTitle','Báo cáo');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');

        }else
            return view('errors.notlogin');
    }

    public function dvltbc3(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();

            $m_donvi = DnDvLt::where('masothue',$input['masothue'])->first();
            $modelcqcq = DmDvQl::where('maqhns',$m_donvi->cqcq)->first();
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

    public function dvltbc3_excel(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $m_donvi = DnDvLt::where('masothue',$input['masothue'])->first();
            $modelcqcq = DmDvQl::where('maqhns',$m_donvi->cqcq)->first();
            $model=$this->get_KKG_CT($input);

            Excel::create('BaoCao3',function($excel) use($modelcqcq,$input,$model,$m_donvi){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$input,$model,$m_donvi){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC3')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('input',$input)
                        ->with('model',$model)
                        ->with('m_donvi',$m_donvi)
                        ->with('pageTitle','Báo cáo');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc4(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();

            $m_donvi = DnDvLt::where('masothue',$input['masothue'])->first();
            $modelcqcq = DmDvQl::where('maqhns',$m_donvi->cqcq)->first();
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

    public function dvltbc4_excel(Request $request){
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

            Excel::create('BaoCao4',function($excel) use($modelcqcq,$input,$model,$m_donvi,$modelctkk){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$input,$model,$m_donvi,$modelctkk){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC4')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('input',$input)
                        ->with('model',$model)
                        ->with('modelctkk',$modelctkk)
                        ->with('m_donvi',$m_donvi)
                        ->with('pageTitle','Báo cáo');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');

        }else
            return view('errors.notlogin');
    }

    public function dvltbc5(Request $request){
        if (Session::has('admin')) {
            /*$input = $request->all();
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


            //1.sau này triển khai bỏ vì đã làm trong form nhập
            foreach($model as $ct){
                $ngaynhan = Carbon::parse($ct->ngaynhan);
                $ngaychuyen = Carbon::parse($ct->ngaychuyen);
                $ngay= $ngaynhan->diff($ngaychuyen)->days;
                $modelchecknn = TtNgayNghiLe::where('ngaytu','<=',$ngaychuyen)
                    ->where('ngayden','>=',$ngaychuyen)->first();
                if(count($modelchecknn)>0){
                    $thoihan_lt= getGeneralConfigs()['thoihan_lt'] + $modelchecknn->songaynghi;
                }else{
                    $thoihan_lt= getGeneralConfigs()['thoihan_lt'];
                }

                if($ngay<$thoihan_lt){
                    $ct->thoihan='Trước thời hạn';
                }elseif($ngay==$thoihan_lt){
                    $ct->thoihan='Đúng thời hạn';
                }else{
                    $ct->thoihan='Quá thời hạn';
                }
            }
            //end 1.sau này triển khai bỏ vì đã làm trong form nhập

            if($input['thoihan']!='all'){
                $model=$model->where('thoihan', $input['thoihan']);
            }*/
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

            /*if($input['trangthai']!='all'){
                $model=$model->where('trangthai', $input['trangthai']);
            }*/
            if($input['thoihan']!='all'){
                $model=$model->where('thoihan', $input['thoihan']);
            }
            return view('reports.kkgdvlt.bcth.BC5')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('m_cqcq',$m_cqcq)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc5_excel(Request $request){
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

            /*if($input['trangthai']!='all'){
                $model=$model->where('trangthai', $input['trangthai']);
            }*/
            if($input['thoihan']!='all'){
                $model=$model->where('thoihan', $input['thoihan']);
            }


            Excel::create('BaoCao5',function($excel) use($modelcqcq,$input,$model,$m_cqcq){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$input,$model,$m_cqcq){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC5')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('input',$input)
                        ->with('model',$model)
                        ->with('m_cqcq',$m_cqcq)
                        ->with('pageTitle','Báo cáo thống kê');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    $sheet->setWidth('C', 10);
                    $sheet->setWidth('D', 30);
                    $sheet->setWidth('E', 15);
                    $sheet->setWidth('F', 15);
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');

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
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }elseif($input['cqcq']=='all'&&$input['loaihang']!='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }elseif($input['cqcq']!='all'&&$input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
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
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->where('trangthai', 'Chờ duyệt')
                    ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                    ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
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
                ->orderBy('kkgdvlt.ngaychuyen')
                ->get();
        }else{
            $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                ->where('trangthai', 'Chờ duyệt')
                ->OrWhere('kkgdvlt.trangthai', 'Duyệt')
                ->where('kkgdvlt.masothue',$input['masothue'])
                ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->where('cskddvlt.loaihang', $input['loaihang'])
                ->orderBy('kkgdvlt.ngaychuyen')
                ->get();
        }

        return $model;
    }

    //dữ liệu hồ sơ giải quyết
    function get_KKG_GQ($input){
        if(session('admin')->level == 'T'){//Kết xuất báo cáo quyền Tỉnh
            if($input['cqcq']=='all'&&$input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }elseif($input['cqcq']=='all'&&$input['loaihang']!='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }elseif($input['cqcq']!='all'&&$input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('kkgdvlt.cqcq',$input['cqcq'])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }
        }else{//Kết xuất báo cáo quyền Huyện
            if($input['loaihang']=='all'){
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }else{
                $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                    ->select('cskddvlt.tencskd','cskddvlt.diachikd','cskddvlt.telkd','cskddvlt.loaihang','kkgdvlt.*')
                    ->Where('kkgdvlt.trangthai', 'Duyệt')
                    ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                    ->whereBetween('kkgdvlt.ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                    ->where('cskddvlt.loaihang', $input['loaihang'])
                    ->orderBy('kkgdvlt.ngaychuyen')
                    ->get();
            }
        }

        return $model;
    }

    public function dvltbc6(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $modelcqcq = DmDvQl::where('maqhns',$inputs['cqcq'])->first();
            $model=$this->getvalBc6($inputs);

            return view('reports.kkgdvlt.bcth.BC6')
                ->with('modelcqcq',$modelcqcq)
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo đơn vị kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function getvalBc6($inputs){
        /*if($inputs['phanloai'] == 'DKK'){
            $model = KkGDvLt::where('trangthai','Duyệt')
                ->where('ngayduyet',[$inputs['ngaytu'],$inputs['ngayden']])
                ->where('')

        }elseif($inputs['phanloai'] == 'CKK'){

        }else{*/
            $model = CsKdDvLt::where('cqcq',$inputs['cqcq'])->get();
            foreach($model as $ttks){
                $modelkk = KkGDvLt::where('trangthai','Duyệt')
                    ->whereBetween('ngaynhan',[$inputs['ngaytu'],$inputs['ngayden']])
                    ->where('masothue',$ttks->masothue)
                    ->count();
                $modelkkmn = CbKkGDvLt::whereBetween('ngaynhan',[$inputs['ngaytu'],$inputs['ngayden']])
                    ->where('masothue',$ttks->masothue)
                    ->first();
                $ttks->lankk = $modelkk;
                if($modelkk == 0)
                    $ttks->kklc = 'Chưa kê khai';
                else
                    $ttks->kklc = $modelkkmn['socv'].', ngày hiệu lực: '. getDayVn($modelkkmn['ngayhieuluc']);
            }
            if($inputs['phanloai'] != 'all'){
                if($inputs['phanloai'] == 'CKK')
                    $model = $model->where('kklc','Chưa kê khai');
            }
        //}

        return $model;
    }

    public function dvltbc6_excel(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $modelcqcq = DmDvQl::where('maqhns',$inputs['cqcq'])->first();
            $model=$this->getvalBc6($inputs);

            Excel::create('BaoCao6',function($excel) use($modelcqcq,$inputs,$model){
                $excel->sheet('New sheet', function($sheet) use($modelcqcq,$inputs,$model){
                    $sheet->loadView('reports.kkgdvlt.bcth.BC6')
                        ->with('modelcqcq',$modelcqcq)
                        ->with('inputs',$inputs)
                        ->with('model',$model)
                        ->with('pageTitle','BcDvKkGDvlt');
                    //$sheet->setPageMargin(0.25);
                    $sheet->setAutoSize(false);
                    $sheet->setFontFamily('Tahoma');
                    $sheet->setFontBold(false);

                    $sheet->setWidth('C', 10);
                    $sheet->setWidth('D', 30);
                    $sheet->setWidth('E', 15);
                    $sheet->setWidth('F', 15);
                    $sheet->setWidth('G', 15);
                    $sheet->setWidth('H', 15);
                    $sheet->setWidth('I', 15);
                    //$sheet->setColumnFormat(array('D' => '#,##0.00'));
                });
            })->download('xls');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc7(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            $modelcqcq = DmDvQl::where('maqhns',$input['cqcq'])->first();
            $modelgr = KkGDvLtH::where('cqcq',$input['cqcq'])
                ->where('action','Nhận hồ sơ')
                ->whereMonth('ngaynhan',$input['thang'])
                ->whereYear('ngaynhan',$input['nam'])
                ->select('username')
                ->GroupBy('username')
                ->get();
            foreach($modelgr as $gr){
                $name = Users::where('username',$gr->username)
                    ->first();
                $gr->name = $name->name;
            }
            $model = KkGDvLtH::where('cqcq',$input['cqcq'])
                ->where('action','Nhận hồ sơ')
                ->whereMonth('ngaynhan',$input['thang'])
                ->whereYear('ngaynhan',$input['nam'])
                ->get();

            return view('reports.kkgdvlt.bcth.BC7')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelgr',$modelgr)
                ->with('pageTitle','Báo cáo xét duyệt hồ sơ kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc8(Request $request){
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

            return view('reports.kkgdvlt.bcth.BC8')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('m_cqcq',$m_cqcq)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc9(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $m_cskd = CsKdDvLt::where('macskd',$input['macskd'])->first();
            $cqcq = DnDvLt::where('masothue',$m_cskd->masothue)->first();

            $modelcqcq = DmDvQl::where('maqhns',$cqcq->cqcq)->first();

            $model = KkGDvLt::where('trangthai', 'Chờ duyệt')
                ->OrWhere('trangthai', 'Duyệt')
                ->where('macskd',$input['macskd'])
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->orderBy('ngaychuyen')
                ->get();

            $mahss = '';
            foreach($model as $kk){
                $mahss = $mahss.$kk->mahs.',';
            }
            $modelctkk = KkGDvLtCt::whereIn('mahs',explode(',',$mahss))->get();
            return view('reports.kkgdvlt.bcth.BC9')
                ->with('modelcqcq',$modelcqcq)
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('m_cskd',$m_cskd)
                ->with('pageTitle','Báo cáo chi tiết hồ sơ kê khai giá');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc10(){
        if (Session::has('admin')) {
            $model = CsKdDvLt::join('dndvlt','dndvlt.masothue','=','cskddvlt.masothue')
                ->select('dndvlt.tendn','dndvlt.masothue','cskddvlt.tencskd','cskddvlt.updated_at','cskddvlt.ghichu')
                ->where('cskddvlt.ghichu','Dừng hoạt động')->get();
            return view('reports.kkgdvlt.bcth.BC10')
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thông tin cơ sở kinh doanh dừng hoạt động');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc11(){
        if (Session::has('admin')) {
            $model = CsKdDvLt::join('dndvlt','dndvlt.masothue','=','cskddvlt.masothue')
                ->select('dndvlt.tendn','dndvlt.masothue','cskddvlt.tencskd','cskddvlt.updated_at','cskddvlt.ghichu')
                ->get();
            return view('reports.kkgdvlt.bcth.BC11')
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thông tin cơ sở kinh doanh dừng hoạt động');
        }else
            return view('errors.notlogin');
    }

    public function dvltbc12(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLtH::join('cskddvlt','cskddvlt.macskd','=','kkgdvlth.macskd')
                ->join('dndvlt','cskddvlt.masothue','=','dndvlt.masothue')
                ->whereBetween('kkgdvlth.created_at', [$input['ngaytu'], $input['ngayden']])
                ->where('kkgdvlth.action','Trả lại hồ sơ')
                ->select('kkgdvlth.*','dndvlt.tendn','cskddvlt.tencskd')
                ->get();
            return view('reports.kkgdvlt.bcth.BC12')
                ->with('model',$model)
                ->with('input',$input)
                ->with('pageTitle','Báo cáo hồ sơ kê khai giá bị trả lại');
        }else
            return view('errors.notlogin');
    }
}
