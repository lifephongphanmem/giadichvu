<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login(){
        return view('system.users.login')
            ->with('pageTitle','Đăng nhập hệ thống');
    }

    public function signin(Request $request){
        $input = $request->all();
        $check = Users::where('username',$input['username'])->count();
        if($check == 0)
            return view('errors.invalid-user');
        else
            $ttuser = Users::where('username', $input['username'])->first();


        if(md5($input['password'])== $ttuser->password){
            if($ttuser->status == "Kích hoạt"){
                Session::put('admin', $ttuser);

                if($ttuser->pldv == 'DVVT'){
                    $ttdnvt = DonViDvVt::where('masothue',$ttuser->mahuyen)
                        ->first();
                    Session::put('ttdnvt',$ttdnvt);
                }
                return redirect('')
                    -> with('pageTitle', 'Tổng quan');
            }else
                return view('errors.lockuser');

        }else
            return view('errors.invalid-pass');
    }

    public function cp(){

        if(Session::has('admin')){

            return view('system.users.change-pass')
                ->with('pageTitle','Thay đổi mật khẩu');

        }else
            return view('errors.notlogin');

    }

    public function cpw(Request $request){

        $update = $request->all();

        $username = session('admin')->username;

        $password = session('admin')->password;

        $newpass2 = $update['newpassword2'];

        $currentPassword = $update['current-password'];

        if(md5($currentPassword) == $password){
            $ttuser = Users::where('username',$username)->first();
            $ttuser->password = md5($newpass2);
            if($ttuser->save()){
                Session::flush();
                return view('errors.changepassword-success');
            }
        }else{
            dd('Mật khẩu cũ không đúng???');
        }
    }

    public function checkpass(Request $request){
        $input = $request->all();
        $passmd5 = md5($input['pass']);

        if(session('admin')->password == $passmd5){
            echo 'ok';
        }else {
            echo 'cancel';
        }
    }

    public function checkuser(Request $request){
        $input = $request->all();
        $newusser = $input['user'];
        $model = Users::where('username',$newusser)
            ->first();
        if(isset($model)){
            echo 'cancel';
        }else {
            echo 'ok';
        }
    }

    public function logout() {

        if (Session::has('admin'))
        {
            Session::flush();
            return redirect('/login');

        }else {
            return redirect('');
        }
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
