<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DmDvVtXtx;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DmDvVtXtxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('admin')) {
            $model = DmDvVtXtx::where('masothue',session('admin')->mahuyen)->get();
            return view('manage.dvvt.dvxtx.dmdv.index')
                ->with('url','/dich_vu_van_tai/dich_vu_xe_taxi/')
                ->with('model',$model)
                ->with('pageTitle','Danh mục dịch vụ vận tải');

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $model = DmDvVtXtx::findOrFail($request->iddel);
            $model->delete();
            return redirect('/dich_vu_van_tai/dich_vu_xe_taxi/danh_muc');
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
        if ($inputs['id'] == 0) {
            $model = new DmDvVtXtx();
            $model->masothue = session('admin')->mahuyen;
            $model->madichvu = 'DVXTX'.session('admin')->mahuyen . getdate()[0];
            $model->loaixe = $inputs['loaixe'];
            $model->tendichvu = $inputs['tendichvu'];
            $model->dvt = $inputs['dvt'];
            $model->qccl = $inputs['qccl'];
            $model->ghichu = $inputs['ghichu'];
            $model->save();
        } else {
            $id=$inputs['id'];
            $model =  DmDvVtXtx::findOrFail($id);
            $model->tendichvu = $inputs['tendichvu'];
            $model->loaixe = $inputs['loaixe'];
            $model->dvt = $inputs['dvt'];
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
