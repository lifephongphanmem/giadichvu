<?php

namespace App\Http\Controllers;

use App\CbKkDvVtXk;
use App\DmDvVtXk;
use App\DmGiaHL;
use App\GeneralConfigs;
use App\KkDvVtXkCt;
use App\KkDvVtXkCtDf;
use App\KkGiaHL;
use App\KkGiaHLDf;
use App\PagDvVtXk;
use App\PagDvVtXk_Temp;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\KkDvVtXk;
use App\DonViDvVt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkDvVtXkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($nam)
    {
        if (Session::has('admin')) {
            $masothue=session('admin')->mahuyen;
            if(session('admin')->level == 'T' || session('admin')->level == 'H'){
                if(session('admin')->sadmin == 'ssa'){
                    $model = DonViDvVt::all();
                }else{
                    $model = DonViDvVt::where('cqcq',session('admin')->cqcq)
                        ->get();
                    /*
                    $model = KkDvVtXk::where('cqcq',session('admin')->cqcq)
                        ->whereYear('ngaynhap', $nam)
                        ->orderBy('ngaynhap', 'asc')
                        ->get();
                    */
                }
                return view('manage.dvvt.template.dsdonvi_kekhai')
                    ->with('model',$model)
                    ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                    ->with('pageTitle','Kê khai giá dịch vụ vận tải');
            }else {
                $model = KkDvVtXk::where('masothue',$masothue)
                    ->whereYear('ngaynhap', $nam)
                    ->orderBy('ngaynhap', 'asc')
                    ->get();

            }

            $per=array(
                'create'=>can('kkdvvtxk','create'),
                'edit' =>can('kkdvvtxk','edit'),
                'delete' =>can('kkdvvtxk','delete'),
                'approve'=>can('kkdvvtxk','approve')
            );
            //dd($per);
            return view('manage.dvvt.dvxk.kkdv.index')
                ->with('model',$model)
                ->with('per',$per)
                ->with('nam',$nam)
                ->with('masothue',$masothue)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('pageTitle','Kê khai giá vận tải hành khách bằng xe ô tô theo tuyến cố định');
        }else
            return view('errors.notlogin');
    }

    public function show($masothue)
    {
        if (Session::has('admin')) {
            $model = KkDvVtXk::where('masothue',$masothue)
                ->whereYear('ngaynhap', date('Y'))
                ->orderBy('ngaynhap', 'asc')
                ->get();
            $tendonvi=DonViDvVt::select('tendonvi')->where('masothue',$masothue)->first()->tendonvi;
            $per=array(
                'create'=>can('kkdvvtxk','create'),
                'edit' =>can('kkdvvtxk','edit'),
                'delete' =>can('kkdvvtxk','delete'),
                'approve'=>can('kkdvvtxk','approve')
            );
            //dd($per);
            return view('manage.dvvt.dvxk.kkdv.index_donvi')
                ->with('model',$model)
                ->with('per',$per)
                ->with('nam',date('Y'))
                ->with('masothue',$masothue)
                ->with('tendonvi',$tendonvi)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('pageTitle','Kê khai giá vận tải hành khách bằng xe ô tô theo tuyến cố định');
        }else
            return view('errors.notlogin');
    }

    public function getTenDV($atenDV, $array){
        foreach($atenDV as $tenDV){
            if($tenDV->masothue == $array->masothue)
                $array->tendonvi = $tenDV->tendonvi;
        }
    }

    public function indexXD($thang,$nam,$pl)
    {
        if (Session::has('admin')) {
            if($pl == 'cho_nhan') {
                $trangthai = 'Chờ nhận';
                if ((session('admin')->level == 'T' & session('admin')->sadmin == 'ssa')
                    ||(session('admin')->level == 'H' & session('admin')->sadmin == 'ssa'))
                {
                    $model = KkDvVtXk::where('trangthai', $trangthai)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                } else {
                    $model = KkDvVtXk::where('trangthai', $trangthai)
                        ->where('cqcq', session('admin')->cqcq)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                }
            }
            else{
                $trangthai = 'Công bố';
                $model = CbKkDvVtXk::whereMonth('ngaynhan',$thang)
                    ->whereYear('ngaynhan', $nam)
                    ->get();
            }

            $modeldv = DonViDvVt::all();
            foreach($model as $dv){
                $this->getTenDV($modeldv, $dv);
            }

            $per=array(
                'index'=>can('kkdvvtxk','index'),
                'create'=>can('kkdvvtxk','create'),
                'edit' =>can('kkdvvtxk','edit'),
                'delete' =>can('kkdvvtxk','delete'),
                'approve'=>can('kkdvvtxk','approve')
            );

            return view('manage.dvvt.dvxk.xetduyet.index')
                ->with('model',$model)
                ->with('thang',$thang)
                ->with('nam',$nam)
                ->with('pl',$pl)
                ->with('per',$per)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('pageTitle','Xét duyệt kê khai giá vận tải hành khách bằng xe ô tô theo tuyến cố định');
        }else
            return view('errors.notlogin');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($masothue)
    {
        if (Session::has('admin')) {
            KkDvVtXkCtDf::where('masothue', $masothue)->delete();
            KkGiaHLDf::where('masothue', $masothue)->delete();
            PagDvVtXk_Temp::where('masothue', $masothue)->delete();

            $modelCB=CbKkDvVtXk::select('socv','ngaynhap','masokk')->where('masothue', $masothue)->first();
            $solk=null;
            $ngaylk=null;
            $masokk=null;

            if (isset($modelCB)) {
                $solk = $modelCB->socv;
                $ngaylk = $modelCB->ngaynhap;
                $masokk = $modelCB->masokk;
            }
            $mdDV=DmDvVtXk::where('masothue',$masothue)->get();
            foreach($mdDV as $dv){
                $mdkk = new KkDvVtXkCtDf();
                $mdkk->masothue = $masothue;
                $mdkk->diemdau = $dv->diemdau;
                $mdkk->diemcuoi = $dv->diemcuoi;
                $mdkk->madichvu = $dv->madichvu;
                $mdkk->loaixe = $dv->loaixe;
                $mdkk->tendichvu = $dv->tendichvu;
                $mdkk->qccl = $dv->qccl;
                $mdkk->dvt = $dv->dvt;
                $mdkk->sokm = $dv->sokm;
                $mdCT = KkDvVtXkCt::select('giakk')->where('masokk', $masokk)->where('madichvu', $dv->madichvu)->first();

                $mdkk->giakklk = count($mdCT)>0 ? $mdCT->giakk : 0;
                $mdkk->giakk = count($mdCT)>0 ? $mdCT->giakk : 0;
                $mdkk->giahl =0;
                $mdkk->save();

                //Phương án giá
                $m_pag=new PagDvVtXk_Temp();
                $m_pag->masothue = $masothue;
                $m_pag->madichvu = $dv->madichvu;
                $m_pag->save();
            }

            $mdHL=DmGiaHL::where('masothue',$masothue)->get();
            foreach($mdHL as $dv){
                $mdkk = new KkGiaHLDf();
                $mdkk->masothue = $masothue;
                $mdkk->madichvu = $dv->madichvu;
                $mdkk->tendichvu = $dv->tendichvu;
                $mdkk->qccl = $dv->qccl;
                $mdkk->dvt = $dv->dvt;
                $mdCT = KkGiaHL::select('giahl')->where('masokk', $masokk)->where('madichvu', $dv->madichvu)->first();
                $mdkk->giahllk = count($mdCT)>0 ? $mdCT->giahl : 0;
                $mdkk->giahl =0;
                $mdkk->save();
            }

            $model=KkDvVtXkCtDf::where('masothue', $masothue)->orderby('tendichvu')->get();
            $model_hl=KkGiaHLDf::where('masothue', $masothue)->get();
            return view('manage.dvvt.dvxk.kkdv.create')
                ->with('pageTitle','Kê khai mới giá vận tải hành khách bằng xe ô tô theo tuyến cố định')
                ->with('socvlk',$solk)
                ->with('ngaycvlk',$ngaylk)
                ->with('masothue',$masothue)
                ->with('cqcq',session('admin')->cqcq)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('model',$model)
                ->with('model_hl',$model_hl);
        }else
            return view('errors.notlogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::has('admin')) {
            $insert = $request->all();
            $makk=$insert['masothue']. '_' . getdate()[0];

            //dd($insert['ngaynhaplk']);
            $model = new KkDvVtXk();
            $model->masokk = $makk;
            $model->cqcq = $insert['cqcq'];
            $model->masothue = $insert['masothue'];
            $model->ngaynhap =getDateToDb($insert['ngaynhap']);
            $model->socv = $insert['socv'];
            $model->socvlk = $insert['socvlk'];
            $model->ngaynhaplk =getDateToDb($insert['ngaynhaplk']);
            $model->ngayhieuluc =getDateToDb($insert['ngayhieuluc']);
            $model->trangthai = 'Chờ chuyển';
            $model->uudai = $insert['uudai'];
            $model->ghichu = $insert['ghichu'];
            $model->save();
            //Chi tiết kê khai
            $m_kkdf=KkDvVtXkCtDf::select('sokm','diemdau','diemcuoi','madichvu','loaixe','tendichvu','qccl','dvt','giakk','giakklk','giahl',DB::raw("'".$makk."' as masokk"))
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            KkDvVtXkCt::insert($m_kkdf);

            //Chi tiết giá hành lý
            $m_hldf=KkGiaHLDf::select('madichvu','tendichvu','qccl','dvt','giahllk','giahl',DB::raw("'".$makk."' as masokk"))
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            KkGiaHL::insert($m_hldf);
            //Phương án giá
            $m_pag=PagDvVtXk_Temp::select('masothue','masokk','madichvu','giaitrinh','sanluong','cpnguyenlieutt','cpcongnhantt','cpkhauhaott','cpsanxuatdt','cpsanxuatc','cptaichinh','cpbanhang','cpquanly',DB::raw("'".$makk."' as masokk"))
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            PagDvVtXk::insert($m_pag);
            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/don_vi/ma_so='.$insert['masothue']);
            }else{
                return redirect('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/nam='.date('Y'));
            }
        }else
            return view('errors.notlogin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::has('admin')) {
            $model = KkDvVtXk::findOrFail($id);
            $modeldv=KkDvVtXkCt::where('masokk',$model->masokk)->orderby('tendichvu')->get();
            $model_hl=KkGiaHL::where('masokk',$model->masokk)->get();
            return view('manage.dvvt.dvxk.kkdv.edit')
                ->with('model',$model)
                ->with('modeldv',$modeldv)
                ->with('model_hl',$model_hl)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('pageTitle','Chỉnh sửa kê khai giá vận tải hành khách bằng xe ô tô theo tuyến cố định');
        }else
            return view('errors.notlogin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            $update = $request->all();
            $model = KkDvVtXk::findOrFail($id);
            $model->ngaynhap = getDateToDb($update['ngaynhap']);
            $model->socv = $update['socv'];
            $model->ngaynhaplk = getDateToDb($update['ngaynhaplk']);
            $model->socvlk = $update['socvlk'];
            $model->ngayhieuluc = getDateToDb($update['ngayhieuluc']);
            $model->ghichu = $update['ghichu'];
            $model->uudai = $update['uudai'];
            $model->save();
            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/don_vi/ma_so='.$update['masothue']);
            }else{
                return redirect('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/nam='.date('Y'));
            }
        }else
            return view('errors.notlogin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkDvVtXk::where('id',$input['iddel'])
                ->first();
            //dd($model);
            if($model->delete()) {
                KkDvVtXkCt::where('masokk', $model->masokk)->delete();
                PagDvVtXk::where('masokk', $model->masokk)->delete();
            }
            return redirect('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/'.'nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function chuyen(Request $request){
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
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkDvVtXk::findOrFail($inputs['id']);
            $model->trangthai = 'Chờ nhận';
            $model->ttnguoinop = $inputs['ttnguoinop'];
            $model->ngaychuyen = Carbon::now()->toDateTimeString();
            $model->save();
            $result['message'] = 'Chuyển thành công.';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function accept(Request $request){
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

        $inputs = $request->all();

        if(isset($inputs['id'])){
            $id=$inputs['id'];
            $model = KkDvVtXk::findOrFail($id);
            $model->trangthai = 'Duyệt';
            $model->ngaynhan = $inputs['ngaynhan'];
            $model->sohsnhan = $inputs['sohsnhan'];
            if($model->save()){
                $modelconfig = GeneralConfigs::first();
                $modelconfig->sodvvt = getGeneralConfigs()['sodvvt'] + 1;
                $modelconfig->save();
            }

            $result['message'] = 'Xét duyệt thành công.';
            $result['status'] = 'success';
            CbKkDvVtXk::where('masothue',$model->masothue)->delete();

            $m_cb = new CbKkDvVtXk();
            $m_cb->masothue = $model->masothue;
            $m_cb->masokk = $model->masokk;
            $m_cb->socv = $model->socv;
            $m_cb->ngaynhap = $model->ngaynhap;
            $m_cb->socvlk = $model->socvlk;
            $m_cb->ngaynhaplk = $model->ngaynhaplk;
            $m_cb->ngayhieuluc = $model->ngayhieuluc;
            $m_cb->ttnguoinop = $model->ttnguoinop;
            $m_cb->ngaynhan = $model->ngaynhan;
            $m_cb->sohsnhan = $model->sohsnhan;
            $m_cb->ngaychuyen = $model->ngaychuyen;
            $m_cb->lydo = $model->lydo;
            $m_cb->trangthai = $model->trangthai;
            $m_cb->uudai = $model->uudai;
            $m_cb->ghichu = $model->ghichu;
            $model->trangthai = 'Đang công bố';
            $m_cb->save();

            //$modelkk = KkDvVtXk::findOrFail($id);
            //$modeldel = CbKkDvVtXk::where('masothue',$modelkk->masothue)->delete();

            //DB::statement("INSERT INTO cbkkdvvtxk SELECT * FROM kkdvvtxk WHERE id='".$id."'");
            //DB::statement("Update cbkkdvvtxk set trangthai='Đang công bố' WHERE id='".$id."'");
        }
        die(json_encode($result));
    }

    public function nhanhs(Request $request){
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
        $input = $request->all();
        $id=$input['id'];
        if (Session::has('admin')) {
            $model = KkDvVtXk::findOrFail($id);
            $model->ngaynhan = $input['ngaynhan'];
            $model->sohsnhan = $input['sohsnhan'];
            $model->trangthai = 'Chờ duyệt';
            if($model->save()){
                $modelconfig = GeneralConfigs::first();
                $modelconfig->sodvvt = getGeneralConfigs()['sodvvt'] + 1;
                $modelconfig->save();
            }
            $result['message'] = 'Trả lại thành công.';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function tralai(Request $request){
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
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkDvVtXk::findOrFail($inputs['id']);
            $model->trangthai = 'Bị trả lại';
            $model->lydo = $inputs['lydo'];
            /* có nên xóa thông tin người nôp khi trả lại ko ?????
            $model->nguoinop = $inputs['nguoinop'];
            $model->ngaychuyen = $inputs['ngaychuyen'];
            $model->sdtnn = $inputs['sdtnn'];
            $model->faxnn = $inputs['faxnn'];
            $model->emailnn = $inputs['emailnn'];
            */
            $model->save();
            $result['message'] = 'Trả lại thành công.';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function search($masothue,$nam){
        if (Session::has('admin')) {
            $m_dv=DonViDvVt::select('masothue','tendonvi')->get();
            $dmdv=array_column($m_dv->toArray(),'tendonvi','masothue');

            $model = KkDvVtXk::where('trangthai','Duyệt')
                ->where('masothue', $masothue)
                ->whereYear('ngaychuyen', $nam)
                ->get();
            if($masothue!='all'){
                $model=$model->where('masothue',$masothue);
            }

            foreach($model as $ct){
                $ct->tendonvi=$dmdv[$ct->masothue];
            }
            //dd($model);
            return view('manage.dvvt.dvxk.search.index')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('m_dv',$m_dv)
                ->with('masothue',$masothue)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('pageTitle','Tra cứu giá dịch vụ vận tải');
        }else
            return view('errors.notlogin');
    }

    public function getsearch(Request $request){
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
        $inputs = $request->all();
        if(isset($inputs['masothue'])){
            $model = KkDvVtXk::where('masothue',$inputs['masothue'])
                ->orderBy('ngaynhap', 'esc')
                ->get();

            $result['message'] = '<tbody id="tthskk">';
            if(count($model)>0) {
                foreach ($model as $tt) {
                    $result['message'] .= '<tr>';
                    $result['message'] .= '<td>' . getDayVn($tt->ngaynhap) . '</td>';
                    $result['message'] .= '<td>' . getDayVn($tt->ngayhieuluc) . '</td>';
                    $result['message'] .= '<td>' . $tt->socv . '</td>';
                    $result['message'] .= '<td>
                    <a href="' . url('/dvvantai/dvxk/print/' . $tt->masokk) . '" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                    </td>';
                    $result['message'] .= '</tr>';
                }
            }
            $result['message'] .= '</tbody>';
            $result['status'] = 'success';

        }

        die(json_encode($result));
    }

    public function getpag_temp(Request $request){
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
        $inputs = $request->all();
        //lấy tên dịch vụ gán vào
        $model_dm = DmDvVtXk::where('madichvu',$inputs['madichvu'])->first();
        $model = PagDvVtXk_Temp::where('masothue',session('admin')->mahuyen)->where('madichvu',$inputs['madichvu'])->first();
        $model->tuyenduong = $model_dm->loaixe . " - " . $model_dm->tendichvu;
        die($model);
    }

    public function getpag_temp_cu(Request $request){
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
        $inputs = $request->all();

        $model = PagDvVtXk_Temp::where('masothue',session('admin')->mahuyen)->where('madichvu',$inputs['madichvu'])->first();

        $result['message'] = '<div class="form-horizontal" id="pag">';
        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label for="sanluong" class="col-md-6 control-label">Sản lượng tính giá</label>';

        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="sanluong" name="sanluong" value="'.$model->sanluong.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';

        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label for="cpnguyenlieutt" class="col-md-6 control-label">Chi phí nguyên liệu trực tiếp</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpnguyenlieutt" name="cpnguyenlieutt" value="'.$model->cpnguyenlieutt.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpcongnhantt" class="col-md-6 control-label">Chi phí nhân công trực tiếp</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpcongnhantt" name="cpcongnhantt" value="'.$model->cpcongnhantt.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpkhauhaott" class="col-md-6 control-label">Chi phí khấu hao máy móc trực tiếp</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpkhauhaott" name="cpkhauhaott" value="'.$model->cpkhauhaott.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpsanxuatdt" class="col-md-6 control-label">Chi phí sản xuất, kinh doanh đặc thù</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpsanxuatdt" name="cpsanxuatdt" value="'.$model->cpsanxuatdt.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';
        $result['message'] .= '</div>';

        $result['message'] .= '<div class="form-group">';
        $result['message'] .= '<label for="cpsanxuatc" class="col-md-6 control-label">Chi phí sản xuất chung</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpsanxuatc" name="cpsanxuatc" value="'.$model->cpsanxuatc.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cptaichinh" class="col-md-6 control-label">Chi phí tài chính</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cptaichinh" name="cptaichinh" value="'.$model->cptaichinh.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpbanhang" class="col-md-6 control-label">Chi phí bán hàng</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpbanhang" name="cpbanhang" value="'.$model->cpbanhang.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpquanly" class="col-md-6 control-label">Chi phí quản lý</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="cpquanly" name="cpquanly" value="'.$model->cpquanly.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label for="cpquanly" class="col-md-6 control-label">Lợi nhuận</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= '<input style="text-align: right" type="text" id="loinhuan" name="loinhuan" value="'.$model->loinhuan.'" class="form-control" data-mask="fdecimal">';
        $result['message'] .= '</div>';

        $result['message'] .= '<label class="col-md-6 control-label">Giải trình chi tiết</label>';
        $result['message'] .= '<div style="padding-bottom: 2px" class="col-md-6">';
        $result['message'] .= ' <textarea rows="4" id="giaitrinh" name="giaitrinh" class="form-control">'.$model->giaitrinh.'</textarea>';
        $result['message'] .= '</div>';

        $result['message'] .= '</div>';
        $result['message'] .= '<input type="hidden" id="idpag" name="idpag" value="'.$model->id.'"/>';
        $result['message'] .= '</div>';

        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function updatepag_temp(Request $request){
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
        $inputs = $request->all();

        $model = PagDvVtXk_Temp::findOrFail($inputs['id']);
        $model->sanluong=getDbl($inputs['sanluong']);
        $model->cpnguyenlieutt=getDbl($inputs['cpnguyenlieutt']);
        $model->cpcongnhantt=getDbl($inputs['cpcongnhantt']);
        $model->cpkhauhaott=getDbl($inputs['cpkhauhaott']);
        $model->cpsanxuatdt=getDbl($inputs['cpsanxuatdt']);
        $model->cpsanxuatc=getDbl($inputs['cpsanxuatc']);
        $model->cptaichinh=getDbl($inputs['cptaichinh']);
        $model->cpbanhang=getDbl($inputs['cpbanhang']);
        $model->cpquanly=getDbl($inputs['cpquanly']);
        $model->loinhuan=getDbl($inputs['loinhuan']);
        $model->giaitrinh=$inputs['giaitrinh'];
        $model->save();

        $result['message']= 'Cập nhật thành công.';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function getpag(Request $request){
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
        $inputs = $request->all();

        $model = PagDvVtXk::where('masokk',$inputs['masokk'])
            ->where('madichvu',$inputs['madichvu'])
            ->first();
        $model_dm = DmDvVtXk::where('madichvu',$inputs['madichvu'])->first();
        $model->tuyenduong = $model_dm->loaixe . " - " . $model_dm->tendichvu;
        die($model);

        die(json_encode($result));
    }

    public function updatepag(Request $request){
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
        $inputs = $request->all();

        $model = PagDvVtXk::findOrFail($inputs['id']);
        $model->sanluong=getDbl($inputs['sanluong']);
        $model->cpnguyenlieutt=getDbl($inputs['cpnguyenlieutt']);
        $model->cpcongnhantt=getDbl($inputs['cpcongnhantt']);
        $model->cpkhauhaott=getDbl($inputs['cpkhauhaott']);
        $model->cpsanxuatdt=getDbl($inputs['cpsanxuatdt']);
        $model->cpsanxuatc=getDbl($inputs['cpsanxuatc']);
        $model->cptaichinh=getDbl($inputs['cptaichinh']);
        $model->cpbanhang=getDbl($inputs['cpbanhang']);
        $model->cpquanly=getDbl($inputs['cpquanly']);
        $model->loinhuan=getDbl($inputs['loinhuan']);
        $model->giaitrinh=$inputs['giaitrinh'];
        $model->save();

        $result['message']= 'Cập nhật thành công.';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function printKK($masokk)
    {
        if (Session::has('admin')) {
            $modelkk = KkDvVtXk::where('masokk', $masokk)
                ->first();
            $modeldonvi = DonViDvVt::where('masothue', $modelkk->masothue)
                ->first();
            $modeldm = DmDvVtXk::where('masothue', $modelkk->masothue)->get();

            $modelgia = KkDvVtXkCt::where('masokk', $masokk)->get();

            $model_hl = KkGiaHL::where('masokk', $masokk)->get();


            return view('reports.kkgdvvt.kkgdvxk.printf')
                ->with('modeldonvi', $modeldonvi)
                ->with('modelkk', $modelkk)
                ->with('modelgia', $modelgia)
                ->with('modeldm', $modeldm)
                ->with('model_hl', $model_hl)
                ->with('pageTitle', 'Kê khai giá dịch vụ vận tải');
        } else
            return view('errors.notlogin');
    }

    public function printPAG($masokk)
    {
        if (Session::has('admin')) {
            $modelkk = KkDvVtXk::where('masokk', $masokk)
                ->first();
            $modeldonvi = DonViDvVt::where('masothue', $modelkk->masothue)
                ->first();
            $modeldm = DmDvVtXk::where('masothue', $modelkk->masothue)->get();
            $modelgia = KkDvVtXkCt::where('masokk', $masokk)->get();
            $modelpag = PagDvVtXk::where('masokk', $masokk)->get();

            foreach($modelgia as $gia){
                foreach($modelpag as $ct){
                    if($ct->madichvu==$gia->madichvu) {
                        $gia->sanluong = $ct->sanluong;
                        $gia->cpnguyenlieutt = $ct->cpnguyenlieutt;
                        $gia->cpcongnhantt = $ct->cpcongnhantt;
                        $gia->cpkhauhaott = $ct->cpkhauhaott;
                        $gia->cpsanxuatdt = $ct->cpsanxuatdt;
                        $gia->cpsanxuatc = $ct->cpsanxuatc;
                        $gia->cptaichinh = $ct->cptaichinh;
                        $gia->cpbanhang = $ct->cpbanhang;
                        $gia->cpquanly = $ct->cpquanly;
                        $gia->giaitrinh = $ct->giaitrinh;
                        $gia->cpdau = $ct->cpdau;
                        $gia->cpmonhot = $ct->cpmonhot;
                        $gia->cpphutung = $ct->cpphutung;
                        $gia->loinhuan = $ct->loinhuan;
                        $gia->cpkhac = $ct->cpkhac;
                        break;
                    }
                }
            }
            //dd($modelgia);
            return view('reports.kkgdvvt.kkgdvxk.printfPAG')
                ->with('modeldonvi', $modeldonvi)
                ->with('modelkk', $modelkk)
                ->with('modelgia', $modelgia)
                ->with('modeldm', $modeldm)
                ->with('modelpag', $modelpag)
                ->with('pageTitle', 'Kê khai giá dịch vụ vận tải');
        } else
            return view('errors.notlogin');
    }

    function get_giadv(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkDvVtXkCt::find($inputs['id']);
        die($model);
    }

    function get_giadv_temp(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkDvVtXkCtDf::find($inputs['id']);
        die($model);
    }

    function get_giahl(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkGiaHL::find($inputs['id']);
        die($model);
    }

    function get_giahl_temp(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = KkGiaHLDf::find($inputs['id']);
        die($model);
    }

    public function update_giadv_temp(Request $request){
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
        $inputs = $request->all();

        if($inputs['id']>0) {//Cập nhật dịch vụ
            $model = KkDvVtXkCtDf::findOrFail($inputs['id']);
            $model->loaixe = $inputs['loaixe'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvt = $inputs['dvt'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        }else{//Thêm mới dịch vụ
            $madichvu=getdate()[0];
            $model = new KkDvVtXkCtDf();
            $model->masothue = $inputs['masothue'];
            $model->madichvu = $madichvu;
            $model->loaixe = $inputs['loaixe'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvt = $inputs['dvt'];
            $model->ghichu = $inputs['ghichu'];
            if($model->save()){
                $m_pag=new PagDvVtXk_Temp();
                $m_pag->masothue = $inputs['masothue'];
                $m_pag->madichvu = $madichvu;
                $m_pag->save();
            }
        }
        //Trả lại kết quả
        $result['message'] =$this->return_html(KkDvVtXkCtDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function update_giadv(Request $request){
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
        $inputs = $request->all();

        if($inputs['id']>0) {//Cập nhật dịch vụ
            $model = KkDvVtXkCt::findOrFail($inputs['id']);
            $model->loaixe = $inputs['loaixe'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvt = $inputs['dvt'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        }else{//Thêm mới dịch vụ
            $madichvu=getdate()[0];
            $model = new KkDvVtXkCt();
            $model->madichvu = $madichvu;
            $model->masokk = $inputs['masokk'];
            $model->loaixe = $inputs['loaixe'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvt = $inputs['dvt'];
            $model->ghichu = $inputs['ghichu'];
            if($model->save()){
                $m_pag=new PagDvVtXk();
                $m_pag->masothue = $inputs['masothue'];
                $m_pag->madichvu = $madichvu;
                $m_pag->masokk = $inputs['masokk'];
                $m_pag->save();
            }
        }

        //Trả lại kết quả
        $result['message'] =$this->return_html(KkDvVtXkCt::where('masokk', $inputs['masokk'])->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function del_giadv_temp(Request $request)
    {
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
        $inputs = $request->all();
        $model=KkDvVtXkCtDf::findOrFail($inputs['id']);
        $model->delete();
        $result['message'] = $this->return_html(KkDvVtXkCtDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function del_giadv(Request $request)
    {
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
        $inputs = $request->all();
        $model=KkDvVtXkCt::findOrFail($inputs['id']);
        $masokk=$model->masokk;
        $model->delete();
        $result['message'] = $this->return_html(KkDvVtXkCt::where('masokk', $masokk)->get());
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function del_giahl_temp(Request $request)
    {
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
        $inputs = $request->all();
        $model=KkGiaHLDf::findOrFail($inputs['id']);
        $model->delete();
        $result['message'] = $this->return_html_hl(KkGiaHLDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';
        die(json_encode($result));
    }

    public function del_giahl(Request $request)
    {
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
        $inputs = $request->all();
        $model=KkGiaHL::findOrFail($inputs['id']);
        $masokk=$model->masokk;
        $model->delete();
        $result['message'] = $this->return_html_hl(KkGiaHL::where('masokk', $masokk)->get());
        $result['status'] = 'success';
        die(json_encode($result));
    }

    function kkgia(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        if (!isset($inputs['id'])) {
            die(json_encode($result));
        }

        $model =  KkDvVtXkCt::findOrFail($inputs['id']);
        $model->giakk = getDbl($inputs['giakk']);
        $model->giakklk = getDbl($inputs['giakklk']);
        $model->save();

        $result['message'] =$this->return_html(KkDvVtXkCt::where('masokk', $model->masokk)->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    function kkgia_temp(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        if (!isset($inputs['id'])) {
            die(json_encode($result));
        }

        $model =  KkDvVtXkCtDf::findOrFail($inputs['id']);
        $model->giakk = getDbl($inputs['giakk']);
        $model->giakklk = getDbl($inputs['giakklk']);
        $model->save();

        $result['message'] = $this->return_html(KkDvVtXkCtDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    function update_giahl(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        if (!isset($inputs['id'])) {
            die(json_encode($result));
        }

        $model =  KkGiaHL::findOrFail($inputs['id']);
        $model->giahl = getDbl($inputs['giahl']);
        $model->giahllk = getDbl($inputs['giahllk']);
        $model->save();

        $result['message'] =$this->return_html_hl(KkGiaHL::where('masokk', $model->masokk)->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    function update_giahl_temp(Request $request)
    {
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        $inputs = $request->all();
        if (!isset($inputs['id'])) {
            die(json_encode($result));
        }

        $model =  KkGiaHLDf::findOrFail($inputs['id']);
        $model->giahl = getDbl($inputs['giahl']);
        $model->giahllk = getDbl($inputs['giahllk']);
        $model->save();

        $result['message'] = $this->return_html_hl(KkGiaHLDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }

    function return_html($giadv){
        //Trả lại kết quả
        $message =  '<div class="row" id="noidung">';
        $message .= '<div class="col-md-12">';
        $message .='<table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">';
        $message .= '<thead>';
        $message .= '<tr>';
        $message .= '<th style="text-align: center" width="2%">STT</th>';
        $message .= '<th style="text-align: center">Loại xe</th>';
        $message .= '<th style="text-align: center">Mô tả dịch vụ</th>';
        $message .= '<th style="text-align: center">Giá liền kề</th>';
        $message .= '<th style="text-align: center">Giá kê khai</th>';
        $message .= '<th style="text-align: center">Ghi chú</th>';
        $message .= '<th style="text-align: center" width="25%">Thao tác</th>';
        $message .= '</tr>';
        $message .= '</thead>';
        $message .= '<tbody >';
        $i=1;
        foreach($giadv as $dv) {
            $message .= '<tr>';
            $message .= '<td style="text-align: center;">'.$i++.'</td>';
            $message .= '<td>'.$dv->loaixe.'</td>';
            $message .= '<td class="active">'.$dv->tendichvu.'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakklk).'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakk).'</td>';
            $message .= '<td>'.nl2br(e($dv->ghichu)).'</td>';
            $message .= '<td>'
                .'<button type="button" data-target="#modal-create" '
                .'data-toggle="modal" class="btn btn-default btn-xs mbs"'
                .'onclick="get_kkgia('.$dv->id.')"><i'
                .' class="fa fa-edit"></i>&nbsp;Kê khai giá'
                .'</button>';
            $message .='<button type="button" data-target="#modal-pagia-create"
                            data-toggle="modal" class="btn btn-default btn-xs mbs"
                            onclick="editpagia(&apos;'.$dv->madichvu.'&apos;)"><i class="fa fa-edit"></i>&nbsp;Phương án giá';
            $message .='<button type="button" data-target="#modal-dichvu"
                                        data-toggle="modal" class="btn btn-default btn-xs mbs"
                                        onclick="get_dichvu('.$dv->id.')"><i class="fa fa-edit"></i>&nbsp;Sửa thông tin
                        </button>';
            $message .= '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$dv->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
                    </button>';

            $message .='</button>';
            $message .= '</td >';
            $message .= '</tr >';
        }
        $message .= '</tbody>';
        return $message;
    }

    function return_html_hl($giahl){
        $message =  '<div class="row" id="kkgiahl">';
        $message .= '<div class="col-md-12">';
        $message .='<table id="sample_4" class="table table-hover table-striped table-bordered table-advanced tablesorter">';
        $message .= '<thead>';
        $message .= '<tr>';
        $message .= '<th style="text-align: center" width="2%">STT</th>';
        $message .= '<th style="text-align: center">Mô tả dịch vụ</th>';
        $message .= '<th style="text-align: center">Giá liền kề</th>';
        $message .= '<th style="text-align: center">Giá kê khai</th>';
        $message .= '<th style="text-align: center" width="25%">Thao tác</th>';
        $message .= '</tr>';
        $message .= '</thead>';
        $message .= '<tbody >';
        $i=1;
        foreach($giahl as $dv) {
            $message .= '<tr>';
            $message .= '<td style="text-align: center;">'.$i++.'</td>';
            $message .= '<td class="active">'.$dv->tendichvu.'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giahllk).'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giahl).'</td>';
            $message .= '<td>'
                .'<button type="button" data-target="#modal-create-hl" '
                .'data-toggle="modal" class="btn btn-default btn-xs mbs"'
                .'onclick="get_giahl('.$dv->id.')"><i'
                .' class="fa fa-edit"></i>&nbsp;Kê khai giá'
                .'</button>';

            $message .= '<button type="button" data-target="#modal-delete-hl" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="get_giahl_id('.$dv->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
                    </button>';

            $message .='</button>';
            $message .= '</td >';
            $message .= '</tr >';
        }
        $message .= '</tbody>';
        return $message;
    }
}
