<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtDf;
use App\TtCsKdDvLt;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class KkGDvLtController extends Controller
{
    public function cskd(){
        if (Session::has('admin')) {
            $model = CsKdDvLt::where('masothue',session('admin')->mahuyen)
                ->get();
            return view('manage.dvlt.kkgia.ttcskd.index')
                ->with('model',$model)
                ->with('pageTitle','Thông tin cơ sở kinh doanh dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function index($macskd,$nam){
        if (Session::has('admin')) {
            $model = KkGDvLt::where('macskd',$macskd)
                ->whereYear('ngaynhap',$nam)
                ->get();
            $modelcskd = CsKdDvLt::where('macskd',$macskd)
                ->first();
            return view('manage.dvlt.kkgia.kkgiadv.index')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('macskd',$macskd)
                ->with('modelcskd',$modelcskd)
                ->with('pageTitle','Thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function create($macskd){
        if (Session::has('admin')) {
            $modelcskd = CsKdDvLt::where('macskd',$macskd) ->first();
            $modelkkctdf = KkGDvLtCtDf::where('macskd',$modelcskd->macskd)
                ->delete();

            $modelph = TtCsKdDvLt::where('macskd',$modelcskd->macskd)
                ->get();

            $modelcb = CbKkGDvLt::where('macskd',$modelcskd->macskd)
                ->first();

            if(isset($modelcb)) {
                $modelgcb  = KkGDvLt::where('mahs',$modelcb->mahs)
                    ->get();
                foreach ($modelph as $ph) {
                    foreach ($modelgcb as $giaph) {
                        if ($giaph->maloaip == $ph->maloaip) {
                            $ph->gialk = $giaph->mucgiakk;
                        }
                    }
                }
            }

            foreach($modelph as $ttph){
                $dsph = new KkGDvLtCtDf();
                $dsph->macskd = $modelcskd->macskd;
                $dsph->maloaip = $ttph->maloaip;
                $dsph->loaip = $ttph->loaip;
                $dsph->qccl = $ttph->qccl;
                $dsph->sohieu = $ttph->sohieu;
                $dsph->ghichu = $ttph->ghichu;
                $dsph->mucgialk = $ttph->gialk;
                $dsph->save();
            }
            $modeldsph = KkGDvLtCtDf::where('macskd',$modelcskd->macskd)
                ->get();

            return view('manage.dvlt.kkgia.kkgiadv.create')
                ->with('modelcskd',$modelcskd)
                ->with('modelph',$modelph)//Thay thế
                ->with('modeldsph',$modeldsph)
                ->with('modelcb',$modelcb)
                ->with('pageTitle','Kê khai giá dịch vụ lưu trú thêm mới');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $mahs = getdate()[0];
            $insert = $request->all();
            $model = new KkGDvLt();
            $model->ngaynhap = $insert['ngaynhap'];
            $model->mahs = $mahs;
            $model->socv = $insert['socv'];
            $model->ngayhieuluc = $insert['ngayhieuluc'];
            $model->socvlk = $insert['socvlk'];
            if($insert['ngaycvlk'] != '')
                $model->ngaycvlk = $insert['ngaycvlk'];
            $model->trangthai = 'Chờ chuyển';
            $model->macskd = $insert['macskd'];
            $model->masothue = session('admin')->mahuyen;
            $model->ghichu = $insert['ghichu'];
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
            $model = KkGDvLt::findOrFail($id);
            $modelct = KkGDvLtCt::where('mahs',$model->mahs)
                ->get();
            return view('manage.dvlt.kkgia.kkgiadv.edit')
                ->with('model',$model)
                ->with('modelct',$modelct)
                ->with('pageTitle','Chỉnh sửa thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;
            $model->ngaynhap = $input['ngaynhap'];
            $model->socv = $input['socv'];
            $model->ngayhieuluc = $input['ngayhieuluc'];
            $model->socvlk = $input['socvlk'];
            $model->ngaycvlk = $input['ngaycvlk'];
            $model->ghichu = $input['ghichu'];
            $model->save();
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;
            if($model->delete()){
                $modelct = KkGDvLtCt::where('mahs',$model->mahs)->delete();
            }
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            $tgchuyen = Carbon::now()->toDateTimeString();
            $input = $request->all();
            $id = $input['idchuyen'];
            $model = KkGDvLt::findOrFail($id);
            if($input['ttnguoinop'] != ''){
                $model->ttnguoinop = $input['ttnguoinop'];
                $model->trangthai = 'Chờ nhận';
                $model->ngaychuyen = $tgchuyen;
                $model->save();
            }
            $macskd = $model->macskd;


            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function viewlydo(Request $request){
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

            //$result['message'] = '<div class="col-md-9 " id="ndlydo">';
            $result['message'] = '<textarea id="lydo" class="form-control required" name="lydo" cols="30" rows="6">'.$model->lydo.'</textarea>';
            //$result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }

    public function search(){
        if (Session::has('admin')) {
            $cskd = CsKdDvLt::all();
            return view('manage.dvlt.search.index')
                ->with('nam',date('Y'))
                ->with('cskd',$cskd)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function viewsearch($macskd,$nam){
        if (Session::has('admin')) {
            $cskd = CsKdDvLt::all();
            if($macskd == 'all'){
                $model = KkGDvLt::whereYear('ngaynhan',$nam)
                    ->where('trangthai','Duyệt')
                    ->get();
            }else{
                $model = KkGDvLt::where('macskd',$macskd)
                    ->whereYear('ngaynhan',$nam)
                    ->where('trangthai','Duyệt')
                    ->get();
            }
            foreach($model as $ttkk){
                $this->getTTCSKD($cskd,$ttkk);
            }
            return view('manage.dvlt.search.view')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('macskd',$macskd)
                ->with('cskd',$cskd)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }
    public function getTTCSKD($cskds,$array){
        foreach($cskds as $cskd){
            if($cskd->masothue == $array->masothue){
                $array->tencskd = $cskd->tencskd;
            }
        }
    }

}