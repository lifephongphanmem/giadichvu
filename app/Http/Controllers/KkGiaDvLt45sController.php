<?php

namespace App\Http\Controllers;

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
                    //dd($modelttp);
                    $modelctdf = KkGDvLtCtDf::where('macskd',$macskd)->delete();
                    return view('manage.dvlt.kkgia.kkgia45s.create')
                        ->with('modelcskd',$modelcskd)
                        ->with('modelttp',$modelttp)
                        ->with('modeldtad',$modeldtad)
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
            if($model->save()){
                $modelph = KkGDvLtCtDf::where('macskd',$insert['macskd'])
                    ->get();
                foreach($modelph as $ph){
                    $modelgiaph = new KkGDvLtCt();
                    $modelgiaph->maloaip = $ph->maloaip;
                    $modelgiaph->loaip = $ph->loaip;
                    $modelgiaph->qccl = $ph->qccl;
                    $modelgiaph->sohieu = $ph->sohieu;
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
                    $modelttp  = TtCsKdDvLt::where('macskd',$model->macskd)
                        ->get();
                    $modeldtad = DoiTuongApDungDvLt::where('macskd',$model->macskd)
                        ->get();

                    return view('manage.dvlt.kkgia.kkgia45s.edit')
                        ->with('model',$model)
                        ->with('modeldtad',$modeldtad)
                        ->with('modelttp',$modelttp )
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
            $model->save();
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$insert['macskd'].'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }
}
