<?php

namespace App\Http\Controllers;


use App\DonViDvVt;
use App\KkDvVtKhac;
use App\KkDvVtKhacCt;
use App\KkDvVtXb;
use App\KkDvVtXbCt;
use App\KkDvVtXk;
use App\KkDvVtXkCt;
use App\KkDvVtXtx;
use App\KkDvVtXtxCt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReportsDvVtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexxk(){
        if (Session::has('admin')) {
            return view('reports.kkgdvvt.bcth.index')
                ->with('url','/bao_cao/dich_vu_xe_khach/')
                ->with('pageTitle','Báo cáo tổng hợp dịch vụ vận tải xe khách');
        }else
            return view('errors.notlogin');
    }

    public function dvxkbc1(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXk::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)){
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                }
            }

            return view('reports.kkgdvvt.bcth.dvxk.BC1')
                ->with('input',$input)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function dvxkbc2(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXk::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            $mahss = '';
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)) {
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                    $mahss = $mahss . $kk->masokk . ',';
                }
            }

            $modelctkk = KkDvVtXkCt::whereIn('masokk',explode(',',$mahss))
                ->get();


            return view('reports.kkgdvvt.bcth.dvxk.BC2')
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function indexxb(){
        if (Session::has('admin')) {
            return view('reports.kkgdvvt.bcth.index')
                ->with('url','/bao_cao/dich_vu_xe_bus/')
                ->with('pageTitle','Báo cáo tổng hợp dịch vụ vận tải xe bus');
        }else
            return view('errors.notlogin');
    }

    public function dvxbbc1(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXb::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)){
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                }
            }

            return view('reports.kkgdvvt.bcth.dvxb.BC1')
                ->with('input',$input)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function dvxbbc2(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXb::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            $mahss = '';
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)) {
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                    $mahss = $mahss . $kk->masokk . ',';
                }
            }

            $modelctkk = KkDvVtXbCt::whereIn('masokk',explode(',',$mahss))
                ->get();


            return view('reports.kkgdvvt.bcth.dvxb.BC2')
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function indexxtx(){
        if (Session::has('admin')) {
            return view('reports.kkgdvvt.bcth.index')
                ->with('url','/bao_cao/dich_vu_xe_taxi/')
                ->with('pageTitle','Báo cáo tổng hợp dịch vụ vận tải xe taxi');
        }else
            return view('errors.notlogin');
    }

    public function dvxtxbc1(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXtx::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)){
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                }
            }

            return view('reports.kkgdvvt.bcth.dvxtx.BC1')
                ->with('input',$input)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function dvxtxbc2(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtXtx::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            $mahss = '';
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)) {
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                    $mahss = $mahss . $kk->masokk . ',';
                }
            }

            $modelctkk = KkDvVtXtxCt::whereIn('masokk',explode(',',$mahss))
                ->get();


            return view('reports.kkgdvvt.bcth.dvxtx.BC2')
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function indexch(){
        if (Session::has('admin')) {
            return view('reports.kkgdvvt.bcth.index')
                ->with('url','/bao_cao/dich_vu_cho_hang/')
                ->with('pageTitle','Báo cáo tổng hợp dịch vụ vận tải chở hàng');
        }else
            return view('errors.notlogin');
    }

    public function dvchbc1(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtKhac::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)){
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                }
            }

            return view('reports.kkgdvvt.bcth.dvch.BC1')
                ->with('input',$input)
                ->with('model',$model)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }

    public function dvchbc2(Request $request){
        if (Session::has('admin')) {

            $input = $request->all();
            //dd($input);
            $model = KkDvVtKhac::where('trangthai','Chờ duyệt')
                ->OrWhere('trangthai','Duyệt')
                ->whereBetween('ngaychuyen', [$input['ngaytu'], $input['ngayden']])
                ->get();
            //dd($model);
            $mahss = '';
            foreach($model as $kk){
                $modeldv = DonViDvVt::where('masothue',$kk->masothue)->first();
                if(isset($modeldv)) {
                    $kk->tendonvi = $modeldv->tendonvi;
                    $kk->diachi = $modeldv->diachi;
                    $kk->dienthoai = $modeldv->dienthoai;
                    $mahss = $mahss . $kk->masokk . ',';
                }
            }

            $modelctkk = KkDvVtKhacCt::whereIn('masokk',explode(',',$mahss))->get();

            return view('reports.kkgdvvt.bcth.dvch.BC2')
                ->with('input',$input)
                ->with('model',$model)
                ->with('modelctkk',$modelctkk)
                ->with('pageTitle','Báo cáo thống kê các đơn vị kê khai giá trong khoảng thời gian');

        }else
            return view('errors.notlogin');
    }
}
