<?php

namespace App\Http\Controllers;

use App\CbKkGDvTaCn;
use App\DmDvQl;
use App\DnTaCn;
use App\KkGDvTaCn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGDvTaCnXdController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                $inputs['phanloai'] = isset($inputs['phanloai']) ? $inputs['phanloai'] : 'cho_nhan';
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
                if($inputs['phanloai']=='cho_nhan') {
                    if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                        $model = KkGDvTaCn::where('trangthai', 'Chờ nhận')
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }else{
                        $model = KkGDvTaCn::where('trangthai', 'Chờ nhận')
                            ->where('cqcq',session('admin')->cqcq)
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }
                }
                elseif($inputs['phanloai'] == 'duyet') {
                    if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                        $model = KkGDvTaCn::where('trangthai', 'Duyệt')
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }else{
                        $model = KkGDvTaCn::where('trangthai', 'Duyệt')
                            ->where('cqcq',session('admin')->cqcq)
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }
                }
                elseif($inputs['phanloai'] == 'cong_bo') {

                    if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                        $model = CbKkGDvTaCn::whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }else{
                        $model = CbKkGDvTaCn::where('cqcq',session('admin')->cqcq)
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }
                }elseif($inputs['phanloai']='bi_tra_lai'){
                    if(session('admin')->level == 'T'  && session('admin')->sadmin == 'ssa') {
                        $model = KkGDvTaCn::where('trangthai', 'Bị trả lại')
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }else{
                        $model = KkGDvTaCn::where('trangthai', 'Bị trả lại')
                            ->where('cqcq',session('admin')->cqcq)
                            ->whereYear('ngaychuyen', $inputs['nam'])
                            ->get();
                    }
                }
                $modeldn = DnTaCn::all();
                foreach($model as $ttkk){
                    $this->getTTDN($modeldn,$ttkk);
                }
                return view('manage.dvtacn.kkgia.xetduyet.index')
                    ->with('model', $model)
                    ->with('phanloai',$inputs['phanloai'])
                    ->with('nam',$inputs['nam'])
                    ->with('pageTitle', 'Thông tin xét duyệt kê khai thức ăn chăn nuôi');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function getTTDN($dngss,$array){
        foreach($dngss as $dn){
            if($dn->masothue == $array->masothue){
                $array->tendn = $dn->tendn;
            }
        }
    }

    public function tralai(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['idtralai'];
            $model = KkGDvTaCn::findOrFail($id);
            if (session('admin')->level == 'T' || session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq) {
                $model->lydo = $inputs['lydo'];
                $model->trangthai = 'Bị trả lại';
                if($model->save()){
                    $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                    $dn = DnTaCn::where('masothue',$model->masothue)->first();
                    $data=[];
                    $data['tendn'] = $dn->tendn;
                    $data['masothue'] = $model->masothue;
                    $data['tg'] = Carbon::now()->toDateTimeString();
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['lydo'] = $inputs['lydo'];
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
                    //History
                    /*$mahsh = getdate()[0];
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
                    $his->lydo = $input['lydo'];
                    $his->action = 'Trả lại hồ sơ';
                    if($his->save()){
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
                    }*/
                }
                return redirect('xd_ke_khai_thucan_channuoi?&phanloai=cho_nhan');
            }else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function getTtKkTaCn(Request $request){
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

            $modelhs = KkGDvTaCn::where('id',$inputs['id'])
                ->first();
            $modeldn = DnTaCn::where('masothue',$modelhs->masothue)->first();

            $result['message'] = '<div class="form-group" id="ttkkgs"> ';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> Kê khai giá sữa số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '<label style="color: blue">Mã hồ sơ kê khai: <b>'.$modelhs->mahs.'</b></label>';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
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

            $modelhs = KkGDvTaCn::where('id',$inputs['id'])
                ->first();
            $model = DmDvQl::where('maqhns',$modelhs->cqcq)
                ->first();
            $modeldn = DnTaCn::where('masothue',$modelhs->masothue)->first();

            $stt = $model->sohsnhan + 1;
            $ngay = Carbon::now()->toDateString();

            $result['message'] = '<div class="modal-body" id="ttnhanhs">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label style="color: blue"><b>'.$modeldn->tendn.'</b> kê khai giá mặt hàng sữa số công văn <b>'.$modelhs->socv.'</b> ngày áp dụng <b>'.getDayVn($modelhs->ngayhieuluc).'</b></b></label>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Số hồ sơ nhận</b></label>';
            $result['message'] .= '<input type="text" style="text-align: center" id="sohsnhan" name="sohsnhan" class="form-control" data-mask="fdecimal" value="'.$stt.'" autofocus>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Ngày duyệt hồ sơ</b></label>';
            $result['message'] .= '<input type="date" style="text-align: center" id="ngaynhan" name="ngaynhan" class="form-control"  value="'.$ngay.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idnhanhs" name="idnhanhs" value="'.$inputs['id'].'">';
            $result['message'] .= '</div>';

            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function nhanhs(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idnhanhs'];
            $model = KkGDvTaCn::findOrFail($id);
            $model->trangthai = "Duyệt";
            $model->ngaynhan = $input['ngaynhan'];
            $model->sohsnhan = $input['sohsnhan'];

            $ngaynhan = Carbon::parse($model->ngaynhan);
            $ngaychuyen = Carbon::parse($model->ngaychuyen);
            $ngay = $ngaynhan->diff($ngaychuyen)->days;
            $thoihan_lt=getGeneralConfigs()['thoihan_lt'];
            if($ngay<$thoihan_lt){
                $model->thoihan='Trước thời hạn';
            }elseif($ngay==$thoihan_lt){
                $model->thoihan='Đúng thời hạn';
            }else{
                $model->thoihan='Quá thời hạn';
            }

            if($model->save()){
                $this->congbo($id);
                $nhanhs = DmDvQl::where('maqhns',$model->cqcq)
                    ->first();
                $nhanhs->sohsnhan = $input['sohsnhan'];
                $nhanhs->save();

                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $dn = DnTaCn::where('masothue',$model->masothue)->first();
                $data=[];
                $data['tendn'] = $dn->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $data['ngaykk'] = $model->ngaynhap;
                $data['ngayapdung'] = $model->ngayhieuluc;
                $data['socv'] = $model->socv;
                $data['ngaynhan'] = $input['ngaynhan'];
                $data['sohsnhan'] = $input['sohsnhan'];

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
                //History
                /*$mahsh = getdate()[0];
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
                $his->ngaynhan = $input['ngaynhan'];
                $his->sohsnhan = $input['sohsnhan'];
                $his->action = 'Nhận hồ sơ';
                if($his->save()){
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
                }*/
            }
            return redirect('xd_ke_khai_thucan_channuoi');
        }else
            return view('errors.notlogin');
    }

    public function congbo($id){
        if (Session::has('admin')) {
            $modelkk = KkGDvTaCn::findOrFail($id);
            $modeldel = CbKkGDvTaCn::where('masothue',$modelkk->masothue)
                ->delete();
            $model = new CbKkGDvTaCn();
            $model->ngaynhap = $modelkk->ngaynhap;
            $model->mahs = $modelkk->mahs;
            $model->socv = $modelkk->socv;
            $model->ngayhieuluc = $modelkk->ngayhieuluc;
            $model->socvlk = $modelkk->socvlk;
            $model->ngaycvlk = $modelkk->ngaycvlk;
            $model->trangthai = 'Đang công bố';
            $model->masothue = $modelkk->masothue;
            $model->ghichu = $modelkk->ghichu;
            $model->ngaynhan = $modelkk->ngaynhan;
            $model->sohsnhan = $modelkk->sohsnhan;
            $model->ngaychuyen = $modelkk->ngaychuyen;
            $model->ttnguoinop = $modelkk->ttnguoinop;
            $model->idkk = $modelkk->id;
            $model->apdungtheott = $modelkk->apdungtheott;
            $model->cqcq = $modelkk->cqcq;
            $model->save();
        }else
            return view('errors.notlogin');
    }

}
