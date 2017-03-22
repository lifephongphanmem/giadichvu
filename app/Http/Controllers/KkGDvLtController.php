<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DnDvLt;
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
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                    if (session('admin')->sadmin == 'ssa') {
                        $model = CsKdDvLt::all();
                    } else {
                        $model = CsKdDvLt::where('cqcq', session('admin')->cqcq)
                            ->get();
                    }
                } else {
                    $model = CsKdDvLt::where('masothue', session('admin')->mahuyen)
                        ->get();

                }
                return view('manage.dvlt.kkgia.ttcskd.index')
                    ->with('model', $model)
                    ->with('pageTitle', 'Thông tin cơ sở kinh doanh dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function index($macskd,$nam){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $model = KkGDvLt::where('macskd', $macskd)
                    ->whereYear('ngaynhap', $nam)
                    ->orderBy('id')
                    ->get();
                $modelcskd = CsKdDvLt::where('macskd', $macskd)
                    ->first();

                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                    return view('manage.dvlt.kkgia.kkgiadv.index')
                        ->with('model', $model)
                        ->with('nam', $nam)
                        ->with('macskd', $macskd)
                        ->with('modelcskd', $modelcskd)
                        ->with('pageTitle', 'Thông tin kê khai giá dịch vụ lưu trú');
                }else{
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function create($macskd){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                    $modelkkctdf = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                        ->delete();

                    $modelph = TtCsKdDvLt::where('macskd', $modelcskd->macskd)
                        ->get();
//dd($modelph);
                    $modelcb = CbKkGDvLt::where('macskd', $modelcskd->macskd)
                        ->first();


                    if (isset($modelcb)) {
                        $modelgcb = KkGDvLtCt::where('mahs', $modelcb->mahs)
                            ->get();

                        foreach ($modelph as $ph) {
                            /*foreach ($modelgcb as $giaph) {
                                if ($giaph->maloaip == $ph->maloaip) {
                                    $ph->gialk = $giaph->mucgiakk;
                                }
                            }*/
                            $this->getGialk($modelgcb,$ph);

                        }
                    }

                    //dd($modelph);

                    foreach ($modelph as $ttph) {
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
                    $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                        ->get();
                    //dd($modelcskd);
                    //dd($modelph);
                    return view('manage.dvlt.kkgia.kkgiadv.create')
                        ->with('modelcskd', $modelcskd)
                        ->with('modelph', $modelph)//Thay thế
                        ->with('modeldsph', $modeldsph)
                        ->with('modelcb', $modelcb)
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
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='DVLT') {
                $model = KkGDvLt::findOrFail($id);
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq) {
                    $modelct = KkGDvLtCt::where('mahs', $model->mahs)
                        ->get();
                    return view('manage.dvlt.kkgia.kkgiadv.edit')
                        ->with('model', $model)
                        ->with('modelct', $modelct)
                        ->with('pageTitle', 'Chỉnh sửa thông tin kê khai giá dịch vụ lưu trú');
                }else{
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;

            $model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaynhap'])));
            $model->socv = $input['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngayhieuluc'])));
            $model->socvlk = $input['socvlk'];
            $model->ngaycvlk = $input['ngaycvlk']==''? NULL  :date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaycvlk'])));;
            $model->ghichu = $input['ghichu'];
            $model->dvt = $input['dvt'];
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
            $dn = DnDvLt::all();
            return view('manage.dvlt.search.index')
                ->with('nam',date('Y'))
                ->with('cskd',$cskd)
                ->with('dn',$dn)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    public function viewsearch($masothue,$macskd,$nam){
        if (Session::has('admin')) {
            $allcskd = CsKdDvLt::all();
            $cskd = CsKdDvLt::where('masothue',$masothue)
                ->get();
            $dn = DnDvLt::all();
            if($masothue == 'all'){
                $model = KkGDvLt::whereYear('ngaynhan',$nam)
                    ->where('trangthai','Duyệt')
                    ->get();
            }else{
                if($macskd == 'all')
                    $model = KkGDvLt::where('masothue',$masothue)
                        ->whereYear('ngaynhan',$nam)
                        ->where('trangthai','Duyệt')
                        ->get();
                else
                    $model = KkGDvLt::where('masothue',$masothue)
                        ->where('macskd',$macskd)
                        ->whereYear('ngaynhan',$nam)
                        ->where('trangthai','Duyệt')
                        ->get();

            }
            //dd($model);
            foreach($model as $ttkk){
                $this->getTTCSKD($allcskd,$ttkk);
            }
            return view('manage.dvlt.search.view')
                ->with('model',$model)
                ->with('masothue',$masothue)
                ->with('dn',$dn)
                ->with('nam',$nam)
                ->with('macskd',$macskd)
                ->with('cskd',$cskd)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }
    public function getTTCSKD($cskds,$array){
        foreach($cskds as $cskd){
            if($cskd->macskd == $array->macskd){
                $array->tencskd = $cskd->tencskd;
            }
        }
    }
    public function getGialk($array,$phongs){
        foreach($array as $ar){
            if ($phongs->maloaip == $ar->maloaip) {
                $phongs->gialk = $ar->mucgiakk;
                break;
            }
        }
    }

}