<?php

namespace App\Http\Controllers;

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
            $model = DmDvVtXk::where('masothue',session('admin')->mahuyen)->get();
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

    function AddDM(Request $request)
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
            $model->masothue = session('admin')->mahuyen;
            $model->madichvu = 'DVXK'.session('admin')->mahuyen . getdate()[0];
            $model->diemdau = $inputs['diemdau'];
            $model->diemcuoi = $inputs['diemcuoi'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->dvt = $inputs['dvt'];
            $model->loaixe = $inputs['loaixe'];
            $model->qccl = $inputs['qccl'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        } else {
            $id=$inputs['id'];
            $model =  DmDvVtXk::findOrFail($id);
            $model->diemdau = $inputs['diemdau'];
            $model->diemcuoi = $inputs['diemcuoi'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->dvt = $inputs['dvt'];
            $model->loaixe = $inputs['loaixe'];
            $model->qccl = $inputs['qccl'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        }

        //Trả lại kết quả
        $result['message'] = 'ok';
        $result['status'] = 'success';

        die(json_encode($result));
    }
}