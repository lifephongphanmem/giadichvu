<?php

namespace App\Http\Controllers;

use App\CbKkDvVtXtx;
use App\DmDvVtXtx;
use App\DonViDvVt;
use App\KkDvVtXtx;
use App\KkDvVtXtxCt;
use App\KkDvVtXtxCtDf;
use App\PagDvVtXtx;
use App\PagDvVtXtx_Temp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkGiaDvVtTaxiController extends Controller
{
   public function index(){
       if (Session::has('admin')) {
           if(session('admin')->level == 'T' || session('admin')->level == 'H'){
               if(session('admin')->sadmin == 'ssa'){
                   $model = DonViDvVt::where('dvxtx','1')
                       ->get();

               }else{
                   $model = DonViDvVt::where('cqcq',session('admin')->cqcq)
                       ->where('dvxtx','1')
                       ->get();

               }
               return view('manage.dvvt.dvxtx.ttdn.index')
                   ->with('model',$model)
                   ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');
           }else {
               return view('errors.perm');
           }

       }else
           return view('errors.notlogin');
   }

    public function kekhaigia($masothue,$nam){
        if (Session::has('admin')) {
            $modeldn = DonViDvVt::where('masothue',$masothue)
                ->first();
                $model = KkDvVtXtx::where('masothue',$masothue)
                    ->whereYear('ngaynhap', $nam)
                    ->get();
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level== 'DVVT'){

                if(session('admin')->sadmin == 'ssa'
                    || session('admin')->level == 'T' && session('admin')->cqcq == $modeldn->cqcq
                    || session('admin')->level == 'H' && session('admin')->cqcq == $modeldn->cqcq
                    || session('admin')->mahuyen == $masothue){
                    return view('manage.dvvt.dvxtx.kkgiadv.index')
                        ->with('model',$model)
                        ->with('modeldn',$modeldn)
                        ->with('nam',$nam)
                        ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function kekhaigiadv($nam){
        if (Session::has('admin')) {
            $modeldn = DonViDvVt::where('masothue',session('admin')->mahuyen)
                ->first();
            $model = KkDvVtXtx::where('masothue',session('admin')->mahuyen)
                ->whereYear('ngaynhap', $nam)
                ->get();

            if(session('admin')->level== 'DVVT'){

                    return view('manage.dvvt.dvxtx.kkgiadv.index')
                        ->with('model',$model)
                        ->with('modeldn',$modeldn)
                        ->with('nam',$nam)
                        ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');

            }else {
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function create($masothue){
        if (Session::has('admin')) {
            $modeldn = DonViDvVt::where('masothue',$masothue)
                ->first();
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level== 'DVVT'){
                if(session('admin')->sadmin == 'ssa'
                    || (session('admin')->level == 'T' && session('admin')->cqcq == $modeldn->cqcq)
                    || (session('admin')->level == 'H' && session('admin')->cqcq == $modeldn->cqcq)
                    || session('admin')->mahuyen == $masothue){

                    KkDvVtXtxCtDf::where('masothue', $masothue)->delete();
                    PagDvVtXtx_Temp::where('masothue', $masothue)->delete();

                    $modelCB=CbKkDvVtXtx::select('socv','ngaynhap','masokk')->where('masothue', $masothue)->first();
                    $solk=null;
                    $ngaylk=null;
                    $masokk=null;

                    if (isset($modelCB)) {
                        //dd($modelCB);
                        $solk = $modelCB->socv;
                        $ngaylk = $modelCB->ngaynhap;
                        $masokk = $modelCB->masokk;
                    }
                    $mdDV=DmDvVtXtx::where('masothue',$masothue)->get();
                    //dd($modeldn);
                    foreach($mdDV as $dv){
                        $mdkk = new KkDvVtXtxCtDf();
                        $mdkk->masothue = $masothue;
                        $mdkk->madichvu = $dv->madichvu;
                        $mdkk->loaixe = $dv->loaixe;
                        $mdkk->tendichvu = $dv->tendichvu;
                        $mdkk->qccl = $dv->qccl;
                        $mdkk->dvt = $dv->dvt;
                        $mdCT = KkDvVtXtxCt::select('giakk')->where('masokk', $masokk)->where('madichvu', $dv->madichvu)->first();

                        $mdkk->giakklk = count($mdCT)>0 ? $mdCT->giakk : 0;
                        $mdkk->trenkmlk = count($mdCT)>0 ? $mdCT->trenkm : 1;
                        $mdkk->giakklkden = count($mdCT)>0 ? $mdCT->giakkden : 0;
                        $mdkk->giakklktl = count($mdCT)>0 ? $mdCT->giakktl : 0;
                        $mdkk->giakk =count($mdCT)>0 ? $mdCT->giakk : 0;
                        $mdkk->trenkm = count($mdCT)>0 ? $mdCT->trenkm : 1;
                        $mdkk->giakkden =count($mdCT)>0 ? $mdCT->giakkden : 0;
                        $mdkk->giakktl =count($mdCT)>0 ? $mdCT->giakktl : 0;
                        $mdkk->save();

                        //Phương án giá
                        $m_pag=new PagDvVtXtx_Temp();
                        $m_pag->masothue = $masothue;
                        $m_pag->madichvu = $dv->madichvu;
                        $m_pag->save();
                    }
                    $model=KkDvVtXtxCtDf::where('masothue', $masothue)->get();

                    return view('manage.dvvt.dvxtx.kkgiadv.create')
                        ->with('modeldn',$modeldn)
                        ->with('model',$model)
                        ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function create_cu($masothue){ //phương án giá la mảng
        if (Session::has('admin')) {
            $modeldn = DonViDvVt::where('masothue',$masothue)
                ->first();
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level== 'DVVT'){
                if(session('admin')->sadmin == 'ssa'
                    || (session('admin')->level == 'T' && session('admin')->cqcq == $modeldn->cqcq)
                    || (session('admin')->level == 'H' && session('admin')->cqcq == $modeldn->cqcq)
                    || session('admin')->mahuyen == $masothue){

                    KkDvVtXtxCtDf::where('masothue', $masothue)->delete();
                    PagDvVtXtx_Temp::where('masothue', $masothue)->delete();

                    $modelCB=CbKkDvVtXtx::select('socv','ngaynhap','masokk')->where('masothue', $masothue)->first();
                    $solk=null;
                    $ngaylk=null;
                    $masokk=null;

                    if (isset($modelCB)) {
                        //dd($modelCB);
                        $solk = $modelCB->socv;
                        $ngaylk = $modelCB->ngaynhap;
                        $masokk = $modelCB->masokk;
                    }
                    $mdDV=DmDvVtXtx::where('masothue',$masothue)->get();
                    //dd($modeldn);
                    foreach($mdDV as $dv){
                        $mdkk = new KkDvVtXtxCtDf();
                        $mdkk->masothue = $masothue;
                        $mdkk->madichvu = $dv->madichvu;
                        $mdkk->loaixe = $dv->loaixe;
                        $mdkk->tendichvu = $dv->tendichvu;
                        $mdkk->qccl = $dv->qccl;
                        $mdkk->dvt = $dv->dvt;
                        $mdCT = KkDvVtXtxCt::select('giakk')->where('masokk', $masokk)->where('madichvu', $dv->madichvu)->first();

                        $mdkk->giakklk = count($mdCT)>0 ? $mdCT->giakk : 0;
                        $mdkk->trenkmlk = count($mdCT)>0 ? $mdCT->trenkm : 1;
                        $mdkk->giakklkden = count($mdCT)>0 ? $mdCT->giakkden : 0;
                        $mdkk->giakklktl = count($mdCT)>0 ? $mdCT->giakktl : 0;
                        $mdkk->giakk =count($mdCT)>0 ? $mdCT->giakk : 0;
                        $mdkk->trenkm = count($mdCT)>0 ? $mdCT->trenkm : 1;
                        $mdkk->giakkden =count($mdCT)>0 ? $mdCT->giakkden : 0;
                        $mdkk->giakktl =count($mdCT)>0 ? $mdCT->giakktl : 0;

                        $a=array('nguyengia'=>0,
                            'tongkm'=>0,
                            'kmcokhach'=>0,
                            'khauhao'=>0,
                            'baohiem'=>0,
                            'baohiempt'=>0,
                            'baohiemtnds'=>0,
                            'lainganhang'=>0,
                            'thuevp'=>0,
                            'suachualon'=>0,
                            'samlop'=>0,
                            'dangkiem'=>0,
                            'quanly'=>0,
                            'banhang'=>0,
                            'luonglaixe'=>0,
                            'nhienlieuchinh'=>0,
                            'nhienlieuboitron'=>0,
                            'chiphibdcs'=>0,
                            'giakekhai'=>0,
                            'doanhthu'=>0
                        );
                        $mdkk->pag = json_encode($a);
                        $mdkk->save();
                    }
                    $model=KkDvVtXtxCtDf::where('masothue', $masothue)->get();


                    return view('manage.dvvt.dvxtx.kkgiadv.create')
                        ->with('modeldn',$modeldn)
                        ->with('model',$model)
                        ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $insert = $request->all();
            $makk=$insert['masothue'] . '_' . getdate()[0];

            $model = new KkDvVtXtx();
            $model->masokk = $makk;
            $model->cqcq = $insert['cqcq'];
            $model->masothue = $insert['masothue'];
            $model->ngaynhap =getDateToDb($insert['ngaynhap']) ;
            $model->socv = $insert['socv'];
            $model->socvlk = $insert['socvlk'];
            $model->ngaynhaplk = getDateToDb($insert['ngaynhaplk']);
            $model->ngayhieuluc = getDateToDb($insert['ngayhieuluc']);
            $model->trangthai = 'Chờ chuyển';
            $model->uudai = $insert['uudai'];
            $model->ghichu = $insert['yeuto'];
            $model->save();
            //Chi tiết kê khai
            $m_kkdf=KkDvVtXtxCtDf::select('madichvu','loaixe','tendichvu','qccl','dvt','giakk','trenkm','giakkden','giakktl',
                'giakklk','trenkmlk','giakklkden','giakklktl',DB::raw("'".$makk."' as masokk"),'pag','ghichu_pag')
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            KkDvVtXtxCt::insert($m_kkdf);

            $m_pag=PagDvVtXtx_Temp::where('masothue', $insert['masothue'])->get();
            foreach($m_pag as $pag){
                $pag->masokk = $makk;
                PagDvVtXtx::create($pag->toarray());
            }


            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/ke_khai_dich_vu_van_tai/xe_taxi/masothue='.$insert['masothue'].'&nam='.date('Y'));
            }else{
                return redirect('ke_khai_dich_vu_van_tai/xe_taxi/nam='.date('Y'));
            }
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = KkDvVtXtx::findorFail($id);
            $masothue = $model->masothue;
            $modeldn = DonViDvVt::where('masothue',$masothue)
                ->first();
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level== 'DVVT'){
                if(session('admin')->sadmin == 'ssa'
                    || session('admin')->level == 'T' && session('admin')->cqcq == $modeldn->cqcq
                    || session('admin')->level == 'H' && session('admin')->cqcq == $modeldn->cqcq
                    || session('admin')->mahuyen == $masothue){

                    $modeldv = KkDvVtXtxCt::where('masokk',$model->masokk)
                        ->get();
                    //dd($modeldv);

                    return view('manage.dvvt.dvxtx.kkgiadv.edit')
                        ->with('modeldn',$modeldn)
                        ->with('modeldv',$modeldv)
                        ->with('model',$model)
                        ->with('pageTitle','Kê khai giá dịch vụ vận tải xe taxi');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function update($id, Request $request){
        if (Session::has('admin')) {
            $insert = $request->all();

            $model = KkDvVtXtx::findOrFail($id);
            $model->masothue = $insert['masothue'];
            $model->ngaynhap =getDateToDb($insert['ngaynhap']) ;
            $model->socv = $insert['socv'];
            $model->socvlk = $insert['socvlk'];
            $model->ngaynhaplk = getDateToDb($insert['ngaynhaplk']);
            $model->ngayhieuluc = getDateToDb($insert['ngayhieuluc']);
            $model->uudai = $insert['uudai'];
            $model->ghichu = $insert['yeuto'];
            $model->save();

            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/ke_khai_dich_vu_van_tai/xe_taxi/masothue='.$insert['masothue'].'&nam='.date('Y'));
            }else{
                return redirect('ke_khai_dich_vu_van_tai/xe_taxi/nam='.date('Y'));
            }
        }else
            return view('errors.notlogin');
    }
    public function delete(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();

            $model = KkDvVtXtx::where('id',$input['iddelete']) ->first();
            $masothue = $model->masothue;
            $modeldv = KkDvVtXtxCt::where('masokk',$model->masokk)->delete();
            $model->delete();

            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/ke_khai_dich_vu_van_tai/xe_taxi/masothue='.$masothue.'&nam='.date('Y'));
            }else{
                return redirect('ke_khai_dich_vu_van_tai/xe_taxi/nam='.date('Y'));
            }
        }else
            return view('errors.notlogin');
    }
    public function chuyen(Request $request){
        if (Session::has('admin')) {

            $inputs = $request->all();
            $model = KkDvVtXtx::where('id', $inputs['idchuyen'])->first();
            $masothue = $model->masothue;
            if($inputs['ttnguoinop']!='') {
                $model->trangthai = 'Chờ nhận';
                $model->ttnguoinop = $inputs['ttnguoinop'];
                $model->telnguoinop = $inputs['telnguoinop'];
                $model->faxnguoinop = $inputs['faxnguoinop'];
                $model->ngaychuyen = Carbon::now()->toDateTimeString();
                $model->save();
            }
                if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->sadmin == 'ssa') {
                    return redirect('/ke_khai_dich_vu_van_tai/xe_taxi/masothue=' . $masothue . '&nam=' . date('Y'));
                } else {
                    return redirect('ke_khai_dich_vu_van_tai/xe_taxi/nam=' . date('Y'));
                }

        }else
            return view('errors.notlogin');
    }
    public function show($masokk){
        if (Session::has('admin')) {
            $modelkk = KkDvVtXtx::where('masokk',$masokk)
                ->first();
            $modeldonvi = DonViDvVt::where('masothue',$modelkk->masothue)
                ->first();
            $modelgia = KkDvVtXtxCt::where('masokk',$masokk)
                ->get();

            return view('reports.kkgdvvt.kkgdvxtx.newprintf')
                ->with('modelkk',$modelkk)
                ->with('modeldonvi',$modeldonvi)
                ->with('modelgia',$modelgia)
                ->with('pageTitle','Kê khai giá dịch vụ vận tải taxi');

        }else
            return view('errors.notlogin');
    }
}
