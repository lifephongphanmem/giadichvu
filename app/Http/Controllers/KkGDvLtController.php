<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvLt;
use App\DoiTuongApDungDvLt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtDf;
use App\KkGDvLtCtH;
use App\KkGDvLtH;
use App\TtCsKdDvLt;
use App\TtNgayNghiLe;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

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
                    $tthscp = KkGDvLt::where('macskd', $macskd)
                        ->whereYear('ngaynhap', $nam)
                        ->where('trangthai','Duyệt')
                        ->orderBy('id','desc')
                        ->get();
                    $cb = CbKkGDvLt::where('macskd', $macskd)->first();
                    if(isset($cb))
                        $cp = 'yes';
                    else
                        $cp = 'no';
                    return view('manage.dvlt.kkgia.kkgiadv.index')
                        ->with('model', $model)
                        ->with('nam', $nam)
                        ->with('macskd', $macskd)
                        ->with('modelcskd', $modelcskd)
                        ->with('tthscp',$tthscp)
                        ->with('cp',$cp)
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
                        $dsph->mucgiakk = $ttph->gialk;
                        $dsph->save();
                    }
                    $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                        ->get();
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

                    return view('manage.dvlt.kkgia.kkgiadv.create')
                        ->with('modelcskd', $modelcskd)
                        ->with('modelph', $modelph)//Thay thế
                        ->with('modeldsph', $modeldsph)
                        ->with('modelcb', $modelcb)
                        ->with('ngaynhap',$ngaynhap)
                        ->with('ngayhieuluc',$ngayhieuluc)
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

    public function copy(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $inputs = $request->all();
                $modelcp = CbKkGDvLt::where('macskd',$inputs['macskdcp'])
                    ->first();

                if($modelcp->phanloai !='DT'){
                    $modelcskd = CsKdDvLt::where('macskd', $inputs['macskdcp'])->first();
                    if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                        $modelkkctdf = KkGDvLtCtDf::where('macskd', $inputs['macskdcp'])
                            ->delete();
                        $modelcb = KkGDvLt::where('mahs',$modelcp->mahs)->first();
                        //dd($modelcb);
                        $modelph = KkGDvLtCt::where('mahs',$modelcp->mahs)
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
                            $dsph->save();
                        }

                        $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                            ->get();
                        //dd($modelcskd);
                        //dd($modelph);
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


                        return view('manage.dvlt.kkgia.kkgiadv.create')
                            ->with('modelcskd', $modelcskd)
                            ->with('modelph', $modelph)//Thay thế
                            ->with('modeldsph', $modeldsph)
                            ->with('modelcb', $modelcb)
                            ->with('ngaynhap',$ngaynhap)
                            ->with('ngayhieuluc',$ngayhieuluc)
                            ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                    }else{
                        return view('errors.noperm');
                    }
                }else{
                    if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                        $modelcskd = CsKdDvLt::where('macskd', $inputs['macskdcp'])->first();
                        if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                            $modelttp = TtCsKdDvLt::where('macskd',$inputs['macskdcp'])
                                ->get();
                            $modeldtad = DoiTuongApDungDvLt::where('macskd',$inputs['macskdcp'])
                                ->get();
                            $modelctdf = KkGDvLtCtDf::where('macskd',$inputs['macskdcp'])->delete();
                            $modelcb = CbKkGDvLt::where('macskd',$inputs['macskdcp'])
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

                            $modelttdv = KkGDvLtCtDf::where('macskd',$inputs['macskdcp'])
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
                }

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }
    public function saochep($macskd){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                //$inputs = $request->all();
                $modelcp = CbKkGDvLt::where('macskd',$macskd)
                    ->first();

                if($modelcp->phanloai !='DT'){
                    $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                    if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                        $modelkkctdf = KkGDvLtCtDf::where('macskd', $macskd)
                            ->delete();
                        $modelcb = KkGDvLt::where('mahs',$modelcp->mahs)->first();
                        //dd($modelcb);
                        $modelph = KkGDvLtCt::where('mahs',$modelcp->mahs)
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
                            $dsph->save();
                        }

                        $modeldsph = KkGDvLtCtDf::where('macskd', $macskd)
                            ->get();
                        //dd($modelcskd);
                        //dd($modelph);
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

                        return view('manage.dvlt.kkgia.kkgiadv.create')
                            ->with('modelcskd', $modelcskd)
                            ->with('modelph', $modelph)//Thay thế
                            ->with('modeldsph', $modeldsph)
                            ->with('modelcb', $modelcb)
                            ->with('ngaynhap',$ngaynhap)
                            ->with('ngayhieuluc',$ngayhieuluc)
                            ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                    }else{
                        return view('errors.noperm');
                    }
                }else{

                    if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                        $modelcskd = CsKdDvLt::where('macskd',$macskd)->first();
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
                }

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    //Bỏ phần đính kèm
    public function create_dk($macskd){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                if(session('admin')->sadmin =='ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                    return view('manage.dvlt.kkgia.kkgiadv.create_dk')
                        ->with('modelcskd', $modelcskd)
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

    //Bỏ phần đính kèm
    public function store_dk(Request $request){
        if (Session::has('admin')) {

            $mahs = getdate()[0];
            $insert = $request->all();
            $file=$request->file('filedk');
            $filename =$mahs.'_'.$file->getClientOriginalName();
            $file->move(public_path() . '/data/uploads/attack/', $filename);

            $model = new KkGDvLt();
            $model->phanloai = 'DINHKEM';
            $model->filedk = $filename;

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
            $model->cqcq = $insert['cqcq'];
            $model->dvt = $insert['dvt'];
            $model->save();
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
                    $modelcb = CbKkGDvLt::where('macskd', $model->macskd)
                        ->first();
                    return view('manage.dvlt.kkgia.kkgiadv.edit')
                        ->with('model', $model)
                        ->with('modelct', $modelct)
                        ->with('modelcb',$modelcb)
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

    //Bỏ phần đính kèm
    public function edit_dk($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='DVLT') {
                $model = KkGDvLt::findOrFail($id);
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq) {

                    return view('manage.dvlt.kkgia.kkgiadv.edit_dk')
                        ->with('model', $model)
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
            //$model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaynhap'])));
            $model->socv = $input['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngayhieuluc'])));
            $model->socvlk = $input['socvlk'];
            $model->ngaycvlk = $input['ngaycvlk']==''? NULL  :date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaycvlk'])));;
            $model->ghichu = $input['ghichu'];
            $model->dvt = $input['dvt'];
            $model->plhs = $input['plhs'];
            $model->save();
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    //Bỏ phần đính kèm
    public function update_dk(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;
            if(isset($request->filedk)){
                if(file_exists(public_path() . '/data/uploads/attack/'.$model->filedk)){
                    File::Delete(public_path() . '/data/uploads/attack/'.$model->filedk);
                }
                $file=$request->file('filedk');

                $filename =$input['mahs'].'_'.$file->getClientOriginalName();
                $file->move(public_path() . '/data/uploads/attack/', $filename);
                $model->filedk=$filename;
            }
            $model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaynhap'])));
            $model->socv = $input['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngayhieuluc'])));
            $model->socvlk = $input['socvlk'];
            $model->ngaycvlk = $input['ngaycvlk']==''? NULL  :date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaycvlk'])));;
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
            //dd($model);
            if($input['ttnguoinop'] != ''){
                $model->ttnguoinop = $input['ttnguoinop'];
                $model->trangthai = 'Chờ nhận';
                $model->ngaychuyen = $tgchuyen;
                //$model->save();
                if($model->save()){
                    $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                    $dn = DnDvLt::where('masothue',$model->masothue)->first();
                    $data=[];
                    $data['tendn'] = $dn->tendn;
                    $data['masothue'] = $model->masothue;
                    $data['tg'] = $tgchuyen;
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['ttnguoinop'] = $input['ttnguoinop'];
                    $maildn = $dn->email;
                    $tendn = $dn->tendn;
                    $mailql = $tencqcq->email;
                    $tenql = $tencqcq->tendv;

                    Mail::send('mail.kkgia',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                        $message->to($maildn,$tendn)
                            ->to($mailql,$tenql)
                            ->subject('Thông báo nhận hồ sơ kê khai giá dịch vụ');
                        $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                    });

                    //History
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
            $macskd = $model->macskd;

            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function chuyenhscham(Request $request){
        if (Session::has('admin')) {
            $tgchuyen = Carbon::now()->toDateTimeString();
            $input = $request->all();
            $id = $input['idchuyenhscham'];
            $model = KkGDvLt::findOrFail($id);
            $model->ttnguoinop = 'Kỹ thuật viên';
            $model->trangthai = 'Chờ nhận';
            $model->ngaychuyen = $tgchuyen;
            //$model->save();
            if($model->save()){
                //History
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
                $his->ttnguoinop = 'Kỹ thuật viên';
                $his->ghichu = $model->ghichu;
                $his->ngaychuyen = $tgchuyen;
                $his->cqcq = $model->cqcq;
                $his->dvt = $model->dvt;
                $his->phanloai = $model->phanloai;
                $his->plhs =$model->plhs;
                $his->action = 'Chuyển hồ sơ kê khai(Kỹ thuật viên chuyển do đơn vị nộp kê khai chậm)';
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
    public function checkngay(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
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
            $ngayapdung = $model->ngayhieuluc;
            $ngaychuyen = Carbon::now()->toDateTimeString();
            if($model->plhs == 'GG') {
                if ($ngayapdung >= date('Y-m-d',strtotime($ngaychuyen))) {
                    $result['status'] = 'success';
                }
            }else {
                $modelchecknn = TtNgayNghiLe::where('ngaytu','<=',$ngaychuyen)
                    ->where('ngayden','>=',$ngaychuyen)->first();
                if(count($modelchecknn)>0){
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
                }else {
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

    public function checkgial1($mahs){
        $model = KkGDvLtCt::where('mahs',$mahs)->get();
        foreach($model as $tt){
            if($tt->mucgiakk > $tt->mucgialk)
               $check = '1'; //sai dk
            if($tt->mucgiakk = $tt->mucgialk) {
                if ($check = '1')
                    $check = '1';
                else
                    $check = '2';
            }
            if($tt->mucgiakk < $tt->mucgialk) {
                if ($check = '1')
                    $check = '1';
                else
                    $check = '2';
            }

        }

    }

    public function search(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue']: 'all';
            $dn = DnDvLt::all();
            if($inputs['masothue'] == 'all')
                $model = KkGDvLt::whereYear('ngaynhap',$inputs['nam'])
                    ->get();
            else
                $model = KkGDvLt::whereYear('ngaynhap',$inputs['nam'])
                    ->where('masothue',$inputs['masothue'])
                    ->get();
            $allcskd = CsKdDvLt::all();
            foreach($model as $ttkk){
                $this->getTTCSKD($allcskd,$ttkk);
            }

            return view('manage.dvlt.search.index')
                ->with('select_nam',$inputs['nam'])
                ->with('dn',$dn)
                ->with('selectdn',$inputs['masothue'])
                ->with('model',$model)
                ->with('select_masothue',$inputs['masothue'])
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