<?php

namespace App\Http\Controllers;

use App\CbKkDvVtXb;
use App\DmDvVtXb;
use App\GeneralConfigs;
use App\KkDvVtXbCt;
use App\KkDvVtXbCtDf;
use App\PagDvVtXb;
use App\PagDvVtXb_Temp;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\KkDvVtXb;
use App\DonViDvVt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KkDvVtXbController extends Controller
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
                    $model = KkDvVtXb::where('cqcq',session('admin')->cqcq)
                        ->whereYear('ngaynhap', $nam)
                        ->orderBy('ngaynhap', 'asc')
                        ->get();
                    */
                }
                return view('manage.dvvt.template.dsdonvi_kekhai')
                    ->with('model',$model)
                    ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                    ->with('pageTitle','Kê khai giá dịch vụ vận tải');
            }else {
                $model = KkDvVtXb::where('masothue',$masothue)
                    ->whereYear('ngaynhap', $nam)
                    ->orderBy('ngaynhap', 'asc')
                    ->get();
            }

            $per=array(
                'create'=>can('kkdvvtxb','create'),
                'edit' =>can('kkdvvtxb','edit'),
                'delete' =>can('kkdvvtxb','delete'),
                'approve'=>can('kkdvvtxb','approve')
            );
            return view('manage.dvvt.dvxb.kkdv.index')
                ->with('model',$model)
                ->with('per',$per)
                ->with('nam',$nam)
                ->with('masothue',$masothue)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('pageTitle','Kê khai giá vận tải hành khách bằng xe buýt theo tuyến cố định');
        }else
            return view('errors.notlogin');
    }

    public function show($masothue)
    {
        if (Session::has('admin')) {
            $model = KkDvVtXb::where('masothue',$masothue)
                ->whereYear('ngaynhap', date('Y'))
                ->orderBy('ngaynhap', 'asc')
                ->get();
            $tendonvi=DonViDvVt::select('tendonvi')->where('masothue',$masothue)->first()->tendonvi;
            $per=array(
                'create'=>can('kkdvvtxb','create'),
                'edit' =>can('kkdvvtxb','edit'),
                'delete' =>can('kkdvvtxb','delete'),
                'approve'=>can('kkdvvtxb','approve')
            );
            return view('manage.dvvt.dvxb.kkdv.index_donvi')
                ->with('model',$model)
                ->with('per',$per)
                ->with('nam',date('Y'))
                ->with('masothue',$masothue)
                ->with('tendonvi',$tendonvi)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('pageTitle','Kê khai giá vận tải hành khách bằng xe buýt theo tuyến cố định');
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
                    $model = KkDvVtXb::where('trangthai', $trangthai)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                } else {
                    $model = KkDvVtXb::where('trangthai', $trangthai)
                        ->where('cqcq', session('admin')->cqcq)
                        ->whereMonth('ngaychuyen', $thang)
                        ->whereYear('ngaychuyen', $nam)
                        ->get();
                }
            }
            else{
                $trangthai = 'Công bố';
                $model = CbKkDvVtXb::whereMonth('ngaynhan',$thang)
                    ->whereYear('ngaynhan', $nam)
                    ->get();
            }

            $modeldv = DonViDvVt::all();
            foreach($model as $dv){
                $this->getTenDV($modeldv, $dv);
            }

            $per=array(
                'index'=>can('kkdvvtxb','index'),
                'create'=>can('kkdvvtxb','create'),
                'edit' =>can('kkdvvtxb','edit'),
                'delete' =>can('kkdvvtxb','delete'),
                'approve'=>can('kkdvvtxb','approve')
            );

            return view('manage.dvvt.dvxb.xetduyet.index')
                ->with('model',$model)
                ->with('thang',$thang)
                ->with('nam',$nam)
                ->with('pl',$pl)
                ->with('per',$per)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('pageTitle','Xét duyệt kê khai giá vận tải hành khách bằng xe buýt theo tuyến cố định');
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
            KkDvVtXbCtDf::where('masothue', $masothue)->delete();
            PagDvVtXb_Temp::where('masothue', $masothue)->delete();
            //$sql=" INSERT INTO thamdinhgia (masothue,diemdau,diemcuoi,madichvu,loaixe,tendichvu,qccl,dvt) SELECT masothue,diemdau,diemcuoi,madichvu,loaixe,tendichvu,qccl,dvt FROM dmdvvtxk where masothue='". session('admin')->mahuyen."'";
            //DB::statement($sql);

            $modelCB=CbKkDvVtXb::select('socv','ngaynhap','masokk')->where('masothue', $masothue)->first();
            $solk=null;
            $ngaylk=null;
            $masokk=null;

            if (isset($modelCB)) {
                $solk = $modelCB->socv;
                $ngaylk = $modelCB->ngaynhap;
                $masokk = $modelCB->masokk;
            }
            $mdDV=DmDvVtXb::where('masothue',$masothue)->get();
            foreach($mdDV as $dv){
                $mdkk = new KkDvVtXbCtDf();
                $mdkk->masothue = $masothue;
                $mdkk->diemdau = $dv->diemdau;
                $mdkk->diemcuoi = $dv->diemcuoi;
                $mdkk->madichvu = $dv->madichvu;
                $mdkk->tendichvu = $dv->tendichvu;
                $mdkk->qccl = $dv->qccl;
                $mdkk->dvtluot = $dv->dvtluot;
                $mdkk->dvtthang = $dv->dvtthang;
                $mdCT = KkDvVtXbCt::select('giakkluot','giakkthang')->where('masokk', $masokk)->where('madichvu', $dv->madichvu)->first();
                $mdkk->giakklkluot = count($mdCT)>0 ? $mdCT->giakkluot : 0;
                $mdkk->giakklkthang = count($mdCT)>0 ? $mdCT->giakkthang : 0;
                $mdkk->giakkluot = count($mdCT)>0 ? $mdCT->giakkluot : 0;
                $mdkk->giakkthang = count($mdCT)>0 ? $mdCT->giakkthang : 0;
                $mdkk->masokk = '';
                $mdkk->save();

                //Phương án giá
                $m_pag=new PagDvVtXb_Temp();
                $m_pag->masothue = $masothue;
                $m_pag->madichvu = $dv->madichvu;
                $m_pag->save();
            }

            $model=KkDvVtXbCtDf::where('masothue', session('admin')->mahuyen)->get();
            return view('manage.dvvt.dvxb.kkdv.create')
                ->with('pageTitle','Kê khai mới giá vận tải hành khách bằng xe buýt theo tuyến cố định')
                ->with('socvlk',$solk)
                ->with('ngaycvlk',$ngaylk)
                ->with('masothue',$masothue)
                ->with('cqcq',session('admin')->cqcq)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('model',$model);
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
            $makk=$insert['masothue'] . '_' . getdate()[0];
            
            $model = new KkDvVtXb();
            $model->masokk = $makk;
            $model->masothue = $insert['masothue'];
            $model->cqcq = $insert['cqcq'];
            $model->ngaynhap = getDateToDb($insert['ngaynhap']);
            $model->socv = $insert['socv'];
            $model->socvlk = $insert['socvlk'];
            $model->ngaynhaplk = getDateToDb($insert['ngaynhaplk']);
            $model->ngayhieuluc = getDateToDb($insert['ngayhieuluc']);
            $model->trangthai = 'Chờ chuyển';            
            $model->uudai = $insert['uudai'];
            $model->ghichu = $insert['ghichu'];
            $model->save();
            //Chi tiết kê khai
            $m_kkdf=KkDvVtXbCtDf::select('diemdau','diemcuoi','madichvu','tendichvu','qccl','dvtluot','dvtthang','giakkluot','giakklkluot','giakkthang','giakklkthang',DB::raw("'".$makk."' as masokk"))
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            KkDvVtXbCt::insert($m_kkdf);
            //Phương án giá
            $m_pag=PagDvVtXb_Temp::select('masothue','masokk','madichvu','giaitrinh','sanluong','cpnguyenlieutt','cpcongnhantt','cpkhauhaott','cpsanxuatdt','cpsanxuatc','cptaichinh','cpbanhang','cpquanly',DB::raw("'".$makk."' as masokk"))
                ->where('masothue', $insert['masothue'])
                ->get()->toarray();
            PagDvVtXb::insert($m_pag);
            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/don_vi/ma_so='.$insert['masothue']);
            }else{
                return redirect('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/nam='.date('Y'));
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
            $model = KkDvVtXb::findOrFail($id);
            $modeldv=KkDvVtXbCt::where('masokk',$model->masokk)->get();
            return view('manage.dvvt.dvxb.kkdv.edit')
                ->with('model',$model)
                ->with('modeldv',$modeldv)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('pageTitle','Chỉnh sửa kê khai giá vận tải hành khách bằng xe buýt theo tuyến cố định');
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
            $model = KkDvVtXb::findOrFail($id);
            $model->ngaynhap = getDateToDb($update['ngaynhap']);
            $model->socv = $update['socv'];
            $model->ngaynhaplk = getDateToDb($update['ngaynhaplk']);
            $model->socvlk = $update['socvlk'];
            $model->ngayhieuluc = getDateToDb($update['ngayhieuluc']);
            $model->ghichu = $update['ghichu'];
            $model->uudai = $update['uudai'];
            $model->save();
            if (session('admin')->level == 'T' ||session('admin')->level == 'H'|| session('admin')->sadmin == 'ssa') {
                return redirect('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/don_vi/ma_so='.$update['masothue']);
            }else{
                return redirect('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/nam='.date('Y'));
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
            $model = KkDvVtXb::where('id',$input['iddel'])
                ->first();
            //dd($model);
            if($model->delete()) {
                KkDvVtXbCt::where('masokk', $model->masokk)->delete();
                PagDvVtXb::where('masokk', $model->masokk)->delete();
            }
            return redirect('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/'.'nam='.date('Y'));
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
            $model = KkDvVtXb::findOrFail($inputs['id']);
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
            $model = KkDvVtXb::findOrFail($id);
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
            CbKkDvVtXb::where('masothue',$model->masothue)->delete();

            $m_cb = new CbKkDvVtXb();
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

            //$modelkk = KkDvVtXb::findOrFail($id);
            //$modeldel = CbKkDvVtXb::where('masothue',$modelkk->masothue)->delete();

            //DB::statement("INSERT INTO cbkkdvvtxb SELECT * FROM kkdvvtxb WHERE id='".$id."'");
            //DB::statement("Update cbkkdvvtxb set trangthai='Đang công bố' WHERE id='".$id."'");
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
            $model = KkDvVtXb::findOrFail($id);
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
            $model = KkDvVtXb::findOrFail($inputs['id']);
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

    public function updategiadvct(Request $request){
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
            $inputs['giakkluot'] = getDbl($inputs['giakkluot']);
            $inputs['giakkthang'] = getDbl($inputs['giakkthang']);
            $inputs['giakklkthang'] =  getDbl($inputs['giakklkthang']);
            $inputs['giakklkluot'] =  getDbl($inputs['giakklkluot']);

            $model = KkDvVtXbCt::findOrFail($inputs['id']);
            $model->giakkluot = $inputs['giakkluot'];
            $model->giakkthang = $inputs['giakkthang'];
            $model->giakklkthang = $inputs['giakklkthang'];
            $model->giakklkluot = $inputs['giakklkluot'];
            $model->save();
            //Trả lại kết quả
            $result['message'] = '<div class="row" id="noidung">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th style="text-align: center;width: 2%">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mô tả dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách</br>chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá</br>vé lượt</br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá</br>vé lượt</br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá</br>vé tháng</br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá</br>vé tháng</br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center;width: 20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody>';
            $DMDV = KkDvVtXbCt::where('masokk', $model->masokk)->get();
            $i=1;
            foreach($DMDV as $dv) {
                $result['message'] .= '<tr>';
                $result['message'] .= '<td style="text-align: center;">'.$i++.'</td>';
                $result['message'] .= '<td name="tendichvu" class="active">'.$dv->tendichvu.'</td>';
                $result['message'] .= '<td name="qccl">'.$dv->qccl.'</td>';
                $result['message'] .= '<td name="giakklkluot" style="text-align: right">'.number_format($dv->giakklkluot).'</td>';
                $result['message'] .= '<td name="giakkluot" style="text-align: right">'.number_format($dv->giakkluot).'</td>';
                $result['message'] .= '<td name="giakklkthang" style="text-align: right">'.number_format($dv->giakklkthang).'</td>';
                $result['message'] .= '<td name="giakkthang" style="text-align: right">'.number_format($dv->giakkthang).'</td>';
                $result['message'] .= '<td>'
                    .'<button type="button" data-target="#modal-create" '
                    .'data-toggle="modal" class="btn btn-default btn-xs mbs"'
                    .'onclick="editItem(this,'.$dv->id.')"><i'
                    .' class="fa fa-edit"></i>&nbsp;Kê khai giá'
                    .'</button>';
                $result['message'] .='<button type="button" data-target="#modal-pagia-create"
                                        data-toggle="modal" class="btn btn-default btn-xs mbs"
                                        onclick="editpagia(&apos;'.$dv->madichvu.'&apos;,&apos;'.$dv->masokk.'&apos;)"><i class="fa fa-edit"></i>&nbsp;Phương án giá';
                $result['message'] .='</button>';
                $result['message'] .= '</td >';
                $result['message'] .= '</tr >';
            }
            $result['message'] .= '</tbody>';
            $result['status'] = 'success';
        }

        die(json_encode($result));
    }

    public function search($masothue,$nam){
        if (Session::has('admin')) {
            $m_dv=DonViDvVt::select('masothue','tendonvi')->get();
            $dmdv=array_column($m_dv->toArray(),'tendonvi','masothue');

            $model = KkDvVtXb::where('trangthai','Duyệt')
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
            return view('manage.dvvt.dvxb.search.index')
                ->with('model',$model)
                ->with('nam',$nam)
                ->with('m_dv',$m_dv)
                ->with('masothue',$masothue)
                ->with('url','/dich_vu_van_tai/dich_vu_xe_bus/')
                ->with('pageTitle','Tra cứu giá dịch vụ vận tải');
        }else
            return view('errors.notlogin');
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

        $model = PagDvVtXb_Temp::where('masothue',session('admin')->mahuyen)->where('madichvu',$inputs['madichvu'])->first();

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

        $model = PagDvVtXb_Temp::findOrFail($inputs['id']);
        $model->sanluong=getDbl($inputs['sanluong']);
        $model->cpnguyenlieutt=getDbl($inputs['cpnguyenlieutt']);
        $model->cpcongnhantt=getDbl($inputs['cpcongnhantt']);
        $model->cpkhauhaott=getDbl($inputs['cpkhauhaott']);
        $model->cpsanxuatdt=getDbl($inputs['cpsanxuatdt']);
        $model->cpsanxuatc=getDbl($inputs['cpsanxuatc']);
        $model->cptaichinh=getDbl($inputs['cptaichinh']);
        $model->cpbanhang=getDbl($inputs['cpbanhang']);
        $model->cpquanly=getDbl($inputs['cpquanly']);
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

        $model = PagDvVtXb::where('masokk',$inputs['masokk'])->where('madichvu',$inputs['madichvu'])->first();

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
        $result['message'] .= ' <input style="text-align: right" type="text" id="cpquanly" name="cpquanly" value="'.$model->cpquanly.'" class="form-control" data-mask="fdecimal">';
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

        $model = PagDvVtXb::findOrFail($inputs['id']);
        $model->sanluong=getDbl($inputs['sanluong']);
        $model->cpnguyenlieutt=getDbl($inputs['cpnguyenlieutt']);
        $model->cpcongnhantt=getDbl($inputs['cpcongnhantt']);
        $model->cpkhauhaott=getDbl($inputs['cpkhauhaott']);
        $model->cpsanxuatdt=getDbl($inputs['cpsanxuatdt']);
        $model->cpsanxuatc=getDbl($inputs['cpsanxuatc']);
        $model->cptaichinh=getDbl($inputs['cptaichinh']);
        $model->cpbanhang=getDbl($inputs['cpbanhang']);
        $model->cpquanly=getDbl($inputs['cpquanly']);
        $model->giaitrinh=$inputs['giaitrinh'];
        $model->save();

        $result['message']= 'Cập nhật thành công.';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    public function printKK($masokk)
    {
        if (Session::has('admin')) {
            $modelkk = KkDvVtXb::where('masokk', $masokk)
                ->first();
            $modeldonvi = DonViDvVt::where('masothue', $modelkk->masothue)
                ->first();
            $modeldm = DmDvVtXb::where('masothue', $modelkk->masothue)->get();

            $modelgia = KkDvVtXbCt::where('masokk', $masokk)->get();


            return view('reports.kkgdvvt.kkgdvxb.printf')
                ->with('modeldonvi', $modeldonvi)
                ->with('modelkk', $modelkk)
                ->with('modelgia', $modelgia)
                ->with('modeldm', $modeldm)
                ->with('pageTitle', 'Kê khai giá dịch vụ vận tải');
        } else
            return view('errors.notlogin');
    }

    public function printPAG($masokk)
    {
        if (Session::has('admin')) {
            $modelkk = KkDvVtXb::where('masokk', $masokk)
                ->first();
            $modeldonvi = DonViDvVt::where('masothue', $modelkk->masothue)
                ->first();
            $modeldm = DmDvVtXb::where('masothue', $modelkk->masothue)->get();
            $modelgia = KkDvVtXbCt::where('masokk', $masokk)->get();
            $modelpag = PagDvVtXb::where('masokk', $masokk)->get();

            return view('reports.kkgdvvt.kkgdvxb.printfPAG')
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
        $model = KkDvVtXbCt::find($inputs['id']);
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
        $model = KkDvVtXbCtDf::find($inputs['id']);
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
            $model = KkDvVtXbCtDf::findOrFail($inputs['id']);
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvtluot = $inputs['dvtluot'];
            $model->dvtthang = $inputs['dvtthang'];
            $model->save();
        }else{//Thêm mới dịch vụ
            $madichvu=getdate()[0];
            $model = new KkDvVtXbCtDf();
            $model->masothue = $inputs['masothue'];
            $model->madichvu = $madichvu;
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvtluot = $inputs['dvtluot'];
            $model->dvtthang = $inputs['dvtthang'];
            if($model->save()){
                $m_pag=new PagDvVtXb_Temp();
                $m_pag->masothue = $inputs['masothue'];
                $m_pag->madichvu = $madichvu;
                $m_pag->save();
            }
        }
        //Trả lại kết quả
        $result['message'] =$this->return_html(KkDvVtXbCtDf::where('masothue', $inputs['masothue'])->get());
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
            $model = KkDvVtXbCt::findOrFail($inputs['id']);
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvtluot = $inputs['dvtluot'];
            $model->dvtthang = $inputs['dvtthang'];
            $model->save();
        }else{//Thêm mới dịch vụ
            $madichvu=getdate()[0];
            $model = new KkDvVtXbCt();
            $model->madichvu = $madichvu;
            $model->masokk = $inputs['masokk'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->qccl = $inputs['qccl'];
            $model->dvtluot = $inputs['dvtluot'];
            $model->dvtthang = $inputs['dvtthang'];
            if($model->save()){
                $m_pag=new PagDvVtXb();
                $m_pag->masothue = $inputs['masothue'];
                $m_pag->madichvu = $madichvu;
                $m_pag->masokk = $inputs['masokk'];
                $m_pag->save();
            }
        }

        //Trả lại kết quả
        $result['message'] =$this->return_html(KkDvVtXbCt::where('masokk', $inputs['masokk'])->get());
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
        $model=KkDvVtXbCtDf::findOrFail($inputs['id']);
        $model->delete();
        $result['message'] = $this->return_html(KkDvVtXbCtDf::where('masothue', $inputs['masothue'])->get());
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
        $model=KkDvVtXbCt::findOrFail($inputs['id']);
        $masokk=$model->masokk;
        $model->delete();
        $result['message'] = $this->return_html(KkDvVtXbCt::where('masokk', $masokk)->get());
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

        $model =  KkDvVtXbCt::findOrFail($inputs['id']);
        $model->giakkluot = getDbl($inputs['giakkluot']);
        $model->giakkthang = getDbl($inputs['giakkthang']);
        $model->giakklkthang = getDbl($inputs['giakklkthang']);
        $model->giakklkluot =getDbl($inputs['giakklkluot']);
        $model->save();

        $result['message'] =$this->return_html(KkDvVtXbCt::where('masokk', $model->masokk)->get());
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

        $model =  KkDvVtXbCtDf::findOrFail($inputs['id']);
        $model->giakkluot = getDbl($inputs['giakkluot']);
        $model->giakkthang = getDbl($inputs['giakkthang']);
        $model->giakklkthang = getDbl($inputs['giakklkthang']);
        $model->giakklkluot =getDbl($inputs['giakklkluot']);
        $model->save();

        $result['message'] = $this->return_html(KkDvVtXbCtDf::where('masothue', $inputs['masothue'])->get());
        $result['status'] = 'success';

        die(json_encode($result));
    }


    function return_html($giadv){
        //Trả lại kết quả
        $message = '<div class="row" id="noidung">';
        $message .= '<div class="col-md-12">';
        $message .= '<table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">';
        $message .= '<thead>';
        $message .= '<tr>';
        $message .= '<th style="text-align: center;width: 2%">STT</th>';
        $message .= '<th style="text-align: center">Mô tả dịch vụ</th>';
        $message .= '<th style="text-align: center">Quy cách</br>chất lượng</th>';
        $message .= '<th style="text-align: center">Mức giá</br>vé lượt</br>liền kề</th>';
        $message .= '<th style="text-align: center">Mức giá</br>vé lượt</br>kê khai</th>';
        $message .= '<th style="text-align: center">Mức giá</br>vé tháng</br>liền kề</th>';
        $message .= '<th style="text-align: center">Mức giá</br>vé tháng</br>kê khai</th>';
        $message .= '<th style="text-align: center;width: 20%">Thao tác</th>';
        $message .= '</tr>';
        $message .= '</thead>';
        $message .= '<tbody>';
        $i=1;
        foreach($giadv as $dv) {
            $message .= '<tr>';
            $message .= '<td style="text-align: center;">'.$i++.'</td>';
            $message .= '<td class="active">'.$dv->tendichvu.'</td>';
            $message .= '<td>'.$dv->qccl.'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakklkluot).'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakkluot).'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakklkthang).'</td>';
            $message .= '<td style="text-align: right">'.number_format($dv->giakkthang).'</td>';
            $message .= '<td>'
                .'<button type="button" data-target="#modal-create" '
                .'data-toggle="modal" class="btn btn-default btn-xs mbs"'
                .'onclick="get_kkgia('.$dv->id.')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>';

            $message .='<button type="button" data-target="#modal-pagia-create"
                            data-toggle="modal" class="btn btn-default btn-xs mbs"
                            onclick="editpagia(&apos;'.$dv->madichvu.'&apos;)"><i class="fa fa-edit"></i>&nbsp;Phương án giá';
            $message .='</button>';

            $message .='<button type="button" data-target="#modal-dichvu"
                                        data-toggle="modal" class="btn btn-default btn-xs mbs"
                                        onclick="get_dichvu('.$dv->id.')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin
                        </button>';

            $message .= '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$dv->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
                </button>';

            $message .= '</td >';
            $message .= '</tr >';
        }
        $message .= '</tbody>';
        
        return $message;
    }
}
