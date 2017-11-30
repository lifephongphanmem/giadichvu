<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DoiTuongApDungDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtDf;
use App\TtCsKdDvLt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGiaDvLt45sCtDfController extends Controller
{
    public function addttp(Request $request){
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
        //dd($inputs);

        if($inputs['maloaip']!=''){

            /*$inputs['mucgialk'] = str_replace(',','',$inputs['mucgialk']);
            $inputs['mucgialk'] = str_replace('.','',$inputs['mucgialk']);
            $inputs['mucgiakk'] = str_replace(',','',$inputs['mucgiakk']);
            $inputs['mucgiakk'] = str_replace('.','',$inputs['mucgiakk']);*/

            $modelttp = TtCsKdDvLt::where('maloaip',$inputs['maloaip'])
                ->first();
            $modelkkgia = new KkGDvLtCtDf();
            $modelkkgia->loaip = $modelttp->loaip;
            $modelkkgia->qccl = $modelttp->qccl;
            $modelkkgia->sohieu = $modelttp->sohieu;
            $modelkkgia->ghichu = $inputs['ghichu'];
            $modelkkgia->macskd = $inputs['macskd'];
            $modelkkgia->maloaip = $inputs['maloaip'];
            $modelkkgia->tendoituong = $inputs['tendoituong'];
            $modelkkgia->apdung = $inputs['apdung'];
            $modelkkgia->ghichu = $inputs['ghichu'];
            //$modelkkgia->mucgialk = $inputs['mucgialk']!= '' ? $inputs['mucgialk'] : '0';
            //$modelkkgia->mucgiakk = $inputs['mucgiakk']!= '' ? $inputs['mucgiakk'] : '0';
            $modelkkgia->save();

            $model = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng- <br>Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đối tượng</th>';
            $result['message'] .= '<th style="text-align: center">Áp dụng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Mức giá<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center" with="5%">Mức giá<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr>';
                    $result['message'] .= '<td style="text-align: center">'.($key+1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->loaip.' - '.$tt->qccl.'</td>';
                    $result['message'] .= '<td>'.$tt->tendoituong.'</td>';
                    $result['message'] .= '<td>'.$tt->apdung.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->mucgiakk).'</td>';
                    $result['message'] .= '<td>'.$tt->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
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

    public function kkgia(Request $request){
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

            $model = KkGDvLtCtDf::where('id',$inputs['id'])
                ->first();
            ($model->mucgialk != null)? $mucgialk = $model->mucgialk : $mucgialk = 0;
            ($model->mucgiakk != null)? $mucgiakk = $model->mucgiakk : $mucgiakk = 0;

            $result['message'] = '<div class="modal-body" id="ttkkgia">';
            //if($inputs['ttcb'] == 'yes') {
                //$result['message'] .= '<div class="form-group" style="display: none">';
                //$result['message'] .= '<label><b>Mức giá kê khai liền kề</b></label>';
                //$result['message'] .= '<input type="text" style="text-align: right" id="mucgialk" name="mucgialk" class="form-control" data-mask="fdecimal" value="' . $mucgialk . '" autofocus>';
                //$result['message'] .= '</div>';
            //}else {
                $result['message'] .= '<div class="form-group">';
                $result['message'] .= '<label><b>Mức giá kê khai liền kề</b></label>';
                $result['message'] .= '<input type="text" style="text-align: right" id="mucgialk" name="mucgialk" class="form-control" data-mask="fdecimal" value="' . $mucgialk . '" autofocus>';
                $result['message'] .= '</div>';
            //}

            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Mức giá kê khai</b></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="mucgiakk" name="mucgiakk" class="form-control" data-mask="fdecimal" value="'.$mucgiakk.'">';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idkkgia" name="idkkgia" value="'.$model->id.'">';
            $result['status'] = 'success';


        }
        die(json_encode($result));

    }

    public function upkkgia(Request $request){
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
            $modelkkgia = KkGDvLtCtDf::findOrFail($id);
            $inputs['mucgialk'] = str_replace(',','',$inputs['mucgialk']);
            $inputs['mucgialk'] = str_replace('.','',$inputs['mucgialk']);
            $inputs['mucgiakk'] = str_replace(',','',$inputs['mucgiakk']);
            $inputs['mucgiakk'] = str_replace('.','',$inputs['mucgiakk']);

            $modelkkgia->mucgialk = $inputs['mucgialk'] != '' ? $inputs['mucgialk'] : '0';
            $modelkkgia->mucgiakk = $inputs['mucgiakk'] != '' ? $inputs['mucgiakk'] : '0';
            $modelkkgia->save();

            $model = KkGDvLtCtDf::where('macskd',$modelkkgia->macskd)
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng- Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đối tượng</th>';
            $result['message'] .= '<th style="text-align: center">Áp dụng</th>';
            $result['message'] .= '<th style="text-align: center;width: 5%">Mức giá<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center;width: 5%">Mức giá<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$ttphong){
                    $result['message'] .= '<tr id="'.$ttphong->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$ttphong->loaip.'-'.$ttphong->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->tendoituong.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->apdung.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($ttphong->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($ttphong->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.$ttphong->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$ttphong->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$ttphong->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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

    public function editttp(Request $request){
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
            $model = KkGDvLtCtDf::findOrFail($id);
            $modeldoituong = DoiTuongApDungDvLt::where('macskd',$model->macskd)
                ->get();
            $modelttp = TtCsKdDvLt::where('macskd',$model->macskd)
                ->get();
            //dd($modeldoituong);
            $result['message'] = '<div class="modal-body" id="ttpedit">';
            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Loại phòng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><select id="loaipedit" class="form-control" name="loaipedit" readonly>';
            foreach($modelttp as $ttp){
                if($ttp->maloaip == $model->maloaip)
                    $result['message'] .= '<option value="'.$ttp->maloaip.'" selected>'.$ttp->loaip.'</option>';
                else
                    $result['message'] .= '<option value="'.$ttp->maloaip.'" >'.$ttp->loaip.'</option>';
            }
            $result['message'] .= '</select></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            /*$result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="qccledit" class="form-control" name="qccledit" cols="30" rows="3">'.$model->qccl.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';*/
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Số hiệu phòng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="sohieuedit" class="form-control" name="sohieuedit" cols="30" rows="4">'.$model->sohieu.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Đối tượng áp dụng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><select id="tendoituongedit" class="form-control" name="tendoituongedit">';
            foreach($modeldoituong as $dt){
                if($dt->tendoituong == $model->tendoituong)
                    $result['message'] .= '<option value="'.$dt->tendoituong.'" selected>'.$dt->tendoituong.'</option>';
                else
                    $result['message'] .= '<option value="'.$dt->tendoituong.'" >'.$dt->tendoituong.'</option>';
            }
            $result['message'] .= '</select></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Áp dụng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><textarea id="apdungedit" class="form-control" name="apdungedit" cols="30" rows="2">'.$model->apdung.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            /*$result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Giá liền kề</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="mucgialkedit" id="mucgialkedit" class="form-control" data-mask="fdecimal" value="'.$model->mucgialk.'" style="text-align: right"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Giá kê khai</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="mucgiakkedit" id="mucgiakkedit" class="form-control" data-mask="fdecimal" value="'.$model->mucgiakk.'" style="text-align: right"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';*/

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

    public function updatettp(Request $request){
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
        //dd($inputs);

        if($inputs['id']!=''){

            /*$inputs['mucgialk'] = str_replace(',','',$inputs['mucgialk']);
            $inputs['mucgialk'] = str_replace('.','',$inputs['mucgialk']);
            $inputs['mucgiakk'] = str_replace(',','',$inputs['mucgiakk']);
            $inputs['mucgiakk'] = str_replace('.','',$inputs['mucgiakk']);*/

            $modelkkgia =  KkGDvLtCtDf::where('id',$inputs['id'])
                ->first();
            $modelttp = TtCsKdDvLt::where('maloaip',$inputs['loaip'])
                ->first();
            //$modelkkgia->maloaip = $inputs['loaip'];
            //$modelkkgia->loaip = $modelttp->loaip;
            //$modelkkgia->qccl = $inputs['qccl'];
            $modelkkgia->sohieu = $inputs['sohieu'];
            $modelkkgia->tendoituong = $inputs['tendoituong'];
            $modelkkgia->apdung = $inputs['apdung'];
            //$modelkkgia->mucgialk = $inputs['mucgialk']!= '' ? $inputs['mucgialk'] : '0';
            //$modelkkgia->mucgiakk = $inputs['mucgiakk']!= '' ? $inputs['mucgiakk'] : '0';
            $modelkkgia->ghichu = $inputs['ghichu'];
            $modelkkgia->save();

            $model = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng- <br>Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đối tượng</th>';
            $result['message'] .= '<th style="text-align: center">Áp dụng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Mức giá<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center" with="5%">Mức giá<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tt){
                    $result['message'] .= '<tr>';
                    $result['message'] .= '<td style="text-align: center">'.($key+1).'</td>';
                    $result['message'] .= '<td class="active">'.$tt->loaip.' - '.$tt->qccl.'</td>';
                    $result['message'] .= '<td>'.$tt->tendoituong.'</td>';
                    $result['message'] .= '<td>'.$tt->apdung.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tt->mucgiakk).'</td>';
                    $result['message'] .= '<td>'.$tt->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tt->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
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

    public function delete(Request $request)
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
        //dd($request);
        $inputs = $request->all();

        if (isset($inputs['id'])) {
            $id = $inputs['id'];
            $modelkkgia = KkGDvLtCtDf::findOrFail($id);
            $macskd = $modelkkgia->macskd;
            $modelkkgia->delete();

            $model = KkGDvLtCtDf::where('macskd', $macskd)
                ->get();
            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Loại phòng- <br>Quy cách chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đối tượng</th>';
            $result['message'] .= '<th style="text-align: center">Áp dụng</th>';
            $result['message'] .= '<th style="text-align: center" width="5%">Mức giá<br>liền kề</th>';
            $result['message'] .= '<th style="text-align: center" with="5%">Mức giá<br>kê khai</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center" width="10%">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';
            $result['message'] .= '<tbody>';
            if (count($model) > 0) {
                foreach ($model as $key => $tt) {
                    $result['message'] .= '<tr>';
                    $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                    $result['message'] .= '<td class="active">' . $tt->loaip . ' - ' . $tt->qccl . '</td>';
                    $result['message'] .= '<td>' . $tt->tendoituong . '</td>';
                    $result['message'] .= '<td>' . $tt->apdung . '</td>';
                    $result['message'] .= '<td style="text-align: right">' . number_format($tt->mucgialk) . '</td>';
                    $result['message'] .= '<td style="text-align: right">' . number_format($tt->mucgiakk) . '</td>';
                    $result['message'] .= '<td>' . $tt->ghichu . '</td>';
                    $result['message'] .= '<td>' .
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tt->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh(' . $tt->id . ')"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>' .
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid(' . $tt->id . ')" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'
                        . '</td>';
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
