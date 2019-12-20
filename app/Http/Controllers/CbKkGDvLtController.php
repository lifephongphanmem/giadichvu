<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DnDvLt;
use App\CbKkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CbKkGDvLtController extends Controller
{
    public function index(Request $request){
        $inputs = $request->all();
        $inputs['loaihang'] = isset($inputs['loaihang']) ? $inputs['loaihang'] : 'all';
        $inputs['tencskd'] = isset($inputs['tencskd']) ? $inputs['tencskd'] : '';
        $inputs['diachikd'] = isset($inputs['diachikd']) ? $inputs['diachikd'] : '';
        $inputs['paginate'] = isset($inputs['paginate']) ? $inputs['paginate'] : '5';
        $model = new CsKdDvLt();
        if($inputs['loaihang'] != 'all')
            $model = CsKdDvLt::where('loaihang',$inputs['loaihang']);
        if($inputs['tencskd'] != '')
            $model = $model->where('tencskd','like', '%'.$inputs['tencskd'].'%');
        if($inputs['diachikd'] != '')
            $model = $model->where('diachikd','like', '%'.$inputs['diachikd'].'%');
        $model = $model->paginate($inputs['paginate']);
        //dd($model);

        return view('congbo.dvlt.index')
            ->with('model',$model)
            ->with('inputs',$inputs)
            ->with('pageTitle','Thông tin cơ sở kinh doanh kê khai dịch vụ lưu trú');
    }

    public function show($macskd){

        $modelcskd = CsKdDvLt::where('macskd',$macskd)
            ->first();
        if(count($modelcskd)>0) {
            $modelcq = DnDvLt::where('masothue', $modelcskd->masothue)->first();
            $modelcb = CbKkGDvLt::where('macskd', $macskd)
                ->first();
            $model = KkGDvLt::where('mahs',$modelcb->mahs)->first();
            if (count($modelcb) > 0)
                $modelcbct = KkGDvLtCt::where('mahs', $modelcb->mahs)
                    ->get();
            else
                $modelcbct = '';

            return view('congbo.dvlt.show')
                ->with('modelcskd', $modelcskd)
                ->with('modelcq', $modelcq)
                ->with('modelcb', $modelcb)
                ->with('modelcbct', $modelcbct)
                ->with('model',$model)
                ->with('pageTitle', 'Thông tin kê khai dịch vụ');
        }else{
            dd('Không tìm thấy cơ sở kinh doanh dịch vụ lưu trú');
        }
    }

    public function history($macskd){
        $model = KkGDvLt::where('trangthai','Duyệt')
            ->where('macskd',$macskd)
            ->get();
        $modelcskd = CsKdDvLt::where('macskd',$macskd)->first();
        return view('congbo.dvlt.history')
            ->with('model',$model)
            ->with('modelcskd',$modelcskd)
            ->with('pageTitle','Thông tin kê khai giá');
    }

    public function showttkk(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        $inputs = $request->all();

        if(isset($inputs['id'])) {
            $modelkk = KkGDvLt::where('id', $inputs['id'])
                ->first();
            $model = KkGDvLtCt::where('mahs', $modelkk->mahs)
                ->get();
            if ($modelkk->phanloai != 'DT') {
                $result['message'] = '<div class="row" id="ttshow"> ';
                $result['message'] .= '<div class="col-md-12">';
                $result['message'] .= '<table class="table table-striped table-bordered table-hover table-dulieubang"> ';
                $result['message'] .= '<thead>';
                $result['message'] .= '<tr>';
                $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
                $result['message'] .= '<th style="text-align: center">Loại phòng<br> Quy cách chất lượng</th>';
                $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
                $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai</th>';
                $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
                $result['message'] .= '</tr>';
                $result['message'] .= '</thead>';

                $result['message'] .= '<tbody>';
                if (count($model) > 0) {
                    foreach ($model as $key => $ttphong) {
                        $result['message'] .= '<tr>';
                        $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                        $result['message'] .= '<td class="active">' . $ttphong->loaip . '-' . $ttphong->qccl . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . getTtPhong($ttphong->sohieu) . '</td>';
                        $result['message'] .= '<td style="text-align: right">' . number_format($ttphong->mucgiakk) . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $ttphong->ghichu . '</td>';
                        $result['message'] .= '</tr>';
                    }
                    $result['message'] .= '</tbody>';
                    $result['message'] .= '</table>';
                    $result['message'] .= '<p>' . nl2br(e($modelkk->ghichu)) . '</p>';
                    $result['message'] .= '</div>';
                    $result['message'] .= '</div>';
                    $result['status'] = 'success';
                }
            }else{
                $result['message'] = '<div class="row" id="ttshow"> ';
                $result['message'] .= '<div class="col-md-12">';
                $result['message'] .= '<table class="table table-striped table-bordered table-hover table-dulieubang"> ';
                $result['message'] .= '<thead>';
                $result['message'] .= '<tr>';
                $result['message'] .= '<th width="2%" style="text-align: center">STT</th>';
                $result['message'] .= '<th style="text-align: center">Loại phòng<br> Quy cách chất lượng</th>';
                $result['message'] .= '<th style="text-align: center">Số hiệu phòng</th>';
                $result['message'] .= '<th style="text-align: center">Áp dụng</th>';
                $result['message'] .= '<th style="text-align: center">Đối tượng</th>';
                $result['message'] .= '<th style="text-align: center">Mức giá<br>kê khai</th>';
                $result['message'] .= '<th style="text-align: center">Ghi chú</th>';
                $result['message'] .= '</tr>';
                $result['message'] .= '</thead>';

                $result['message'] .= '<tbody>';
                if (count($model) > 0) {
                    foreach ($model as $key => $ttphong) {
                        $result['message'] .= '<tr>';
                        $result['message'] .= '<td style="text-align: center">' . ($key + 1) . '</td>';
                        $result['message'] .= '<td class="active">' . $ttphong->loaip . '-' . $ttphong->qccl . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . getTtPhong($ttphong->sohieu) . '</td>';
                        $result['message'] .= '<td style="text-align: left">' .$ttphong->tendoituong . '</td>';
                        $result['message'] .= '<td style="text-align: left">' .$ttphong->apdung . '</td>';
                        $result['message'] .= '<td style="text-align: right">' . number_format($ttphong->mucgiakk) . '</td>';
                        $result['message'] .= '<td style="text-align: left">' . $ttphong->ghichu . '</td>';
                        $result['message'] .= '</tr>';
                    }
                    $result['message'] .= '</tbody>';
                    $result['message'] .= '</table>';
                    $result['message'] .= '<p>' . nl2br(e($modelkk->ghichu)) . '</p>';
                    $result['message'] .= '</div>';
                    $result['message'] .= '</div>';
                    $result['status'] = 'success';
                }
            }
        }
        die(json_encode($result));
    }
}
