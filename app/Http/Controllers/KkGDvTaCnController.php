<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnTaCn;
use App\KkGDvTaCn;
use App\KkGDvTaCnCt;
use App\KkGDvTaCnCtDf;
use App\TtNgayNghiLe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class KkGDvTaCnController extends Controller
{
    public function ttdn()
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                if (session('admin')->sadmin == 'ssa') {
                    $model = DnTaCn::all();
                } else {
                    $model = DnTaCn::where('cqcq', session('admin')->cqcq)
                        ->get();
                }
                return view('manage.dvtacn.kkgia.ttdn.index')
                    ->with('model', $model)
                    ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp thức ăn chăn nuôi');
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue'] : '';
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
                $modeldn = DnTaCn::where('masothue', $inputs['masothue'])->first();
                $cqcq = $modeldn->cqcq;
                $model = KkGDvTaCn::where('masothue', $inputs['masothue'])
                    ->whereYear('ngaynhap', $inputs['nam'])
                    ->get();
            }else {
                $inputs['masothue'] = session('admin')->mahuyen;
                $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
                $modeldn = DnTaCn::where('masothue', $inputs['masothue'])->first();
                $model = KkGDvTaCn::where('masothue', $inputs['masothue'])
                    ->whereYear('ngaynhap', $inputs['nam'])
                    ->get();
            }
            return view('manage.dvtacn.kkgia.kkgiadv.index')
                ->with('model', $model)
                ->with('modeldn', $modeldn)
                ->with('nam', $inputs['nam'])
                ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');

        } else
            return view('errors.notlogin');
    }

    public function create($masothue)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $modeldn = DnTaCn::where('masothue', $masothue)->first();
                $ngaynhap = date('Y-m-d');
                $ngayhieuluc = getNgayHieuLuc($ngaynhap);
                $ngaynhap = date('d/m/Y', strtotime($ngaynhap));
                $ngayhieuluc = date('d/m/Y', strtotime($ngayhieuluc));
                $modeldel = KkGDvTaCnCtDf::where('masothue', $masothue)->delete();
                return view('manage.dvtacn.kkgia.kkgiadv.create')
                    ->with('ngaynhap', $ngaynhap)
                    ->with('ngayhieuluc', $ngayhieuluc)
                    ->with('modeldn', $modeldn)
                    ->with('masothue', $masothue)
                    ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');
            } else {
                if ($masothue == session('admin')->mahuyen) {
                    $modeldn = DnTaCn::where('masothue', $masothue)->first();
                    $ngaynhap = date('Y-m-d');
                    $ngayhieuluc = getNgayHieuLuc($ngaynhap);
                    $ngaynhap = date('d/m/Y', strtotime($ngaynhap));
                    $ngayhieuluc = date('d/m/Y', strtotime($ngayhieuluc));
                    $modeldel = KkGDvTaCnCtDf::where('masothue', $masothue)->delete();
                    return view('manage.dvtacn.kkgia.kkgiadv.create')
                        ->with('ngaynhap', $ngaynhap)
                        ->with('ngayhieuluc', $ngayhieuluc)
                        ->with('modeldn', $modeldn)
                        ->with('masothue', $masothue)
                        ->with('pageTitle', 'Kê khai giá thức ăn chăn nuôi');
                } else
                    return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || $inputs['masothue'] == session('admin')->mahuyen) {
                $inputs['mahs'] = getdate()[0];
                $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
                $inputs['trangthai'] = 'Chờ chuyển';
                $model = new KkGDvTaCn();
                if ($model->create($inputs)) {
                    $modelhh = KkGDvTaCnCtDf::where('masothue', $inputs['masothue'])
                        ->get();
                    foreach ($modelhh as $hh) {
                        $model = new KkGDvTaCnCt();
                        $model->mahs = $inputs['mahs'];
                        $model->mahh = $inputs['mahh'];
                        $model->tenhh = $hh->tenhh;
                        $model->qccl = $hh->qccl;
                        $model->dvt = $hh->dvt;
                        $model->mucgialk = $hh->mucgialk;
                        $model->mucgiakk = $hh->mucgiakk;
                        $model->ghichu = $hh->ghichu;
                        $model->save();
                    }
                }
                return redirect('ke_khai_thuc_an_chan_nuoi?&masothue=' . $inputs['masothue']);
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function edit($id)
    {
        if (Session::has('admin')) {
            $model = KkGDvTaCn::findOrFail($id);
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || $model->masothue == session('admin')->mahuyen) {
                $modelct = KkGDvTaCnCt::where('mahs', $model->mahs)
                    ->get();
                return view('manage.dvtacn.kkgia.kkgiadv.edit')
                    ->with('model', $model)
                    ->with('modelct', $modelct)
                    ->with('pageTitle', 'Chỉnh sửa thông tin kê khai thức ăn chăn nuôi');
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            $model = KkGDvTaCn::findOrFail($id);
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || $model->masothue == session('admin')->mahuyen) {
                $inputs = $request->all();
                $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
                $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
                $inputs['ngaycvlk'] = getDateToDb($inputs['ngaycvlk']);
                $model->update($inputs);
                return redirect('ke_khai_thuc_an_chan_nuoi?&masothue=' . $inputs['masothue']);
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function delete(Request $request)
    {
        if (Session::has('admin')) {
            $inputs = $request->all();
            $id = $inputs['iddelete'];
            $model = KkGDvTaCn::findOrFail($id);
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || $model->masothue == session('admin')->mahuyen) {
                if ($model->delete()) {
                    $modelct = KkGDvTaCnCt::where('mahs', $model->mahs)->delete();
                }
                return redirect('ke_khai_thuc_an_chan_nuoi?&masothue=' . $model->masothue);
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }

    public function checkngay(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if (isset($inputs['id'])) {
            $model = KkGDvTaCn::where('id', $inputs['id'])
                ->first();
            $ngayapdung = $model->ngayhieuluc;
            $ngaychuyen = Carbon::now()->toDateTimeString();
            if ($model->plhs == 'GG') {
                if ($ngayapdung >= date('Y-m-d', strtotime($ngaychuyen))) {
                    $result['status'] = 'success';
                }
            } else {
                $modelchecknn = TtNgayNghiLe::where('ngaytu', '<=', $ngaychuyen)
                    ->where('ngayden', '>=', $ngaychuyen)->first();
                if (count($modelchecknn) > 0) {
                    $ngaynghi = $modelchecknn->songaynghi;
                    $day = date("D", strtotime($ngaychuyen));

                    if ($day == 'Thu') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 5 + $ngaynghi, date('Y', strtotime($ngaychuyen))));
                    } elseif ($day == 'Fri') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 5 + $ngaynghi, date('Y', strtotime($ngaychuyen))));
                    } elseif ($day == 'Sat') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 4 + $ngaynghi, date('Y', strtotime($ngaychuyen))));
                    } else {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 3 + $ngaynghi, date('Y', strtotime($ngaychuyen))));
                    }
                    if ($ngayapdung >= $ngaysosanh) {
                        $result['status'] = 'success';
                    }
                } else {
                    $day = date("D", strtotime($ngaychuyen));

                    if ($day == 'Thu') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 5, date('Y', strtotime($ngaychuyen))));
                    } elseif ($day == 'Fri') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 5, date('Y', strtotime($ngaychuyen))));
                    } elseif ($day == 'Sat') {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 4, date('Y', strtotime($ngaychuyen))));
                    } else {
                        $ngaysosanh = date('Y-m-d', mktime(0, 0, 0, date('m', strtotime($ngaychuyen)), date('d', strtotime($ngaychuyen)) + 3, date('Y', strtotime($ngaychuyen))));
                    }
                    if ($ngayapdung >= $ngaysosanh) {
                        $result['status'] = 'success';
                    }
                }
            }

        }
        die(json_encode($result));
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            $tgchuyen = Carbon::now()->toDateTimeString();
            $input = $request->all();
            $id = $input['idchuyen'];
            $model = KkGDvTaCn::findOrFail($id);
            //dd($model);
            if ($input['ttnguoinop'] != '') {
                $model->ttnguoinop = $input['ttnguoinop'];
                $model->trangthai = 'Chờ nhận';
                $model->ngaychuyen = $tgchuyen;
                //$model->save();
                if ($model->save()) {
                    $tencqcq = DmDvQl::where('maqhns', $model->cqcq)->first();
                    $dn = DnTaCn::where('masothue', $model->masothue)->first();
                    $data = [];
                    $data['tendn'] = $dn->tendn;
                    $data['masothue'] = $model->masothue;
                    $data['tg'] = $tgchuyen;
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['ttnguoinop'] = $input['ttnguoinop'];
                    $maildn = $dn->email;
                    $tendn = $dn->tendn;
                    $mailql = $tencqcq->email;
                    $tenql = $tencqcq->tendv;

                    Mail::send('mail.kkgia', $data, function ($message) use ($maildn, $tendn, $mailql, $tenql) {
                        $message->to($maildn, $tendn)
                            ->to($mailql, $tenql)
                            ->subject('Thông báo nhận hồ sơ kê khai giá dịch vụ');
                        $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
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
                    $his->ttnguoinop = $input['ttnguoinop'];
                    $his->ghichu = $model->ghichu;
                    $his->ngaychuyen = $tgchuyen;
                    $his->cqcq = $model->cqcq;
                    $his->dvt = $model->dvt;
                    $his->phanloai = $model->phanloai;
                    $his->plhs =$model->plhs;
                    $his->action = 'Chuyển hồ sơ kê khai';
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
                    }
                };
            }
            $macskd = $model->macskd;*/

                    return redirect('ke_khai_thuc_an_chan_nuoi?&masothue=' . $model->masothue);
                } else
                    return view('errors.notlogin');
            }
        }
    }

    public function viewlydo(Request $request){
        if (Session::has('admin')) {

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
                $id = $inputs['id'];
                $model = KkGDvTaCn::findOrFail($id);

                $result['message'] = '<div class="form-group" id="showlydo">';
                $result['message'] = '<label style="color: blue"><b>'.$model->lydo.'</b></label>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';

            }
            die(json_encode($result));

        } else
            return view('errors.notlogin');
    }

}
