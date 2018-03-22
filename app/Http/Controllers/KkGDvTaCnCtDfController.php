<?php

namespace App\Http\Controllers;

use App\KkGDvTaCn;
use App\KkGDvTaCnCtDf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class KkGDvTaCnCtDfController extends Controller
{
    public function storetthh(Request $request){
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

        if(isset($inputs['tenhh'])){
            $modelkkgia = new KkGDvTaCnCtDf();
            $modelkkgia->create($inputs);

            $model = KkGDvTaCnCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mã - Tên hàng hoá</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách, chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>hiện hành</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>mới</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tthh){
                    $result['message'] .= '<tr id="'.$tthh->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tthh->mahh.'-'.$tthh->tenhh.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tthh->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tthh->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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

    public function editthh(Request $request){
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

            $model = KkGDvTaCnCtDf::findOrFail($id);
            //dd($model);
            $result['message'] = '<div class="modal-body" id="ttedit">';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Mã hàng hoá</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="mahhedit" id="mahhedit" class="form-control" value="'.$model->mahh.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Tên hàng hoá</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="tenhhedit" id="tenhhedit" class="form-control" value="'.$model->tenhh.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="qccledit" id="qccledit" class="form-control" value="'.$model->qccl.'"></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';
            $result['message'] .= '</div>';

            $result['message'] .= '<div class="row">';
            $result['message'] .= '<div class="col-md-6">';
            $result['message'] .= '<div class="form-group"><label for="selGender" class="control-label"><b>Đơn vị tính</b><span class="require">*</span></label>';
            $result['message'] .= '<div><input type="text" name="dvtedit" id="dvtedit" class="form-control" value="'.$model->dvt.'"></div>';
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

    public function updatehh(Request $request){
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
            $id= $inputs['id'];
            $modelkkgia = KkGDvTaCnCtDf::findOrFail($id);
            $modelkkgia->update($inputs);

            $model = KkGDvTaCnCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mã - Tên hàng hoá</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách, chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>hiện hành</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>mới</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tthh){
                    $result['message'] .= '<tr id="'.$tthh->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tthh->mahh.' - '.$tthh->tenhh.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tthh->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tthh->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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

    public function deletehh(Request $request){
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
            $id= $inputs['id'];
            $modelkkgia = KkGDvTaCnCtDf::findOrFail($id)->delete();

            $model = KkGDvTaCnCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mã - Tên hàng hoá</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách, chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>hiện hành</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>mới</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tthh){
                    $result['message'] .= '<tr id="'.$tthh->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tthh->mahh.' - '.$tthh->tenhh.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tthh->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tthh->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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

    public function kkgiahh(Request $request){
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

            $model = KkGDvTaCnCtDf::where('id',$inputs['id'])
                ->first();
            ($model->mucgialk != null)? $mucgialk = $model->mucgialk : $mucgialk = 0;
            ($model->mucgiakk != null)? $mucgiakk = $model->mucgiakk : $mucgiakk = 0;

            $result['message'] = '<div class="modal-body" id="ttkkgia">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Mức giá kê khai liền kề</b></label>';
            $result['message'] .= '<input type="text" style="text-align: right" id="mucgialk" name="mucgialk" class="form-control" data-mask="fdecimal" value="' . $mucgialk . '" autofocus>';
            $result['message'] .= '</div>';

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

    public function updatekkgiahh(Request $request){
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
            $id= $inputs['id'];
            $modelkkgia = KkGDvTaCnCtDf::findOrFail($id);
            $inputs['mucgialk'] = getMoneyToDb($inputs['mucgialk']);
            $inputs['mucgiakk'] = getMoneyToDb($inputs['mucgiakk']);
            $modelkkgia->update($inputs);

            $model = KkGDvTaCnCtDf::where('masothue',$inputs['masothue'])
                ->get();

            $result['message'] = '<div class="row" id="dsts">';
            $result['message'] .= '<div class="col-md-12">';
            $result['message'] .= '<table class="table table-striped table-bordered table-hover" id="sample_3">';
            $result['message'] .= '<thead>';
            $result['message'] .= '<tr>';
            $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
            $result['message'] .= '<th style="text-align: center">Mã - Tên hàng hoá</th>';
            $result['message'] .= '<th style="text-align: center">Quy cách, chất lượng</th>';
            $result['message'] .= '<th style="text-align: center">Đơn vị<br> tính</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>hiện hành</th>';
            $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai<br>mới</th>';
            $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
            $result['message'] .= '<th style="text-align: center">Thao tác</th>';
            $result['message'] .= '</tr>';
            $result['message'] .= '</thead>';


            $result['message'] .= '<tbody>';
            if(count($model) > 0){
                foreach($model as $key=>$tthh){
                    $result['message'] .= '<tr id="'.$tthh->id.'">';
                    $result['message'] .= '<td style="text-align: center">'.($key +1).'</td>';
                    $result['message'] .= '<td class="active">'.$tthh->mahh.' - '.$tthh->tenhh.'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->qccl.'</td>';
                    $result['message'] .= '<td style="text-align: center">'.$tthh->dvt.'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgialk).'</td>';
                    $result['message'] .= '<td style="text-align: right">'.number_format($tthh->mucgiakk).'</td>';
                    $result['message'] .= '<td style="text-align: left">'.$tthh->ghichu.'</td>';
                    $result['message'] .= '<td>'.
                        '<button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>'.
                        '<button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh('.$tthh->id.');"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>'.
                        '<button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid('.$tthh->id.');" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>'

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
