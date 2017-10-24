<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DoiTuongApDungDvLt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtDf;
use App\TtCsKdDvLt;
use App\TtPhong;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaDvLt45sController extends Controller
{
    public function create($macskd){

        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                    $modelttp = TtCsKdDvLt::where('macskd',$macskd)
                        ->get();

                    $modeldtad = DoiTuongApDungDvLt::where('macskd',$macskd)
                        ->get();
                    $modelctdf = KkGDvLtCtDf::where('macskd',$macskd)->delete();
                    $modelcb = CbKkGDvLt::where('macskd',$macskd)
                        ->first();
                    //dd($modelcb);
                    if(isset($modelcb)){
                        $modelph = KkGDvLtCt::where('mahs',$modelcb->mahs)
                            ->get();
                        foreach($modelph as $ttph){
                            $dsph = new KkGDvLtCtDf();
                            $dsph->macskd = $ttph->macskd;
                            $dsph->maloaip = $ttph->maloaip;
                            $dsph->loaip = $ttph->loaip;
                            $dsph->qccl = $ttph->qccl;
                            $dsph->sohieu = $ttph->sohieu;
                            $dsph->ghichu = $ttph->ghichu;
                            $dsph->mucgialk = $ttph->mucgiakk;
                            $dsph->mucgiakk = $ttph->mucgiakk;
                            $dsph->tendoituong = $ttph->tendoituong;
                            $dsph->apdung = $ttph->apdung;
                            $dsph->ghichu = $ttph->ghichu;
                            $dsph->save();
                        }
                    }

                    $modelttdv = KkGDvLtCtDf::where('macskd',$macskd)
                        ->get();
                    //dd($modelttdv);
                    $ngaynhap = date('Y-m-d');
                    $dayngaynhap = date('D');
                    if($dayngaynhap == 'Thu'){
                        $ngayhieuluc  =  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+5, date("Y")));
                    }elseif($dayngaynhap == 'Fri') {
                        $ngayhieuluc  =  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+5, date("Y")));
                    }elseif( $dayngaynhap == 'Sat'){
                        $ngayhieuluc  =  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+4, date("Y")));
                    }else {
                        $ngayhieuluc  =  date('Y-m-d',mktime(0, 0, 0, date("m")  , date("d")+3, date("Y")));
                    }
                    $ngaynhap = date('d/m/Y',strtotime($ngaynhap));
                    $ngayhieuluc =  date('d/m/Y',strtotime($ngayhieuluc));

                    return view('manage.dvlt.kkgia.kkgia45s.create')
                        ->with('modelcskd',$modelcskd)
                        ->with('modelttp',$modelttp)
                        ->with('modeldtad',$modeldtad)
                        ->with('modelttdv',$modelttdv)
                        ->with('ngaynhap',$ngaynhap)
                        ->with('ngayhieuluc',$ngayhieuluc)
                        ->with('modelcb',$modelcb)
                        ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                }else{
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }
    //add ttp
    public function store(Request $request){
        if (Session::has('admin')) {
            $mahs = getdate()[0];
            $insert = $request->all();
            $model = new KkGDvLt();
            $model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaynhap'])));
            $model->mahs = $mahs;
            $model->socv = $insert['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngayhieuluc'])));
            $model->socvlk = $insert['socvlk'];
            if($insert['ngaycvlk'] != '')
                $model->ngaycvlk = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaycvlk'])));
            $model->trangthai = 'Chờ chuyển';
            $model->macskd = $insert['macskd'];
            $model->masothue = $insert['masothue'];
            $model->ghichu = $insert['ghichu'];
            $model->cqcq = $insert['cqcq'];
            $model->dvt = $insert['dvt'];
            $model->phanloai = 'DT';
            $model->plhs = $insert['plhs'];
            if($model->save()){
                $modelph = KkGDvLtCtDf::where('macskd',$insert['macskd'])
                    ->get();
                foreach($modelph as $ph){
                    $modelgiaph = new KkGDvLtCt();
                    $modelgiaph->maloaip = $ph->maloaip;
                    $modelgiaph->loaip = $ph->loaip;
                    $modelgiaph->qccl = $ph->qccl;
                    $modelgiaph->sohieu = $ph->sohieu;
                    $modelgiaph->tendoituong = $ph->tendoituong;
                    $modelgiaph->apdung = $ph->apdung;
                    $modelgiaph->ghichu = $ph->ghichu;
                    $modelgiaph->macskd = $ph->macskd;
                    $modelgiaph->mucgialk = $ph->mucgialk;
                    $modelgiaph->mucgiakk = $ph->mucgiakk;
                    $modelgiaph->tendoituong = $ph->tendoituong;
                    $model->apdung = $ph->apdung;
                    $modelgiaph->mahs = $mahs;
                    $modelgiaph->save();
                }
            }
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$insert['macskd'].'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                    $model = KkGDvLt::findOrFail($id);
                    $modelttp  = KkGDvLtCt::where('mahs',$model->mahs)
                        ->get();
                    $modelloaip = TtCsKdDvLt::where('macskd',$model->macskd)
                        ->get();
                    $modeldtad = DoiTuongApDungDvLt::where('macskd',$model->macskd)
                        ->get();
                    $modecb = CbKkGDvLt::where('macskd',$model->macskd)->first();

                    return view('manage.dvlt.kkgia.kkgia45s.edit')
                        ->with('model',$model)
                        ->with('modelcb',$modecb)
                        ->with('modeldtad',$modeldtad)
                        ->with('modelttp',$modelttp )
                        ->with('modelloaip',$modelloaip)
                        ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú chỉnh sửa');

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function update($id,Request $request){
        if (Session::has('admin')) {
            $insert = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaynhap'])));
            $model->socv = $insert['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngayhieuluc'])));
            $model->socvlk = $insert['socvlk'];
            if($insert['ngaycvlk'] != '')
                $model->ngaycvlk = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaycvlk'])));
            $model->macskd = $insert['macskd'];
            $model->ghichu = $insert['ghichu'];
            $model->dvt = $insert['dvt'];
            $model->plhs = $insert['plhs'];
            $model->save();
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$insert['macskd'].'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }
}
