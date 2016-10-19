<?php

namespace App\Http\Controllers;

use App\DnDvLt;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DnDvLtController extends Controller
{
    public function index()
    {
        if (Session::has('admin')) {

            $model = DnDvLt::where('trangthai','Kích hoạt')
                ->get();

            return view('system.dndvlt.index')
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Session::has('admin')) {

            return view('system.dndvlt.create')
                ->with('pageTitle','Thêm mới doanh nghiệp cung cấp dịch vụ lưu trú');

        }else
            return view('errors.notlogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::has('admin')) {

            $insert = $request-> all();
            $model = new DnDvLt();
            $model->tendn = $insert['tendn'];
            $model->masothue = $insert['masothue'];
            $model->diachidn = $insert['diachidn'];
            $model->teldn = $insert['teldn'];
            $model->faxdn = $insert['faxdn'];
            $model->noidknopthue= $insert['noidknopthue'];
            $model->chucdanhky = $insert['chucdanhky'];
            $model->nguoiky = $insert['nguoiky'];
            $model->diadanh = $insert['diadanh'];
            //$model->tailieu = $insert['tailieu'];
            $model->trangthai = 'Kích hoạt';
            //$model->email = $insert['email'];
            if($model->save()){
                $modeluser = new Users();
                $modeluser->name = $insert['tendn'];
                $modeluser->phone = $insert['teldn'];
                $modeluser->username = $insert['username'];
                $modeluser->password = md5($insert['password']);
                $modeluser->status = 'Kích hoạt';
                $modeluser->level = 'DVLT';
                $modeluser->mahuyen = $insert['masothue'];
                $modeluser->save();
            }
            return redirect('dn_dichvu_luutru');

        }else
            return view('errors.notlogin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::has('admin')) {

            $model = DnDvLt::findOrFail($id);
            return view('system.dndvlt.edit')
                ->with('model',$model)
                ->with('pageTitle','Chỉnh sửa thông tin doanh nghiệp');

        }else
            return view('errors.notlogin');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {

            $update = $request->all();

            $model = DnDvLt::findOrFail($id);
            $model->tendn = $update['tendn'];
            $model->diachidn = $update['diachidn'];
            $model->teldn = $update['teldn'];
            $model->faxdn = $update['faxdn'];
            $model->noidknopthue= $update['noidknopthue'];
            $model->chucdanhky = $update['chucdanhky'];
            $model->nguoiky = $update['nguoiky'];
            $model->diadanh = $update['diadanh'];
            //$model->tailieu = $update['tailieu'];
            //$model->email = $update['email'];
            $model->save();

            return redirect('dn_dichvu_luutru');


        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){

        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['iddelete'];

            $model = DnDvLt::findOrFail($id);
            $model->delete();
            return redirect('dn_dichvu_luutru');

        }else
            return view('errors.notlogin');
    }

    public function CheckMaSoThue($masothue){

        $doanhnghiep = DnDvLt::where('masothue',$masothue)->first();
        if(isset($doanhnghiep)){
            echo 'duplicate';
        }else {
            echo 'ok';
        }
    }

    public function CheckUser(Request $request){
        $input = $request->all();
        $users = Users::where('username',$input['user'])->first();
        if(isset($users)){
            echo 'duplicate';
        }else {
            echo 'ok';
        }
    }
}
