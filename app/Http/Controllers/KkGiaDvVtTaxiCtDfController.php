<?php

namespace App\Http\Controllers;

use App\KkDvVtXtxCt;
use App\KkDvVtXtxCtDf;
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

            $model = KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th style="text-align: center" width="2%">STT</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendichvu.'</td>';
                    $result['message'] .= '<td>'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklk).'/'.$tt->trenkmlk.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklktl).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'/'.$tt->trenkm.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakktl).'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
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

            $model = KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th style="text-align: center" width="2%">STT</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendichvu.'</td>';
                    $result['message'] .= '<td>'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklk).'/'.$tt->trenkmlk.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklktl).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'/'.$tt->trenkm.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakktl).'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
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

            $model = KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th style="text-align: center" width="2%">STT</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendichvu.'</td>';
                    $result['message'] .= '<td>'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklk).'/'.$tt->trenkmlk.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklktl).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'/'.$tt->trenkm.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakktl).'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
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

            $model = KkDvVtXtxCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th style="text-align: center" width="2%">STT</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>';
            $result['message'] .= '<th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr id="'.$tt->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->tendichvu.'</td>';
                    $result['message'] .= '<td>'.$tt->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tt->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklk).'/'.$tt->trenkmlk.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakklktl).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakk).'/'.$tt->trenkm.'km</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakkden).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->giakktl).'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

                        .'</td>';
                    $result['message'] .= '</tr>';
                }
                $result['message'] .= '</tbody>';
                $result['message'] .= '</table>';
                $result['message'] .= '</div>';
                $result['message'] .= '</div>';
                $result['status'] = 'success';
            }
        }
        die(json_encode($result));
    }

}


