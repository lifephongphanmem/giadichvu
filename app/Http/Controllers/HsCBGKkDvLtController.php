<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\KkGDvLt;
use App\KkGDvLtH;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HsCBGKkDvLtController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['thang'] = isset($inputs['thang']) ? $inputs['thang'] : date('m');
            $model = KkGDvLt::whereYear('ngaychuyen', $inputs['nam'])
                ->where('trangthai','Duyệt')
                ->whereMonth('ngaychuyen',$inputs['thang'])
                ->get();
            return view('manage.dvlt.kkgia.xetduyet.congbo.index')
                ->with('model',$model)
                ->with('nam',$inputs['nam'])
                ->with('thang',$inputs['thang'])
                ->with('pageTitle','Hồ sơ công bố kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function gettthuyduyetdvlt(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){

            $modelhs = KkGDvLt::where('id',$inputs['id'])
                ->first();
            $modelcskd = CsKdDvLt::where('macskd',$modelhs->macskd)->first();

            $result['message'] = '<div class="form-group" id="tthuyduyet"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modelcskd->tencskd.'</b> kê khai giá dịch vụ lưu trú số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '<input type="hidden" id="mahshuyduyet" name="mahshuyduyet" value="'.$modelhs->mahs.'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function huyduyet(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $mahs = $inputs['mahshuyduyet'];
            //dd($inputs);
            $model = KkGDvLt::where('mahs',$mahs)->first();
            //dd($model);
            $model->trangthai = 'Chờ nhận';
            if($model->save()){
                $modelcb = CbKkGDvLt::where('mahs',$mahs)->delete();
                $mahsh = getdate()[0];
                $his = new KkGDvLtH();
                $his->mahsh = $mahsh;
                $his->mahs = $model->mahs;
                $his->macskd = $model->macskd;
                $his->masothue = $model->masothue;
                $his->ngaynhap = $model->ngaynhap;
                $his->socv = $model->socv;
                $his->socvlk = $model->socvlk;
                $his->ngaycvlk = $model->ngaycvlk;
                $his->ngayhieuluc = $model->ngayhieuluc;
                $his->ttnguoinop = $model->ttnguoinop;
                $his->ghichu = $model->ghichu;
                $his->ngaychuyen = $model->ngaychuyen;
                $his->cqcq = $model->cqcq;
                $his->dvt = $model->dvt;
                $his->phanloai = $model->phanloai;
                $his->plhs =$model->plhs;
                $his->action = 'Huỷ duyệt hồ sơ';
                $his->save();
            }
            return redirect('hosocongbokekhaigiadvlt');
        }else
            return view('errors.notlogin');
    }

    public function getTTnHsedit(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkGDvLt::where('id',$inputs['id'])
                ->first();

            $result['message'] = '<div class="modal-body" id="ttnhanhsedit">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhanedit" name="sohsnhanedit" class="form-control" data-mask="fdecimal" value="'.$model->sohsnhan.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày nhận hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhanedit" name="ngaynhanedit" class="form-control"  value="'.$model->ngaynhan.'">';
            $result['message'] .= '</div>';
            /*$result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày hiệu lực</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngayhieulucedit" name="ngayhieulucedit" class="form-control"  value="'.$model->ngayhieuluc.'">';
            $result['message'] .= '</div>';*/
            $result['message'] .= '<input type="hidden" id="mahsedit" name="mahsedit" value="'.$model->mahs.'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function updatettnhs(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::where('mahs',$input['mahsedit'])->first();
            $model->ngaynhan = $input['ngaynhanedit'];
            $model->sohsnhan = $input['sohsnhanedit'];
            //$model->ngayhieuluc = $input['ngayhieulucedit'];
            if($model->save()){
                $modelcb = CbKkGDvLt::where('mahs',$input['mahsedit'])
                    ->first();
                $modelcb->ngaynhan = $input['ngaynhanedit'];
                $modelcb->sohsnhan = $input['sohsnhanedit'];
                //$modelcb->ngayhieuluc = $input['ngayhieulucedit'];
                $modelcb->save();
            }
            return redirect('hosocongbokekhaigiadvlt');
        }else
            return view('errors.notlogin');
    }
}
