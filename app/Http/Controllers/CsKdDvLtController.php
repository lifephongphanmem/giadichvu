<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvLt;
use App\TtCsKdDvLt;
use App\TtPhong;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CsKdDvLtController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                    if (session('admin')->sadmin == 'ssa') {
                        $model = DnDvLt::all();
                    } else {
                        $model = DnDvLt::where('cqcq', session('admin')->cqcq)
                            ->get();
                    }
                    return view('manage.dvlt.ttcskd.ql.index')
                        ->with('model', $model)
                        ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp dịch vụ lưu trú');

                } else {
                    $model = CsKdDvLt::where('masothue', session('admin')->mahuyen)
                        ->get();


                    return view('manage.dvlt.ttcskd.index')
                        ->with('model', $model)
                        ->with('pageTitle', 'Thông tin cơ sở kinh doanh cung cấp dịch vụ lưu trú');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    //Thông tin doanh nghiệp quản lý
    public function showcskd($masothue){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $model = CsKdDvLt::where('masothue', $masothue)
                    ->get();
                $modeldn = DnDvLt::where('masothue',$masothue)->first();
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $modeldn->cqcq) {
                    return view('manage.dvlt.ttcskd.index')
                        ->with('masothue', $masothue)
                        ->with('model', $model)
                        ->with('pageTitle', 'Thông tin cơ sở kinh doanh cung cấp dịch vụ lưu trú');
                }else{
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'DVLT') {
                $model = TtPhong::where('masothue', session('admin')->mahuyen)
                    ->delete();
                $ttdn = DnDvLt::where('masothue', session('admin')->mahuyen)
                    ->first();
                return view('manage.dvlt.ttcskd.create')
                    ->with('ttdn', $ttdn)
                    ->with('pageTitle', 'Kê khai thông tin cơ sở kinh doanh cung cấp dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function createcskd($masothue){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $model = TtPhong::where('masothue', $masothue)
                    ->delete();
                $ttdn = DnDvLt::where('masothue', $masothue)
                    ->first();
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $ttdn->cqcq) {
                    return view('manage.dvlt.ttcskd.create')
                        ->with('ttdn', $ttdn)
                        ->with('masothue', $masothue)
                        ->with('pageTitle', 'Kê khai thông tin cơ sở kinh doanh cung cấp dịch vụ lưu trú');
                }else{
                    return view('errors.perm');
                }
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function ttphongstore(Request $request){
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

        if(isset($inputs['loaip'])){
            $modelttp = new TtPhong();
            $modelttp->loaip = $inputs['loaip'];
            $modelttp->qccl = $inputs['qccl'];
            $modelttp->sohieu  =$inputs['sohieu'];
            $modelttp->ghichu = $inputs['ghichu'];
            $modelttp->maloaip = getdate()[0];
            $modelttp->masothue = $inputs['masothue'];
            $modelttp->save();

            $model = TtPhong::where('masothue',$inputs['masothue'])
                ->get();



            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function ttphongedit(Request $request){
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

            $model = TtPhong::where('id',$inputs['id'])
                ->first();
            //dd($model);
            $result['message'] = '<div class="modal-body" id="tttsedit">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Loại phòng<span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="loaipedit" id="loaipedit" class="form-control" value="'.$model->loaip.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Quy cách chất lượng<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="qccledit" class="form-control" name="qccledit" cols="30" rows="3">'.$model->qccl.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Số hiệu phòng<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="sohieuedit" class="form-control" name="sohieuedit" cols="30" rows="3">'.$model->sohieu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Ghi chú<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="ghichuedit" class="form-control" name="ghichuedit" cols="30" rows="3">'.$model->ghichu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<input type="hidden" id="idedit" name="idedit" value="'.$model->id.'">';
            $result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }

    public function ttphongupdate(Request $request){
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
            $modelttp = TtPhong::findOrFail($id);
            $modelttp->loaip = $inputs['loaip'];
            $modelttp->qccl = $inputs['qccl'];
            $modelttp->sohieu  =$inputs['sohieu'];
            $modelttp->ghichu = $inputs['ghichu'];
            //$modelttp->masothue = session('admin')->mahuyen;
            $modelttp->save();

            $model = TtPhong::where('masothue',session('admin')->mahuyen)
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function ttphongdelete(Request $request){
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
            $modelttp = TtPhong::findOrFail($id);
            $modelttp->delete();

            $model = TtPhong::where('masothue',session('admin')->mahuyen)
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['macskd'] =  $inputs['masothue'].'_'.getdate()[0];
            if(isset($inputs['toado'])){
                $avatar = $request->file('toado');
                $inputs['toado'] = $inputs['macskd'] .'.'.$avatar->getClientOriginalExtension();
                $avatar->move(public_path() . '/images/cskddvlt/', $inputs['toado']);
            }else{
                $inputs['toado'] = 'no-image-available.jpg';
            }
            $model = new CsKdDvLt();
            if($model->create($inputs)) {
                $this->StorePh( $inputs['masothue'].'_'.getdate()[0],$inputs['masothue']);
            }
            if(session('admin')->level == 'T' || session('admin')->level == 'H')
                return redirect('ttcskd_dich_vu_luu_tru/masothue='.$inputs['masothue']);
            else
                return redirect('ttcskd_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }

    public function StorePh($ma,$masothue){
        $modelph = TtPhong::where('masothue',$masothue)
            ->get();
        foreach($modelph as $ph){
            $model = new TtCsKdDvLt();
            $model->maloaip = $ph->maloaip;
            $model->loaip = $ph->loaip;
            $model->qccl = $ph->qccl;
            $model->sohieu = $ph->sohieu;
            $model->ghichu = $ph->ghichu;
            $model->macskd = $ma;
            $model->save();
        }
    }

    public function edit($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $model = CsKdDvLt::findOrFail($id);
                if (session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq) {
                    $modelttp = TtCsKdDvLt::where('macskd', $model->macskd)
                        ->get();
                    return view('manage.dvlt.ttcskd.edit')
                        ->with('model', $model)
                        ->with('modelttp', $modelttp)
                        ->with('pageTitle', 'Chỉnh sửa thông tin cơ sở kinh doanh dịch vụ lưu trú');
                }else {
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function ttphongthemmoi(Request $request){
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

        if(isset($inputs['loaip'])){
            $modelttp = new TtCsKdDvLt();
            $modelttp->loaip = $inputs['loaip'];
            $modelttp->qccl = $inputs['qccl'];
            $modelttp->sohieu  =$inputs['sohieu'];
            $modelttp->ghichu = $inputs['ghichu'];
            $modelttp->macskd = $inputs['macskd'];
            $modelttp->maloaip = getdate()[0];
            $modelttp->save();

            $model = TtCsKdDvLt::where('macskd',$inputs['macskd'])
                ->get();



            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function ttphongchinhsua(Request $request){
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

            $model = TtCsKdDvLt::where('id',$inputs['id'])
                ->first();
            //dd($model);
            $result['message'] = '<div class="modal-body" id="tttsedit">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Loại phòng<span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="loaipedit" id="loaipedit" class="form-control" value="'.$model->loaip.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Quy cách chất lượng<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="qccledit" class="form-control" name="qccledit" cols="30" rows="3">'.$model->qccl.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Số hiệu phòng<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="sohieuedit" class="form-control" name="sohieuedit" cols="30" rows="3">'.$model->sohieu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label">Ghi chú<span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="ghichuedit" class="form-control" name="ghichuedit" cols="30" rows="3">'.$model->ghichu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<input type="hidden" id="idedit" name="idedit" value="'.$model->id.'">';
            $result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }

    public function ttphongcapnhat(Request $request){
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
            $modelttp = TtCsKdDvLt::findOrFail($id);
            $modelttp->loaip = $inputs['loaip'];
            $modelttp->qccl = $inputs['qccl'];
            $modelttp->sohieu  =$inputs['sohieu'];
            $modelttp->ghichu = $inputs['ghichu'];
            //$modelttp->masothue = session('admin')->mahuyen;
            $modelttp->save();

            $model = TtCsKdDvLt::where('macskd',$inputs['macskd'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function ttphongxoa(Request $request){
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
            $modelttp = TtCsKdDvLt::findOrFail($id);
            $macskd = $modelttp->macskd;
            $modelttp->delete();

            $model = TtCsKdDvLt::where('macskd',$macskd)
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="20%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'</td>';
                    $result['message'] .= '<td>'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->sohieu.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-wide-width" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editItem('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete-ts" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                //$result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = CsKdDvLt::findOrFail($id);

            if(isset($inputs['toado'])){
                $avatar = $request->file('toado');
                $inputs['toado'] = $inputs['macskd'] .'.'.$avatar->getClientOriginalExtension();
                $avatar->move(public_path() . '/images/cskddvlt/', $inputs['toado']);
            }
            $model->update($inputs);
            if(isset($inputs['toado'])){
                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $dn = DnDvLt::where('masothue',$model->masothue)->first();
                $cskd = $model->tencskd;
                $loaihang = $model->loaihang;
                $data=[];
                $data['tendn'] = $dn->tendn;
                $data['masothue'] = $dn->masothue;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $data['tencskd'] =$cskd;
                $data['loaihang'] = $loaihang;
                $data['url'] = url('/images/cskddvlt/'.$model->toado);

                $maildn = $dn->email;
                $tendn = $dn->tendn;
                $mailql = $tencqcq->email;
                $tenql = $tencqcq->tendv;
                Mail::send('mail.tdchungnhanhang',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                    $message->to($maildn,$tendn)
                        ->to($mailql,$tenql)
                        ->subject('Thông báo thay đổi giấy chứng nhận loại hạng');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
            }
            if (session('admin')->level == 'T' || session('admin')->level == 'H')
                return redirect('ttcskd_dich_vu_luu_tru/masothue=' . $inputs['masothue']);
            else
                return redirect('ttcskd_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['iddelete'];
            $model = CsKdDvLt::findOrFail($id);
            $masothue = $model->masothue;
            if($model->delete()){
                $modelttp = TtCsKdDvLt::where('macskd',$model->macskd)
                    ->delete();
            }
            if(session('admin')->level == 'T' || session('admin')->level == 'H')
                return redirect('ttcskd_dich_vu_luu_tru/masothue='.$masothue);
            else
                return redirect('ttcskd_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }

    public function checktencskd(Request $request){
        $input = $request->all();
        $input['tencskd'] = strtoupper(str_replace(' ','',chuyenkhongdau($input['tencskd'])));
        $model = CsKdDvLt::all();

        $value = '';
        foreach($model as $tt){
            $value .= strtoupper(str_replace(' ','',chuyenkhongdau(chuyenkhongdau($tt->tencskd)))).',';
        }
        $array = explode(',',$value);

        $check = in_array($input['tencskd'],$array);

        if($check == 'true')
            echo 'cancel';
        else
            echo 'ok';
    }

    public function stop(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idstop'];
            $model = CsKdDvLt::findOrFail($id);
            $model->ghichu = 'Dừng hoạt động';
            $model->save();
            if(session('admin')->level == 'T' || session('admin')->level == 'H')
                return redirect('ttcskd_dich_vu_luu_tru/masothue='.$model->masothue);
            else
                return redirect('ttcskd_dich_vu_luu_tru');
        }else
            return view('errors.notlogin');
    }


}
