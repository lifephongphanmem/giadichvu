<?php

namespace App\Http\Controllers;

use App\DonViDvVt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\DmDvVtXk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmDvVtXkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                if(session('admin')->sadmin == 'ssa'){
                    $model = DonViDvVt::all();
                }else{
                    $model = DonViDvVt::where('cqcq',session('admin')->cqcq)
                        ->get();
                }
                return view('manage.dvvt.template.dsdonvi_danhmuc')
                    ->with('model',$model)
                    ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                    ->with('pageTitle','Danh mục dịch vụ vận tải');
            }

            $masothue=session('admin')->mahuyen;
            $model = DmDvVtXk::where('masothue',$masothue)->get();
            $per=array(
                'create'=>can('dvvtxk','create'),
                'edit' =>can('dvvtxk','edit'),
                'delete' =>can('dvvtxk','delete'),
                'approve'=>can('dvvtxk','approve')
            );
            return view('manage.dvvt.dvxk.dmdv.index')
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('model',$model)
                ->with('per',$per)
                ->with('masothue',$masothue)
                ->with('pageTitle','Danh mục vận tải hành khách bằng xe ô tô theo tuyến cố định');

        }else
            return view('errors.notlogin');
    }

    public function show($masothue)
    {
        if (Session::has('admin')) {
            $model = DmDvVtXk::where('masothue',$masothue)->get();
            $per=array(
                'create'=>can('dvvtch','create'),
                'edit' =>can('dvvtch','edit'),
                'delete' =>can('dvvtch','delete'),
                'approve'=>can('dvvtch','approve')
            );

            return view('manage.dvvt.dvxk.dmdv.index')
                ->with('url','/dich_vu_van_tai/dich_vu_xe_khach/')
                ->with('per',$per)
                ->with('model',$model)
                ->with('masothue',$masothue)
                ->with('pageTitle','Danh mục dịch vụ vận tải');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $model = DmDvVtXk::findOrFail($request->iddel);
            $model->delete();
            return redirect('/dich_vu_van_tai/dich_vu_xe_khach/danh_muc');
        }else
            return view('errors.notlogin');
    }

    function add(Request $request)
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
        //Thêm mới dịch vụ
        if ($inputs['id'] == 0) {
            $model = new DmDvVtXk();
            $model->masothue = $inputs['masothue'];
            $model->madichvu = 'DVXK'. $inputs['masothue'] . getdate()[0];
            //$model->diemdau = $inputs['diemdau'];
            //$model->diemcuoi = $inputs['diemcuoi'];
            $model->sokm = getDbl($inputs['sokm']);
            $model->tendichvu = $inputs['tendichvu'];
            $model->dvt = $inputs['dvt'];
            $model->loaixe = $inputs['loaixe'];
            $model->qccl = $inputs['qccl'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        } else {
            $id=$inputs['id'];
            $model = DmDvVtXk::findOrFail($id);
            $model->tendichvu = $inputs['tendichvu'];
            $model->dvt = $inputs['dvt'];
            $model->loaixe = $inputs['loaixe'];
            $model->qccl = $inputs['qccl'];
            $model->ghichu = $inputs['ghichu'];
            $model->sokm = getDbl($inputs['sokm']);
            $model->save();
        }

        //Trả lại kết quả
        $result['message'] = 'ok';
        $result['status'] = 'success';

        die(json_encode($result));
    }

    function get(Request $request){
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }

        $inputs = $request->all();
        $model = DmDvVtXk::find($inputs['id']);
        die($model);
    }
}
