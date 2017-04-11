<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DmDvQl;
use App\GeneralConfigs;
use App\KkGDvLt;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class KkGDvLtXdController extends Controller
{
    public function index($thang,$nam,$pl){
        if (Session::has('admin')) {
            if($pl=='cho_nhan') {
                $trangthai = 'Chờ nhận';
                if(session('admin')->level == 'T'  & session('admin')->sadmin == 'ssa') {
                    $model = KkGDvLt::where('trangthai', $trangthai)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                }else{
                    $model = KkGDvLt::where('trangthai', $trangthai)
                        ->where('cqcq',session('admin')->cqcq)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                }
            }
            elseif($pl == 'cong_bo') {

                $trangthai = 'Công bố';
                $model = CbKkGDvLt::whereMonth('ngaynhan',$thang)
                    ->whereYear('ngaynhan', $nam)
                    ->get();
            }

            $modelcskd = CsKdDvLt::all();
            foreach($model as $ttkk){
                $this->getTTCSKD($modelcskd,$ttkk);
            }

            return view('manage.dvlt.kkgia.xetduyet.index')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('thang',$thang)
                ->with('pl',$pl)
                ->with('pageTitle','Thông tin cơ sở kinh doanh dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }
    public function getTTCSKD($cskds,$array){
        foreach($cskds as $cskd){
            if($cskd->masothue == $array->masothue && $cskd->macskd == $array->macskd){
                $array->tencskd = $cskd->tencskd;
            }
        }
    }

    public function tralai(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idtralai'];
            $model = KkGDvLt::findOrFail($id);
            if($input['lydo'] != '') {
                $model->lydo = $input['lydo'];
                $model->trangthai = 'Bị trả lại';
                $model->save();
            }
            return redirect('xet_duyet_ke_khai_dich_vu_luu_tru/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan');
        }else
            return view('errors.notlogin');
    }

    public function getTTnHs(Request $request){
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
            $model = DmDvQl::where('maqhns',$modelhs->cqcq)
                ->first();

            $stt = $model->sohsnhan + 1;
            $ngay = Carbon::now()->toDateString();

            $result['message'] = '<div class="modal-body" id="ttnhanhs">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="'.$stt.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày nhận hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="'.$ngay.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="'.$inputs['id'].'">';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function nhanhs(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idnhanhs'];
            $model = KkGDvLt::findOrFail($id);
            $model->trangthai = "Duyệt";
            $model->ngaynhan = $input['ngaynhan'];
            $model->sohsnhan = $input['sohsnhan'];

            if($model->save()){
                $this->congbo($id);
                $nhanhs = DmDvQl::where('maqhns',$model->cqcq)
                    ->first();
                $nhanhs->sohsnhan = $input['sohsnhan'];
                $nhanhs->save();
                //$general = GeneralConfigs::first();
                //$general->sodvlt = $input['sohsnhan'];
                //$general->save();
            }
            return redirect('xet_duyet_ke_khai_dich_vu_luu_tru/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan');
        }else
            return view('errors.notlogin');
    }

    public function congbo($id){
        if (Session::has('admin')) {
            $modelkk = KkGDvLt::findOrFail($id);
            $modeldel = CbKkGDvLt::where('macskd',$modelkk->macskd)
                ->delete();
            $model = new CbKkGDvLt();
            $model->ngaynhap = $modelkk->ngaynhap;
            $model->mahs = $modelkk->mahs;
            $model->socv = $modelkk->socv;
            $model->ngayhieuluc = $modelkk->ngayhieuluc;
            $model->socvlk = $modelkk->socvlk;
            $model->ngaycvlk = $modelkk->ngaycvlk;
            $model->trangthai = 'Đang công bố';
            $model->macskd = $modelkk->macskd;
            $model->masothue = $modelkk->masothue;
            $model->ghichu = $modelkk->ghichu;
            $model->ngaynhan = $modelkk->ngaynhan;
            $model->sohsnhan = $modelkk->sohsnhan;
            $model->ngaychuyen = $modelkk->ngaychuyen;
            $model->ttnguoinop = $modelkk->ttnguoinop;
            $model->phanloai = $modelkk->phanloai;
            $model->filedk = $modelkk->filedk;
            $model->idkk = $modelkk->id;
            $model->save();
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

        if(isset($inputs['mahs'])){
            $model = KkGDvLt::where('mahs',$inputs['mahs'])
                ->first();

            $sohsnhan = $model->sohsnhan;
            $ngaynhan = $model->ngaynhan;

            $result['message'] = '<div class="modal-body" id="ttnhanhs">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="'.$sohsnhan.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày nhận hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="'.$ngaynhan.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="mahs" name="mahs" value="'.$inputs['mahs'].'">';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function updatettnhs(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::where('mahs',$input['mahs'])->first();
            $model->ngaynhan = $input['ngaynhan'];
            $model->sohsnhan = $input['sohsnhan'];
            if($model->save()){
                $modelcb = CbKkGDvLt::where('mahs',$input['mahs'])
                    ->first();
                $modelcb->ngaynhan = $input['ngaynhan'];
                $modelcb->sohsnhan = $input['sohsnhan'];
                $modelcb->save();
            }
            return redirect('xet_duyet_ke_khai_dich_vu_luu_tru/'.'thang='.date('m').'&nam='.date('Y').'&pl=cong_bo');
        }else
            return view('errors.notlogin');
    }
}
