<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvLt;
use App\GeneralConfigs;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtH;
use App\KkGDvLtH;
use App\TtNgayNghiLe;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class KkGDvLtXdController extends Controller
{
    /*public function index($thang,$nam,$pl){
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
            elseif($pl == 'duyet') {

                $model = KkGDvLt::where('trangthai', 'Duyệt')
                    ->whereMonth('ngaychuyen', $thang)
                    ->whereYear('ngaychuyen', $nam)
                    ->get();
            }
            elseif($pl == 'cong_bo') {

                $model = CbKkGDvLt::whereMonth('ngaynhan',$thang)
                    ->whereYear('ngaynhan', $nam)
                    ->get();
            }elseif($pl='bi_tra_lai'){
                $model = KkGDvLt::where('trangthai', 'Bị trả lại')
                    ->whereMonth('ngaychuyen', $thang)
                    ->whereYear('ngaychuyen', $nam)
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
    }*/
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['pl'] = isset($inputs['pl']) ? $inputs['pl'] : 'cho_nhan';

            $model = KkGDvLt::join('cskddvlt','cskddvlt.macskd','=','kkgdvlt.macskd')
                ->select('cskddvlt.tencskd','cskddvlt.loaihang','kkgdvlt.mahs','kkgdvlt.ngaynhap','kkgdvlt.ngayhieuluc','kkgdvlt.socv','kkgdvlt.ttnguoinop','kkgdvlt.trangthai',
                'kkgdvlt.id','kkgdvlt.ngaychuyen');
            if($inputs['pl']=='cho_nhan') {
                if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                    $model = $model->where('kkgdvlt.trangthai', 'Chờ nhận')
                        ->whereYear('kkgdvlt.ngaychuyen', $inputs['nam']);
                }else{
                    $model = $model->where('kkgdvlt.trangthai', 'Chờ nhận')
                        ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                        ->whereYear('ngaychuyen', $inputs['nam']);
                }
            }
            elseif($inputs['pl'] == 'duyet') {
                if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                    $model = $model->where('kkgdvlt.trangthai', 'Duyệt')
                        ->whereYear('kkgdvlt.ngaychuyen', $inputs['nam']);
                }else{
                    $model = $model->where('kkgdvlt.trangthai', 'Duyệt')
                        ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                        ->whereYear('kkgdvlt.ngaychuyen', $inputs['nam']);
                }
            /*}elseif($inputs['pl'] == 'cong_bo') {
                $model = CbKkGDvLt::whereYear('ngaychuyen', $inputs['nam'])
                    ->get();*/
            }elseif($inputs['pl']='bi_tra_lai'){
                if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                    $model = $model->where('kkgdvlt.trangthai', 'Bị trả lại')
                        ->whereYear('kkgdvlt.ngaychuyen', $inputs['nam']);
                }else{
                    $model = $model->where('kkgdvlt.trangthai', 'Bị trả lại')
                        ->where('kkgdvlt.cqcq',session('admin')->cqcq)
                        ->whereYear('kkgdvlt.ngaychuyen', $inputs['nam']);
                }
            }
            $model = $model->geT();
            /*$modelcskd = CsKdDvLt::all();
            foreach($model as $ttkk) {
                $model_cskd = $modelcskd->where('masothue', $ttkk->masothue)
                    ->where('macskd', $ttkk->macskd)
                    ->first();
                $ttkk->tencskd = count($model_cskd) > 0 ? $model_cskd->tencskd : '';
                $ttkk->loaihang = count($model_cskd) > 0 ? $model_cskd->loaihang : '';
                //$this->getTTCSKD($modelcskd,$ttkk);
            }*/
            return view('manage.dvlt.kkgia.xetduyet.index')
                ->with('model',$model)
                ->with('nam',$inputs['nam'])
                ->with('pl',$inputs['pl'])
                ->with('pageTitle','Thông tin cơ sở kinh doanh dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function getTTCSKD($cskds,$array){
        foreach($cskds as $cskd){
            if($cskd->masothue == $array->masothue && $cskd->macskd == $array->macskd){
                $array->tencskd = $cskd->tencskd;
                $array->loaihang = $cskd->loaihang;
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
            $this->uphistlhs($model);
            $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
            $dn = DnDvLt::where('masothue',$model->masothue)->first();
            $data=[];
            $data['tendn'] = $dn->tendn;
            $data['masothue'] = $model->masothue;
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['lydo'] = $input['lydo'];
            $maildn = $dn->email;
            $tendn = $dn->tendn;
            $mailql = $tencqcq->email;
            $tenql = $tencqcq->tendv;
            Mail::send('mail.replykkgia',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                $message->to($maildn,$tendn)
                    ->to($mailql,$tenql)
                    ->subject('Thông báo trả lại hồ sơ kê khai giá dịch vụ');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
            return redirect('xet_duyet_ke_khai_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }

    public function uphistlhs($model){
        $mahsh = getdate()[0];
        $arrays = $model->toArray();
        unset($arrays['id']);
        $arrays['action'] = 'Trả lại hồ sơ';
        $arrays['mahsh'] = $mahsh;
        $arrays['username'] = session('admin')->username;
        $arrays['name'] = session('admin')->name;
        $his = new KkGDvLtH();
        if($his->create($arrays)){
            $hsct = KkGDvLtCt::where('mahs',$model->mahs)
                ->get();
            foreach($hsct as $ct){
                $hisct = new KkGDvLtCtH();
                $hisct->mahsh = $mahsh;
                $hisct->loaip = $ct->loaip;
                $hisct->qccl = $ct->qccl;
                $hisct->sohieu = $ct->sohieu;
                $hisct->ghichu = $ct->ghichu;
                $hisct->macskd = $ct->macskd;
                $hisct->mahs = $ct->mahs;
                $hisct->mucgialk = $ct->mucgialk;
                $hisct->mucgiakk = $ct->mucgiakk;
                $hisct->tendoituong = $ct->tendoituong;
                $hisct->apdung = $ct->apdung;
                $hisct->maloaip = $ct->maloaip;
                $hisct->save();
            }
        }
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
            $modelcskd = CsKdDvLt::where('macskd',$modelhs->macskd)->first();

            $stt = $model->sohsnhan + 1;
            $ngay = Carbon::now()->toDateString();

            $result['message'] = '<div class="modal-body" id="ttnhanhs">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label style="color: blue"><b>'.$modelcskd->tencskd.'</b> kê khai giá dịch vụ lưu trú số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="'.$stt.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày duyệt hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="'.$ngay.'">';
            $result['message'] .= '</div>';
            /*$result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày hiệu lực</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngayhieuluc" name="ngayhieuluc" class="form-control"  value="'.$modelhs->ngayhieuluc.'">';
            $result['message'] .= '</div>';*/
            $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="'.$inputs['id'].'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function nhanhs(Request $request){
        if (Session::has('admin')) {
            $inputs = $request ->all();
            $inputs['trangthai'] = 'Duyệt';
            $model = KkGDvLt::where('id',$inputs['idnhanhs'])->first();
            $inputs['thoihan'] = getThXdHsDvLt($model->ngaychuyen,$inputs['ngaynhan']);

            if($model->update($inputs)){
                $this->congbo($inputs['idnhanhs']);
                $nhanhs = DmDvQl::where('maqhns',$model->cqcq)
                    ->first();
                $nhanhs->sohsnhan = $inputs['sohsnhan'];
                $nhanhs->save();
            }
            $this->uphisnhanhs($model);
            $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
            $dn = DnDvLt::where('masothue',$model->masothue)->first();
            $data=[];
            $data['tendn'] = $dn->tendn;
            $data['tg'] = Carbon::now()->toDateTimeString();
            $data['tencqcq'] = $tencqcq->tendv;
            $data['ngaykk'] = $model->ngaynhap;
            $data['ngayapdung'] = $model->ngayhieuluc;
            $data['socv'] = $model->socv;
            $data['ngaynhan'] = $inputs['ngaynhan'];
            $data['sohsnhan'] = $inputs['sohsnhan'];

            $maildn = $dn->email;
            $tendn = $dn->tendn;
            $mailql = $tencqcq->email;
            $tenql = $tencqcq->tendv;
            Mail::send('mail.successkkgia',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                $message->to($maildn,$tendn)
                    ->to($mailql,$tenql)
                    ->subject('Thông báo xét duyệt hồ sơ kê khai giá dịch vụ');
                $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
            });
            return redirect('xet_duyet_ke_khai_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }

    public function uphisnhanhs($model){
        $mahsh = getdate()[0];
        $arrays = $model->toArray();
        unset($arrays['id']);
        $arrays['action'] = 'Nhận hồ sơ';
        $arrays['mahsh'] = $mahsh;
        $arrays['username'] = session('admin')->username;
        $arrays['name'] = session('admin')->name;
        $his = new KkGDvLtH();

        if($his->create($arrays)){
            $hsct = KkGDvLtCt::where('mahs',$model->mahs)
                ->get();
            //dd($hsct);
            foreach($hsct as $ct){
                $hisct = new KkGDvLtCtH();
                $hisct->mahsh = $mahsh;
                $hisct->loaip = $ct->loaip;
                $hisct->qccl = $ct->qccl;
                $hisct->sohieu = $ct->sohieu;
                $hisct->ghichu = $ct->ghichu;
                $hisct->macskd = $ct->macskd;
                $hisct->mahs = $ct->mahs;
                $hisct->mucgialk = $ct->mucgialk;
                $hisct->mucgiakk = $ct->mucgiakk;
                $hisct->tendoituong = $ct->tendoituong;
                $hisct->apdung = $ct->apdung;
                $hisct->maloaip = $ct->maloaip;
                $hisct->save();
            }
        }
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
            //$model->filedk = $modelkk->filedk;
            $model->idkk = $modelkk->id;
            $model->phanloai = $modelkk->phanloai;
            $model->tendn = $modelkk->tendn;
            $model->tencskd = $modelkk->tencskd;
            $model->loaihang = $modelkk->loaihang;
            //$model->thoihan = $modelkk->thoihan;
            $model->save();
        }else
            return view('errors.notlogin');
    }



    public function history($mahs){
        if (Session::has('admin')) {
            $model = KkGDvLt::where('mahs',$mahs)->first();
            $modeldn = DnDvLt::where('masothue',$model->masothue)->first();
            $modelcskd = CsKdDvLt::where('macskd',$model->macskd)->first();
            $modelhis = KkGDvLtH::where('mahs',$mahs)
                ->get();
            return view('manage.dvlt.kkgia.xetduyet.history')
                ->with('pageTitle','Lịch sử hồ sơ kê khai')
                ->with('model',$model)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelhis',$modelhis);
        }else
            return view('errors.notlogin');
    }

    public function showhis($mahsh){
        if (Session::has('admin')) {
            $model = KkGDvLtH::where('mahsh',$mahsh)->first();
            $modelcskd = CsKdDvLt::where('macskd',$model->macskd)->first();
            $modeldn = DnDvLt::where('masothue',$modelcskd->masothue)->first();

            $modelct = KkGDvLtCtH::where('mahsh',$mahsh)
                ->get();

            return view('manage.dvlt.kkgia.xetduyet.hshistory')
                ->with('pageTitle','Lịch sử hồ sơ kê khai')
                ->with('model',$model)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelct',$modelct);
        }else
            return view('errors.notlogin');

    }

    public function showhis45s($mahsh){
        if (Session::has('admin')) {
            $model = KkGDvLtH::where('mahsh',$mahsh)->first();
            $modeldn = DnDvLt::where('masothue',$model->masothue)->first();
            $modelcskd = CsKdDvLt::where('macskd',$model->macskd)->first();
            $modelct = KkGDvLtCtH::where('mahsh',$mahsh)
                ->get();

            return view('manage.dvlt.kkgia.xetduyet.hs45shistory')
                ->with('pageTitle','Lịch sử hồ sơ kê khai')
                ->with('model',$model)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd)
                ->with('modelct',$modelct);
        }else
            return view('errors.notlogin');

    }

    public function hsdakk($macskd){
        if (Session::has('admin')) {

            $modelcskd = CsKdDvLt::where('macskd',$macskd)->first();
            $modeldn = DnDvLt::where('masothue',$modelcskd->masothue)->first();

            $model = KkGDvLt::where('macskd',$macskd)
                ->where('trangthai','Duyệt')
                //->orderBy('id', 'desc')
                ->get();
            return view('manage.dvlt.kkgia.xetduyet.hsdakk')
                ->with('pageTitle','Thông tin hồ sơ đa kê khai')
                ->with('model',$model)
                ->with('modeldn',$modeldn)
                ->with('modelcskd',$modelcskd);
        }else
            return view('errors.notlogin');
    }



    public function gettttralai(Request $request){
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

            $result['message'] = '<div class="form-group" id="tttralai"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modelcskd->tencskd.'</b> kê khai giá dịch vụ lưu trú số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '<input type="hidden" id="idtralai" name="idtralai" value="'.$inputs['id'].'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }



}
