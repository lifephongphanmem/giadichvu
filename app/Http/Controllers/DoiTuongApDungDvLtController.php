<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DnDvLt;
use App\DoiTuongApDungDvLt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DoiTuongApDungDvLtController extends Controller
{
    public function cskd()
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                    if (session('admin')->sadmin == 'ssa') {
                        $model = DnDvLt::all();
                    } else {
                        $model = DnDvLt::where('cqcq', session('admin')->cqcq)
                            ->get();
                    }
                    return view('manage.dvlt.doituongapdung.ql.index')
                        ->with('model', $model)
                        ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp dịch vụ lưu trú');

                } else {
                    $masothue = session('admin')->mahuyen;
                    $model = CsKdDvLt::where('masothue', $masothue)
                        ->get();
                    return view('manage.dvlt.doituongapdung.ttcskd.index')
                        ->with('masothue', $masothue)
                        ->with('model', $model)
                        ->with('pageTitle', 'Thông tin cơ sở kinh doanh cung cấp dịch vụ lưu trú');
                }
            } else {
                return view('errors.perm');
            }
        } else
            return view('errors.notlogin');
    }
    //Thông tin doanh nghiệp quản lý
    public function showcskd($masothue){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $model = CsKdDvLt::where('masothue', $masothue)
                    ->get();
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq) {
                    return view('manage.dvlt.doituongapdung.ttcskd.index')
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

    public function index($macskd){
        if (Session::has('admin')) {
            $model = DoiTuongApDungDvLt::where('macskd', $macskd)
                ->get();
            $modelcskd = CsKdDvLt::where('macskd', $macskd)
                ->first();
            return view('manage.dvlt.doituongapdung.index')
                ->with('model',$model)
                ->with('modelcskd',$modelcskd)
                ->with('macskd',$macskd)
                ->with('pageTitle','Danh sách đối tượng áp dụng');
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = new DoiTuongApDungDvLt();
            $model->tendoituong = $input['tendoituong'];
            $model->macskd = $input['macskdcreate'];
            $model->masothue = $input['masothuecreate'];
            $model->save();
            return redirect('doi_tuong_ap_dung/co_so_kinh_doanh='.$input['macskdcreate']);
        }else
            return view('errors.notlogin');
    }

    public function edit(Request $request){
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

            $model = DoiTuongApDungDvLt::where('id',$inputs['id'])
                ->first();
            //dd($model);
            $result['message'] = '<div id="ttdoituong">';
            $result['message'] .= '<div class="modal-body">';
            $result['message'] .= '<div class="form-group">';
            $result['message'] .= '<label><b>Đối tượng áp dụng</b></label>';
            $result['message'] .= '<textarea id="tendoituongedit" class="form-control required" name="tendoituongedit" cols="30" rows="5" placeholder="Giá áp dụng cho loại đối tượng">'.$model->tendoituong.'</textarea></div>';
            $result['message'] .= '</div>';
            $result['message'] .= '<input type="hidden" id="idedit" name="idedit" value="'.$model->id.'">';
            $result['status'] = 'success';
        }
        die(json_encode($result));
    }

    public function update(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = DoiTuongApDungDvLt::where('id',$input['idedit'])
                ->first();
            $model->tendoituong = $input['tendoituongedit'];
            $model->save();
            return redirect('doi_tuong_ap_dung/co_so_kinh_doanh='.$model->macskd);
        }else
            return view('errors.notlogin');
    }

    public function delete(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = DoiTuongApDungDvLt::where('id',$input['iddelete'])
                ->first();
            $macskd = $model->macskd;
            $model->delete();
            return redirect('doi_tuong_ap_dung/co_so_kinh_doanh='.$macskd);
        }else
            return view('errors.notlogin');
    }

}
