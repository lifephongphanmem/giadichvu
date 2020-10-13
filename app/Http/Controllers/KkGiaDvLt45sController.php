<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DnDvLt;
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
                $inputs = array();
                $check = KkGDvLt::where('macskd',$macskd)
                    ->wherein('trangthai',['Bị trả lại','Chờ nhận'])
                    ->whereYear('ngaynhap', date('Y'))
                    ->count();
                if($check == 0) {
                    $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                    if (session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                        $modelttp = TtCsKdDvLt::where('macskd', $macskd)
                            ->get();

                        $modeldtad = DoiTuongApDungDvLt::where('macskd', $macskd)
                            ->get();
                        $modelctdf = KkGDvLtCtDf::where('macskd', $macskd)->delete();
                        $modelcp = CbKkGDvLt::where('macskd', $macskd)
                            ->first();
                        if(isset($modelcp)) {
                            $modelcb = KkGDvLt::where('mahs', $modelcp->mahs)->first();
                            if (isset($modelcb)) {
                                $modelph = KkGDvLtCt::where('mahs', $modelcb->mahs)
                                    ->get();
                                $inputs['socvlk'] = $modelcb->socv;
                                $inputs['ngaycvlk'] = $modelcb->ngaynhap;
                                $inputs['giaycnhangcs'] = $modelcb->giaycnhangcs;
                                $inputs['soqdgiaycnhangcs'] = $modelcb->soqdgiaycnhangcs;
                                $inputs['giaycnhangcstungay'] = $modelcb->giaycnhangcstungay;
                                $inputs['giaycnhangcsdenngay'] = $modelcb->giaycnhangcsdenngay;
                                foreach ($modelph as $ttph) {
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

                        }

                        $modelttdv = KkGDvLtCtDf::where('macskd', $macskd)
                            ->get();
                        //dd($modelttdv);
                        $ngaynhap = date('Y-m-d');

                        $modeldn = DnDvLt::where('masothue', $modelcskd->masothue)->first();

                        return view('manage.dvlt.kkgia.kkgia45s.create')
                            ->with('modelcskd', $modelcskd)
                            ->with('modelttp', $modelttp)
                            ->with('modeldtad', $modeldtad)
                            ->with('modelttdv', $modelttdv)
                            ->with('ngaynhap', $ngaynhap)
                            ->with('modeldn', $modeldn)
                            ->with('inputs', $inputs)
                            ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                    }else
                        return view('errors.noperm');
                }else
                    dd('Hiện tại đang tồn tại hồ sơ có trạng thái chờ duyệt, chờ chuyển or bị trả lại! Bạn không thể tạo thêm hồ sơ');
            }else
                return view('errors.perm');
        }else
            return view('errors.notlogin');
    }
    //add ttp
    public function store(Request $request){
        //if (Session::has('admin')) {
            $mahs = getdate()[0];
            $inputs = $request->all();
            /*$model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaynhap'])));
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
            $model->plhs = $insert['plhs'];*/
            $inputs['mahs'] = $inputs['macskd'].getdate()[0];
            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            $inputs['giaycnhangcstungay'] = getDateToDb($inputs['giaycnhangcstungay']);
            $inputs['giaycnhangcsdenngay'] = getDateToDb($inputs['giaycnhangcsdenngay']);
            if($inputs['ngaycvlk'] != '')
                $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
            else
                unset($inputs['ngaycvlk']);
            if(isset($inputs['giaycnhangcs'])){
                $giaycnhangcs = $request->file('giaycnhangcs');
                $inputs['giaycnhangcs'] = $inputs['macskd'] .'.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $inputs['giaycnhangcs']);
            }else
                $inputs['giaycnhangcs'] = $inputs['giaycnhangcsplus'];

            $inputs['trangthai'] = 'Chờ chuyển';
            $inputs['phanloai'] = 'DT';
            $model = new KkGDvLt();
            if($model->create($inputs)){
                $modelph = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
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
                    $modelgiaph->mahs = $inputs['mahs'];
                    $modelgiaph->save();
                }
            }
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$inputs['macskd'].'&nam='.date('Y'));
        //}else
            //return view('errors.notlogin');
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

                    $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();
                    $modeldn = DnDvLt::where('masothue',$model->masothue)->first();

                    return view('manage.dvlt.kkgia.kkgia45s.edit')
                        ->with('model',$model)
                        ->with('modelcb',$modecb)
                        ->with('modeldtad',$modeldtad)
                        ->with('modelttp',$modelttp )
                        ->with('modelloaip',$modelloaip)
                        ->with('modelcskd',$modelcskd)
                        ->with('modeldn',$modeldn)
                        ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú chỉnh sửa');

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function update($id,Request $request){
        //if (Session::has('admin')) {
            $insert = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $insert['ngaynhap'] = date('Y-m-d', strtotime(str_replace('/', '-', $model->ngaynhap)));
            $insert['ngayhieuluc'] = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngayhieuluc'])));
            $insert['giaycnhangcstungay'] = getDateToDb($insert['giaycnhangcstungay']);
            $insert['giaycnhangcsdenngay'] = getDateToDb($insert['giaycnhangcsdenngay']);
            if($insert['ngaycvlk'] != '')
                $insert['ngaycvlk']  = date('Y-m-d', strtotime(str_replace('/', '-', $insert['ngaycvlk'])));
            else
                unset($insert['ngaycvlk']);
            if(isset($insert['giaycnhangcs'])){
                $giaycnhangcs = $request->file('giaycnhangcs');
                $insert['giaycnhangcs'] = $insert['macskd'] .'.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt/', $insert['giaycnhangcs']);
            }
            $model->update($insert);
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$insert['macskd'].'&nam='.date('Y'));
        //}else
            //return view('errors.notlogin');
    }
}
