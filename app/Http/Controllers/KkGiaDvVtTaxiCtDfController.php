<?php

namespace App\Http\Controllers;

use App\DmDvVtXtx;
use App\KkDvVtXtxCt;
use App\KkDvVtXtxCtDf;
use App\PagDvVtXtx_Temp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaDvVtTaxiCtDfController extends Controller
{
    //Ajax Form create
    public function storedv(Request $request){
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

        if($inputs['tendichvu']!=''){
            $modelkkgia = new KkDvVtXtxCtDf();
            $modelkkgia->tendichvu = $inputs['tendichvu'];
            $modelkkgia->qccl = $inputs['qccl'];
            $modelkkgia->dvt = $inputs['dvt'];
            $modelkkgia->ghichu = $inputs['ghichu'];
            $modelkkgia->masothue= $inputs['masothue'];
            $modelkkgia->madichvu = getdate()[0];
            $modelkkgia->giakklk = 0;
            $modelkkgia->giakklkden = 0;
            $modelkkgia->giakklktl = 0;
            $modelkkgia->giakk = 0;
            $modelkkgia->giakkden =0;
            $modelkkgia->giakktl =0;
            $modelkkgia->trenkmlk = 1;
            $modelkkgia->trenkm = 1;
            $modelkkgia->save();

            $result['message'] =$this->return_html(KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])->get());
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }
    //End Ajax Form create(create dv)

    //Ajax Form create (edit dv)
    public function editdv(Request $request){
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

            $model = KkDvVtXtxCtDf::findOrFail($id);
            //dd($model);
            $result['message'] = '<div class="modal-body" id="ttpedit">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Tên cung ứng dịch vụ</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="tendichvuedit" id="tendichvuedit" class="form-control" value="'.$model->tendichvu.'" ></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" id="qccledit" class="form-control" name="qccledit" value="'.$model->qccl.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Đơn vị tính</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" id="dvtedit" class="form-control" name="dvtedit" value="'.$model->dvt.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Ghi chú</b><span class="require">*</span></label>';
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

    public function updatedv(Request $request){
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

        if($inputs['tendichvu']!='' && $inputs['id'] != ''){
            $modelkkgia = KkDvVtXtxCtDf::where('id',$inputs['id'])->first();
            $modelkkgia->tendichvu = $inputs['tendichvu'];
            $modelkkgia->qccl = $inputs['qccl'];
            $modelkkgia->dvt = $inputs['dvt'];
            $modelkkgia->ghichu = $inputs['ghichu'];
            $modelkkgia->save();

            $result['message'] =$this->return_html(KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])->get());
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function kkgiadv(Request $request){
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

            $model = KkDvVtXtxCtDf::where('id',$inputs['id'])
                ->first();
            ($model->giakklk != null)? $giakklk = $model->giakklk : $giakklk = 0;
            ($model->giakklkden != null)? $giakklkden = $model->giakklkden : $giakklkden = 0;
            ($model->giakklktl != null)? $giakklktl = $model->giakklktl : $giakklktl = 0;
            ($model->giakk != null)? $giakk = $model->giakk : $giakk = 0;
            ($model->giakkden != null)? $giakkden = $model->giakkden : $giakkden = 0;
            ($model->giakktl != null)? $giakktl = $model->giakktl : $giakktl = 0;

            $result['message'] = '<div class="modal-body" id="ttkkgia">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá mở cửa liền kề</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakklk" name="giakklk" class="form-control" data-mask="fdecimal" value="'.$giakklk.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Trên số km </b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="trenkmlk" name="trenkmlk" class="form-control" data-mask="fdecimal" value="'.$model->trenkmlk.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá đến km30 liền kề</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakklkden" name="giakklkden" class="form-control" data-mask="fdecimal" value="'.$giakklkden.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá từ km31 trở lên liền kề</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakklktl" name="giakklktl" class="form-control" data-mask="fdecimal" value="'.$giakklktl.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá mở cửa kê khai</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakk" name="giakk" class="form-control" data-mask="fdecimal" value="'.$giakk.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Trên số km </b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="trenkm" name="trenkm" class="form-control" data-mask="fdecimal" value="'.$model->trenkm.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá đến km30 kê khai</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakkden" name="giakkden" class="form-control" data-mask="fdecimal" value="'.$giakkden.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label class="form-control-label"><b>Mức giá từ km31 trở lên kê khai</b><span class="require">*</span></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="giakktl" name="giakktl" class="form-control" data-mask="fdecimal" value="'.$giakktl.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idkkgia" name="idkkgia" value="'.$model->id.'">';
            $result['status'] = 'success';


        }
        die(json_encode($result));
    }

    public function upkkgiadv(Request $request){
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

        if($inputs['id'] != ''){

            $inputs['giakklk'] = str_replace(',','',$inputs['giakklk']);
            $inputs['giakklk'] = str_replace('.','',$inputs['giakklk']);

            $inputs['giakklkden'] = str_replace(',','',$inputs['giakklkden']);
            $inputs['giakklkden'] = str_replace('.','',$inputs['giakklkden']);

            $inputs['giakklktl'] = str_replace(',','',$inputs['giakklktl']);
            $inputs['giakklktl'] = str_replace('.','',$inputs['giakklktl']);

            $inputs['giakk'] = str_replace(',','',$inputs['giakk']);
            $inputs['giakk'] = str_replace('.','',$inputs['giakk']);

            $inputs['giakkden'] = str_replace('.','',$inputs['giakkden']);
            $inputs['giakkden'] = str_replace(',','',$inputs['giakkden']);

            $inputs['giakktl'] = str_replace('.','',$inputs['giakktl']);
            $inputs['giakktl'] = str_replace(',','',$inputs['giakktl']);

            $modelkkgia = KkDvVtXtxCtDf::where('id',$inputs['id'])->first();
            $modelkkgia->giakklk = $inputs['giakklk'];
            $modelkkgia->trenkmlk = $inputs['trenkmlk'];
            $modelkkgia->giakklkden = $inputs['giakklkden'];
            $modelkkgia->giakklktl = $inputs['giakklktl'];
            $modelkkgia->giakk = $inputs['giakk'];
            $modelkkgia->trenkm = $inputs['trenkm'];
            $modelkkgia->giakkden = $inputs['giakkden'];
            $modelkkgia->giakktl = $inputs['giakktl'];

            $modelkkgia->save();

            $result['message'] =$this->return_html(KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])->get());
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function delkkgiadv(Request $request){
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

        if($inputs['id'] != ''){
            $modelkkgia = KkDvVtXtxCtDf::where('id',$inputs['id'])->first();
            $modelkkgia->delete();

            $result['message'] =$this->return_html(KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])->get());
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }

    function get_pag(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model_dm = DmDvVtXtx::where('madichvu',$inputs['madichvu'])->first();
        $model = PagDvVtXtx_Temp::where('madichvu',$inputs['madichvu'])->first();
        $model->tuyenduong = $model_dm->loaixe . " - " . $model_dm->tendichvu;
        die($model);
    }

    function update_pag(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = PagDvVtXtx_Temp::where('madichvu',$inputs['madichvu'])->first();

        $inputs['nguyengia']=getDbl($inputs['nguyengia']);
        $inputs['tongkm']=getDbl($inputs['tongkm']);
        $inputs['kmcokhach']=getDbl($inputs['kmcokhach']);
        $inputs['khauhao']=getDbl($inputs['khauhao']);
        $inputs['baohiem']=getDbl($inputs['baohiem']);
        $inputs['baohiempt']=getDbl($inputs['baohiempt']);
        $inputs['baohiemtnds']=getDbl($inputs['baohiemtnds']);
        $inputs['lainganhang']=getDbl($inputs['lainganhang']);
        $inputs['thuevp']=getDbl($inputs['thuevp']);
        $inputs['suachualon']=getDbl($inputs['suachualon']);
        $inputs['samlop']=getDbl($inputs['samlop']);
        $inputs['dangkiem']=getDbl($inputs['dangkiem']);
        $inputs['quanly']=getDbl($inputs['quanly']);
        $inputs['banhang']=getDbl($inputs['banhang']);
        $inputs['luonglaixe']=getDbl($inputs['luonglaixe']);
        $inputs['nhienlieuchinh']=getDbl($inputs['nhienlieuchinh']);
        $inputs['nhienlieuboitron']=getDbl($inputs['nhienlieuboitron']);
        $inputs['chiphibdcs']=getDbl($inputs['chiphibdcs']);
        //$inputs['giakekhai']=getDbl($inputs['giakekhai']);
        //$inputs['doanhthu']=getDbl($inputs['doanhthu']);
        $inputs['phiduongbo']=getDbl($inputs['phiduongbo']);
        $inputs['loinhuan']=getDbl($inputs['loinhuan']);
        $inputs['suachuatx']=getDbl($inputs['suachuatx']);
        /*
        $a=array('nguyengia'=>getDbl($inputs['nguyengia']),
            'tongkm'=>getDbl($inputs['tongkm']),
            'kmcokhach'=>getDbl($inputs['kmcokhach']),
            'khauhao'=>getDbl($inputs['khauhao']),
            'baohiem'=>getDbl($inputs['baohiem']),
            'baohiempt'=>getDbl($inputs['baohiempt']),
            'baohiemtnds'=>getDbl($inputs['baohiemtnds']),
            'lainganhang'=>getDbl($inputs['lainganhang']),
            'thuevp'=>getDbl($inputs['thuevp']),
            'suachualon'=>getDbl($inputs['suachualon']),
            'samlop'=>getDbl($inputs['samlop']),
            'dangkiem'=>getDbl($inputs['dangkiem']),
            'quanly'=>getDbl($inputs['quanly']),
            'banhang'=>getDbl($inputs['banhang']),
            'luonglaixe'=>getDbl($inputs['luonglaixe']),
            'nhienlieuchinh'=>getDbl($inputs['nhienlieuchinh']),
            'nhienlieuboitron'=>getDbl($inputs['nhienlieuboitron']),
            'chiphibdcs'=>getDbl($inputs['chiphibdcs']),
            'giakekhai'=>getDbl($inputs['giakekhai']),
            'doanhthu'=>getDbl($inputs['doanhthu'])
        );
        $model->pag = json_encode($a);
        $model->ghichu_pag = $inputs['ghichu_pag'];
        $model->save();
        */
        $model->update($inputs);

        die($model);
    }

    function return_html($chitiet){
        $message = '<div class="row" id="dsts">';
        $message .= '<div class="col-md-12">';
        $message .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
        $message .= '<thead>';
        $message .= '<tr>';
        $message .= '<th style="text-align: center" width="2%">STT</th>';
        $message .= '<th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>';
        $message .= '<th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>';
        $message .= '<th style="text-align: center" width="5%">Đơn vị<br> tính</th>';
        $message .= '<th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>';
        $message .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>';
        $message .= '<th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>';
        $message .= '<th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>';
        $message .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>';
        $message .= '<th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>';
        $message .= '<th style="text-align: center">Thao tác</th>';
        $message .= '</tr>';
        $message .= '</thead>';

        $message .= '<tbody>';
        if(count($chitiet) > 0) {
            foreach ($chitiet as $key => $tt) {
                $message .= '<tr id="' . $tt->id . '">';
                $message .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                $message .= '<td class="active">' . $tt->tendichvu . '</td>';
                $message .= '<td>' . $tt->qccl . '</td>';
                $message .= '<td style="text-align: center">' . $tt->dvt . '</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakklk) . '/' . $tt->trenkmlk . 'km</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakklkden) . '</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakklktl) . '</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakk) . '/' . $tt->trenkm . 'km</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakkden) . '</td>';
                $message .= '<td style="text-align: right">' . number_format($tt->giakktl) . '</td>';
                $message .= '<td>' .
                    '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia(' . $tt->id . ')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>' .
                    '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh(' . $tt->id . ')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>' .
                    '<button type="button" data-target="#modal-pagia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="get_pag(&apos;'.$tt->madichvu.'&apos;)"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>'.
                    '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
                    . '</td>';
                $message .= '</tr>';
            }
        }
            $message .= '</tbody>';
            $message .= '</table>';
            $message .= '</div>';
            $message .= '</div>';
        return $message;
    }
}


