<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnDvLtReg;
use App\DnTaCn;
use App\DonViDvVt;
use App\DonViDvVtReg;
use App\Register;
use App\Users;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function login()
    {
        return view('system.users.login')
            ->with('pageTitle', 'Đăng nhập hệ thống');
    }

    public function signin(Request $request)
    {
        $input = $request->all();
        /*$partten = "/^[A-Za-z0-9_\.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/";
        $subject = $input['username'];
        if(preg_match($partten ,$subject, $matchs))
           $check = Users::where('email', $input['username'])
                ->first();
        else*/
            $check = Users::where('username', $input['username'])
                ->count();
        if ($check == 0)
            return view('errors.invalid-user');
        else{
            //if(!preg_match($partten ,$subject, $matchs))
                $ttuser = Users::where('username', $input['username'])->first();
           // else
                //$ttuser = Users::where('email', $input['username'])->first();
        }
        if (md5($input['password']) == $ttuser->password) {
            if ($ttuser->status == "Kích hoạt") {
                if ($ttuser->level == 'DVVT') {
                    $ttdnvt = DonViDvVt::where('masothue', $ttuser->mahuyen)
                        ->first();
                    $dvvt = $ttdnvt->setting;
                    $ttuser->dvvtcc = $dvvt;
                }
                Session::put('admin', $ttuser);

                return redirect('')
                    ->with('pageTitle', 'Tổng quan');
            } else
                return view('errors.lockuser');

        } else
            return view('errors.invalid-pass');
    }

    public function cp()
    {

        if (Session::has('admin')) {

            return view('system.users.change-pass')
                ->with('pageTitle', 'Thay đổi mật khẩu');

        } else
            return view('errors.notlogin');

    }

    public function cpw(Request $request)
    {

        $update = $request->all();

        $username = session('admin')->username;

        $password = session('admin')->password;

        $newpass2 = $update['newpassword2'];

        $currentPassword = $update['current-password'];

        if (md5($currentPassword) == $password) {
            $ttuser = Users::where('username', $username)->first();
            $ttuser->password = md5($newpass2);
            if ($ttuser->save()) {
                Session::flush();
                return view('errors.changepassword-success');
            }
        } else {
            dd('Mật khẩu cũ không đúng???');
        }
    }

    public function checkpass(Request $request)
    {
        $input = $request->all();
        $passmd5 = md5($input['pass']);

        if (session('admin')->password == $passmd5) {
            echo 'ok';
        } else {
            echo 'cancel';
        }
    }

    public function checkuser(Request $request)
    {
        $input = $request->all();
        $newusser = $input['user'];

        $model = Users::where('username', $newusser)
            ->first();
        if (isset($model)) {
            echo 'cancel';
        } else {
            echo 'ok';
        }
    }

    public function checkmasothue(Request $request)
    {
        $input = $request->all();
        if ($input['pl'] == 'DVLT') {
            $model = DnDvLt::where('masothue', $input['masothue'])
                ->first();
        }elseif($input['pl']=='DVVT'){
            $model = DonViDvVt::where('masothue',$input['masothue'])
                ->first();
        }
        if (isset($model)) {
            echo 'cancel';
        } else {
            echo 'ok';
        }
    }

    public function logout()
    {
        if (Session::has('admin')) {
            Session::flush();
            return redirect('/login');
        } else {
            return redirect('');
        }
    }

    public function index(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                $inputs = $request->all();
                if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin =='sa')
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? $inputs['phanloai'] : 'QL';
                elseif(session('admin')->sadmin == 'savt')
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVVT' : 'DVVT';
                elseif(session('admin')->sadmin == 'satc')
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVLT' : 'DVLT';
                elseif(session('admin')->sadmin == 'sact')
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVGS' : 'DVGS';
                elseif(session('admin')->sadmin == 'satacn')
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVTACN' : 'DVTACN';

                if ($inputs['phanloai'] == 'QL')
                    $level = array('T','H');
                elseif ($inputs['phanloai'] == 'DVLT')
                    $level = array('DVLT');
                elseif ($inputs['phanloai'] == 'DVVT')
                    $level = array('DVVT');
                elseif ($inputs['phanloai'] == 'DVGS')
                    $level = array('DVGS');
                elseif ($inputs['phanloai'] == 'DVTACN')
                    $level = array('DVTACN');

                if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin =='sa') {
                    $model = Users::wherein('level', $level)
                        ->orderBy('id', 'desc')
                        ->get();
                }elseif((session('admin')->sadmin == 'savt') || (session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'satacn')) {
                    $model = Users::wherein('level', $level)
                        ->where('cqcq', session('admin')->cqcq)
                        ->orderBy('id', 'desc')
                        ->get();
                }else{
                    return view('errors.noperm');
                }
                $index_unset = 0;
                foreach ($model as $user) {
                    if ($user->sadmin == 'ssa') {
                        unset($model[$index_unset]);
                    }
                    $index_unset++;
                }

                return view('system.users.index')
                    ->with('model', $model)
                    ->with('pl', $inputs['phanloai'])
                    ->with('pageTitle', 'Danh sách tài khoản');
            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    public function create()
    {
        if (Session::has('admin')) {
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {

                $modeldvql = DmDvQl::all();
                return view('system.users.create')
                    ->with('modeldvql', $modeldvql)
                    ->with('pageTitle', 'Chỉnh sửa thông tin tài khoản');
            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    public function store(Request $request)
    {
        if (Session::has('admin')) {
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                $inputs = $request->all();
                $modelcqcq = DmDvQl::where('maqhns',$inputs['cqcq'])->first();
                if($modelcqcq->plql == 'TC' && $inputs['sadmin'] == 'qtht'){
                    $sadmin ='salt';
                }elseif($modelcqcq->plql == 'VT' && $inputs['sadmin'] == 'qtht'){
                    $sadmin = 'savt';
                }elseif($modelcqcq->plql == 'CT' && $inputs['sadmin'] == 'qtht'){
                    $sadmin = 'sact';
                }else{
                    $sadmin = '';
                }
                $model = new  Users();
                $model->cqcq = $inputs['cqcq'];
                $model->name = $inputs['name'];
                $model->status = 'Kích hoạt';
                $model->level = $modelcqcq->level;
                $model->username = $inputs['username'];
                $model->password = md5($inputs['password']);
                $model->phone = $inputs['phone'];
                $model->ttnguoitao = session('admin')->name.'('.session('admin')->username.')'. getDateTime(Carbon::now()->toDateTimeString());
                if($sadmin !='')
                    $model->sadmin = $sadmin;
                $model->save();
                return redirect('users');

            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Session::has('admin')) {
            $model = Users::findOrFail($id);
            if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt' || session('admin')->sadmin == 'sa') {
                if (session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq || session('admin')->sadmin == 'sa') {
                    if ($model->level == 'DVLT')
                        $modeldvql = DmDvQl::where('plql', 'TC')
                            ->get();
                    elseif ($model->level == 'DVVT')
                        $modeldvql = DmDvQl::where('plql', 'VT')
                            ->get();
                    elseif ($model->level == 'DVVT')
                        $modeldvql = DmDvQl::where('plql', 'CT')
                            ->get();
                    elseif($model->level == 'DVTACN')
                        $modeldvql = DmDvQl::where('plql','TC')
                        ->get();
                    else
                        $modeldvql = '';
                    return view('system.users.edit')
                        ->with('model', $model)
                        ->with('modeldvql', $modeldvql)
                        ->with('pageTitle', 'Chỉnh sửa thông tin tài khoản');
                } else {
                    return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }

        } else {
            return view('errors.notlogin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Users::findOrFail($id);
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa' || $model->cqcq == session('admin')->cqcq) {
                $model->name = $input['name'];
                //$model->phone = $input['phone'];
                $model->email = $input['email'];
                $model->status = $input['status'];
                $model->username = $input['username'];
                //$model->cqcq = $input['cqcq'];
                if ($input['newpass'] != '')
                    $model->password = md5($input['newpass']);
                $model->save();
                if($model->level == 'T'|| $model->level == 'H')
                    $pl = 'QL';
                else
                    $pl=$model->level;                

                return redirect('users?&phanloai='.$pl);
            }else
                return view('errors.noperm');

        } else {
            return redirect('');
        }
    }

    public function destroy(Request $request)
    {
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = Users::findorFail($id);
            $model->delete();

            return redirect('users');

        } else
            return view('errors.notlogin');
    }

    public function permission($id)
    {
        if (Session::has('admin')) {

            $model = Users::findorFail($id);
            if($model->level == 'DVVT') {
                $ttdn = DonViDvVt::where('masothue',$model->mahuyen)
                    ->first();
                $setting = $ttdn->setting;

            }else
                $setting = '';
            $permission = !empty($model->permission) ? $model->permission : getPermissionDefault($model->level);
            //dd(json_decode($permission));
            return view('system.users.perms')
                ->with('permission', json_decode($permission))
                ->with('setting',$setting)
                ->with('model', $model)
                ->with('pageTitle', 'Phân quyền cho tài khoản');

        } else
            return view('errors.notlogin');
    }

    public function uppermission(Request $request)
    {
        if (Session::has('admin')) {
            $update = $request->all();

            $id = $update['id'];

            $model = Users::findOrFail($id);
            //dd($model);
            if (isset($model)) {
                $update['roles'] = isset($update['roles']) ? $update['roles'] : null;

                $model->permission = json_encode($update['roles']);
                $model->save();
                if($model->level == 'T' || $model->level == 'H')
                    $level = 'QL';
                else
                    $level = $model->level;

                return redirect('users?&phanloai='.$level);

            } else
                dd('Tài khoản không tồn tại');

        } else
            return view('errors.notlogin');
    }

    public function lockuser($id)
    {

        $arrayid = explode('-', $id);
        foreach ($arrayid as $ids) {
            $model = Users::findOrFail($ids);
            if ($model->status != "Chưa kích hoạt") {
                $model->status = "Vô hiệu";
                $model->save();
            }
        }
        return redirect('users');

    }

    public function unlockuser($id)
    {
        $arrayid = explode('-', $id);
        foreach ($arrayid as $ids) {
            $model = Users::findOrFail($ids);

            if ($model->status != "Chưa kích hoạt") {

                $model->status = "Kích hoạt";
                $model->save();
            }
        }
        return redirect('users');

    }

    public function register(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt'
                || session('admin')->sadmin == 'sact' || session('admin')->sadmin == 'sa' || session('admin')->sadmin == 'satacn') {

                if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? $inputs['phanloai'] : 'DVLT';
                }elseif(session('admin')->sadmin == 'satc'){
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVLT' : 'DVLT';
                }elseif(session('admin')->sadmin == 'savt'){
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVVT' : 'DVVT';
                }elseif(session('admin')->sadmin == 'sact'){
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVGS' : 'DVGS';
                }else{
                    $inputs['phanloai'] = isset($inputs['phanloai']) ? 'DVTACN' : 'DVTACN';
                }

                if($inputs['phanloai'] == 'DVLT'){
                    $dv = 'dịch vụ lưu trú';
                }elseif($inputs['phanloai'] == 'DVVT'){
                    $dv = 'dịch vụ vận tải';
                }elseif($inputs['phanloai'] == 'DVGS'){
                    $dv = 'dịch vụ giá sữa';
                }else{
                    $dv = 'cung cấp thức ăn chăn nuôi';
                }
                $inputs['trangthai'] = isset($inputs['trangthai']) ? $inputs['trangthai'] : 'choduyet';

                if($inputs['trangthai'] == 'choduyet')
                    $trangthai = 'Chờ duyệt';
                else
                    $trangthai = 'Bị trả lại';

                if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                    $model = Register::where('pl', $inputs['phanloai'])
                        ->where('trangthai',$trangthai)
                        ->orderBy('id', 'desc')
                        ->get();
                } else {
                    $model = Register::where('pl',  $inputs['phanloai'])
                        ->where('cqcq', session('admin')->cqcq)
                        ->where('trangthai',$trangthai)
                        ->orderBy('id', 'desc')
                        ->get();
                }

                return view('system.users.register.index')
                    ->with('model', $model)
                    ->with('phanloai', $inputs['phanloai'])
                    ->with('dv',$dv)
                    ->with('trangthai',$inputs['trangthai'])
                    ->with('pageTitle', 'Thông tin tài khoản đăng ký');
            }else{
                return view('errors.perm');
            }

        } else
            return view('errors.notlogin');
    }

    public function registershow($id){
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc' || session('admin')->sadmin == 'savt') {
                $model = Register::findOrFail($id);

                if ($model->pl == 'DVLT' && session('admin')->sadmin == 'ssa' || $model->pl == 'DVLT' && session('admin')->sadmin == 'satc') {
                    $cqcq = DmDvQl::where('plql', 'TC')
                        ->get();
                    return view('system.users.register.dvlt')
                        ->with('model', $model)
                        ->with('cqcq', $cqcq)
                        ->with('pageTitle', 'Thông tin đăng ký tài khoản dịch vụ lưu trú');
                } elseif ($model->pl == 'DVVT' && session('admin')->sadmin == 'ssa' || $model->pl == 'DVVT' && session('admin')->sadmin == 'savt') {
                    $cqcq = DmDvQl::where('plql', 'VT')
                        ->get();
                    return view('system.users.register.dvvt')
                        ->with('model', $model)
                        ->with('cqcq', $cqcq)
                        ->with('pageTitle', 'Thông tin đăng ký tài khoản dịch vụ vận tải');
                } elseif ($model->pl == 'DVGS' && session('admin')->sadmin == 'ssa' || $model->pl == 'DVGS' && session('admin')->sadmin == 'sact') {
                    $cqcq = DmDvQl::where('plql', 'CT')
                        ->get();
                    return view('system.users.register.dvgs')
                        ->with('model', $model)
                        ->with('cqcq', $cqcq)
                        ->with('pageTitle', 'Thông tin đăng ký tài khoản dịch vụ giá sữa');
                } elseif ($model->pl == 'DVTACN' && session('admin')->sadmin == 'ssa' || $model->pl == 'DVTACN' && session('admin')->sadmin == 'satacn') {
                    $cqcq = DmDvQl::where('plql', 'TC')
                        ->get();
                    return view('system.users.register.dvtacn')
                        ->with('model', $model)
                        ->with('cqcq', $cqcq)
                        ->with('pageTitle', 'Thông tin đăng ký tài khoản dịch vụ cung cấp thức ăn chăn nuôi');
                }else{
                        return view('errors.noperm');
                }
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');

    }

    public function registerdvlt(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idregister'];
            $model = Register::findOrFail($id);
            $pl = $model->pl;
            if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq ) {
                $check = DnDvLt::where('masothue',$model->masothue)->first();
                if(count($check)>0){
                    return view('errors.notcrregisterlt');
                }else {
                    $modeldn = new DnDvLt();
                    $modeldn->tendn = $model->tendn;
                    $modeldn->masothue = $model->masothue;
                    $modeldn->teldn = $model->tel;
                    $modeldn->faxdn = $model->fax;
                    $modeldn->email = $model->email;
                    $modeldn->diachidn = $model->diachi;
                    $modeldn->trangthai = 'Kích hoạt';
                    $modeldn->noidknopthue = $model->noidknopthue;
                    $modeldn->tailieu = $model->tailieu;
                    $modeldn->giayphepkd = $model->giayphepkd;
                    $modeldn->cqcq = $model->cqcq;
                    $modeldn->chucdanhky = $model->chucdanh;
                    $modeldn->nguoiky = $model->nguoiky;
                    $modeldn->diadanh = $model->diadanh;
                    if ($modeldn->save()) {
                        $modeluser = new Users();
                        $modeluser->name = $model->tendn;
                        $modeluser->username = $model->username;
                        $modeluser->password = $model->password;
                        $modeluser->phone = $model->teldn;
                        $modeluser->email = $model->email;
                        $modeluser->status = 'Kích hoạt';
                        $modeluser->mahuyen = $model->masothue;
                        $modeluser->level = 'DVLT';
                        $modeluser->cqcq = $model->cqcq;
                        $modeluser->ttnguoitao = session('admin')->name.'('.session('admin')->username.') - '. getDateTime(Carbon::now()->toDateTimeString());
                        $modeluser->save();
                    }
                    $tencqcq = DmDvQl::where('maqhns', $model->cqcq)->first();
                    $data = [];
                    $data['tendn'] = $model->tendn;
                    $data['tg'] = Carbon::now()->toDateTimeString();
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['masothue'] = $model->masothue;
                    $data['username'] = $model->username;

                    $phone = $model->teldn;
                    $content ="Thông báo thông tin đăng ký đã được xét duyệt. ". $data['tendn']." - ".
                        $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['username'];
                    guitinjson($phone,$content);

                    $maildn = $model->email;
                    $tendn = $model->tendn;
                    $mailql = $tencqcq->emailqt;
                    $tenql = $tencqcq->tendv;

                        Mail::send('mail.successregister', $data, function ($message) use ($maildn,$tendn,$mailql,$tenql) {
                            $message->to($maildn,$tendn)
                                ->to($mailql,$tenql)
                                ->subject('Thông báo thông tin đăng ký đã được xét duyệt');
                            $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                        });
                    $delete = Register::findOrFail($id)->delete();
                    return redirect('users/register?&phanloai='.$pl);
                }

            }else{
                return view('errors.noperm');
            }

        } else
            return view('errors.notlogin');
    }

    public function registerdvvt(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idregister'];
            $model = Register::findOrFail($id);
            $pl = $model->pl;
            if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq ) {
                $modeldn = new DonViDvVt();
                $modeldn->tendonvi = $model->tendn;
                $modeldn->masothue = $model->masothue;
                $modeldn->dienthoai = $model->tel;
                $modeldn->fax = $model->fax;
                $modeldn->email = $model->email;
                $modeldn->diachi = $model->diachi;
                $modeldn->dknopthue = $model->noidknopthue;
                $modeldn->tailieu = $model->tailieu;
                $modeldn->giayphepkd = $model->giayphepkd;
                $modeldn->setting = $model->setting;
                $modeldn->dvxk = $model->dvxk;
                $modeldn->dvxb = $model->dvxb;
                $modeldn->dvxtx = $model->dvxtx;
                $modeldn->dvk = $model->dvk;
                $modeldn->toado = $model->diachi != '' ? getAddMap($model->diachi) : '';
                $modeldn->trangthai = 'Kích hoạt';
                $modeldn->cqcq = $model->cqcq;

                if ($modeldn->save()) {
                    $modeluser = new Users();
                    $modeluser->name = $model->tendn;
                    $modeluser->username = $model->username;
                    $modeluser->password = $model->password;
                    $modeluser->phone = $model->tel;
                    $modeluser->email = $model->email;
                    $modeluser->status = 'Kích hoạt';
                    $modeluser->mahuyen = $model->masothue;
                    $modeluser->level = 'DVVT';
                    $modeluser->cqcq = $model->cqcq;
                    $modeluser->save();
                }

                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $data=[];
                $data['tendn'] = $model->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $data['masothue'] = $model->masothue;
                $data['username'] = $model->username;

                $phone = $model->teldn;
                $content ="Thông báo thông tin đăng ký đã được xét duyệt. ". $data['tendn']." - ".
                    $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['username'];
                guitinjson($phone,$content);

                $a = $model->email;
                $b  =  $model->tendn;
                Mail::send('mail.successregister',$data, function ($message) use($a,$b) {
                    $message->to($a,$b )
                        ->subject('Thông báo thông tin đăng ký đã được xét duyệt');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
                $delete = Register::findOrFail($id)->delete();
                return redirect('users/register?&phanloai='.$pl);
            }else{
                return view('errors.noperm');
            }

        } else
            return view('errors.notlogin');
    }

    public function registerdvgs(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idregister'];
            $model = Register::findOrFail($id);
            $pl = $model->pl;
            if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq ) {
                $modeldn = new DnDvGs();
                $modeldn->tendn = $model->tendn;
                $modeldn->masothue = $model->masothue;
                $modeldn->teldn = $model->tel;
                $modeldn->faxdn = $model->fax;
                $modeldn->email = $model->email;
                $modeldn->diachidn = $model->diachi;
                $modeldn->trangthai = 'Kích hoạt';
                $modeldn->noidknopthue = $model->noidknopthue;
                $modeldn->tailieu = $model->tailieu;
                $modeldn->giayphepkd = $model->giayphepkd;
                $modeldn->cqcq = $model->cqcq;
                $modeldn->chucdanhky = $model->chucdanh;
                $modeldn->nguoiky = $model->nguoiky;
                $modeldn->diadanh = $model->diadanh;
                $modeldn->toado = $model->diachi != '' ? getAddMap($model->diachi) : '';

                if ($modeldn->save()) {
                    $modeluser = new Users();
                    $modeluser->name = $model->tendn;
                    $modeluser->username = $model->username;
                    $modeluser->password = $model->password;
                    $modeluser->phone = $model->tel;
                    $modeluser->email = $model->email;
                    $modeluser->status = 'Kích hoạt';
                    $modeluser->mahuyen = $model->masothue;
                    $modeluser->level = 'DVGS';
                    $modeluser->cqcq = $model->cqcq;
                    $modeluser->save();
                }

                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $data=[];
                $data['tendn'] = $model->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $data['masothue'] = $model->masothue;
                $data['username'] = $model->username;

                $phone = $model->teldn;
                $content ="Thông báo thông tin đăng ký đã được xét duyệt. ". $data['tendn']." - ".
                    $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['username'];
                guitinjson($phone,$content);

                $a = $model->email;
                $b  =  $model->tendn;
                Mail::send('mail.successregister',$data, function ($message) use($a,$b) {
                    $message->to($a,$b )
                        ->subject('Thông báo thông tin đăng ký đã được xét duyệt');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
                $delete = Register::findOrFail($id)->delete();
                return redirect('users/register?&phanloai='.$pl);
            }else{
                return view('errors.noperm');
            }

        } else
            return view('errors.notlogin');
    }
    public function registerdvtacn(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idregister'];
            $model = Register::findOrFail($id);
            $pl = $model->pl;
            if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq ) {
                $check = DnTaCn::where('masothue',$model->masothue)->first();
                if(count($check)>0){
                    return view('errors.notcrregisterlt');
                }else {
                    $modeldn = new DnTaCn();
                    $modeldn->tendn = $model->tendn;
                    $modeldn->masothue = $model->masothue;
                    $modeldn->teldn = $model->tel;
                    $modeldn->faxdn = $model->fax;
                    $modeldn->email = $model->email;
                    $modeldn->diachidn = $model->diachi;
                    $modeldn->trangthai = 'Kích hoạt';
                    $modeldn->noidknopthue = $model->noidknopthue;
                    $modeldn->tailieu = $model->tailieu;
                    $modeldn->giayphepkd = $model->giayphepkd;
                    $modeldn->cqcq = $model->cqcq;
                    $modeldn->chucdanhky = $model->chucdanh;
                    $modeldn->nguoiky = $model->nguoiky;
                    $modeldn->diadanh = $model->diadanh;
                    if ($modeldn->save()) {
                        $modeluser = new Users();
                        $modeluser->name = $model->tendn;
                        $modeluser->username = $model->username;
                        $modeluser->password = $model->password;
                        $modeluser->phone = $model->teldn;
                        $modeluser->email = $model->email;
                        $modeluser->status = 'Kích hoạt';
                        $modeluser->mahuyen = $model->masothue;
                        $modeluser->level = 'DVTACN';
                        $modeluser->cqcq = $model->cqcq;
                        $modeluser->ttnguoitao = session('admin')->name.'('.session('admin')->username.') - '. getDateTime(Carbon::now()->toDateTimeString());
                        $modeluser->save();
                    }
                    $tencqcq = DmDvQl::where('maqhns', $model->cqcq)->first();
                    $data = [];
                    $data['tendn'] = $model->tendn;
                    $data['tg'] = Carbon::now()->toDateTimeString();
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['masothue'] = $model->masothue;
                    $data['username'] = $model->username;

                    $phone = $model->teldn;
                    $content ="Thông báo thông tin đăng ký đã được xét duyệt. ". $data['tendn']." - ".
                        $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['username'];
                    guitinjson($phone,$content);

                    $maildn = $model->email;
                    $tendn = $model->tendn;
                    $mailql = $tencqcq->emailqt;
                    $tenql = $tencqcq->tendv;

                    Mail::send('mail.successregister', $data, function ($message) use ($maildn,$tendn,$mailql,$tenql) {
                        $message->to($maildn,$tendn)
                            ->to($mailql,$tenql)
                            ->subject('Thông báo thông tin đăng ký đã được xét duyệt');
                        $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                    });
                    $delete = Register::findOrFail($id)->delete();
                    return redirect('users/register?&phanloai'.$pl);
                }

            }else{
                return view('errors.noperm');
            }

        } else
            return view('errors.notlogin');
    }


    public function registerdelete(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['iddelete'];
            $model = Register::findOrFail($id);
            $pl = $model->pl;
            $model->delete();

            return redirect('users/register?&phanloai='.$pl);
        } else
            return view('errors.notlogin');
    }

    public function prints($pl){
        if (Session::has('admin')) {
            if($pl == 'DVLT')
                $dv = 'LƯU TRÚ';
            elseif($pl == 'dich_vu_van_tai')
                $dv = 'VẬN TẢI';
            elseif($pl == 'DVGS')
                $dv = 'GIÁ SỮA';
            elseif($pl == 'DVTACN')
                $dv = 'THỨC ĂN CHĂN NUÔI';
            $model = Users::where('level',$pl)
                ->get();
            return view('reports/user/users')
                ->with('model',$model)
                ->with('dv',$dv)
                ->with('pageTitle','Danh sách tài khoản truy cập');
        } else
            return view('errors.notlogin');
    }

    public function registeredit($id){
        if (Session::has('admin')) {
            $model = Register::findOrFail($id);
            if ($model->pl == 'DVLT') {
                $cqcq = DmDvQl::where('plql','TC')
                    ->get();
                return view('system.users.register.editdvlt')
                    ->with('model', $model)
                    ->with('cqcq',$cqcq)
                    ->with('pageTitle', 'Chỉnh sửa thông tin đăng ký tài khoản dịch vụ lưu trú');
            } elseif ($model->pl == 'DVVT') {
                $cqcq = DmDvQl::where('plql','VT')
                    ->get();
                return view('system.users.register.editdvvt')
                    ->with('model', $model)
                    ->with('cqcq',$cqcq)
                    ->with('pageTitle', 'Chỉnh sửa thông tin đăng ký tài khoản dịch vụ vận tải');
            }elseif($model->pl == 'DVGS'){
                $cqcq = DmDvQl::where('plql','CT')
                    ->get();
                return view('system.users.register.editdvgs')
                    ->with('model', $model)
                    ->with('cqcq',$cqcq)
                    ->with('pageTitle', 'Chỉnh sửa thông tin đăng ký tài khoản dịch vụ sữa');
            }elseif($model->pl == 'DVTACN'){
                $cqcq = DmDvQl::where('plql','TC')
                    ->get();
                return view('system.users.register.editdvtacn')
                    ->with('model', $model)
                    ->with('cqcq',$cqcq)
                    ->with('pageTitle', 'Chỉnh sửa thông tin đăng ký tài khoản thức ăn chăn nuôi');
            }
        } else {
            return view('errors.notlogin');
        }
    }

    public function registerdvltupdate($id, Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Register::findOrFail($id);
            $model->tendn = $input['tendn'];
            $model->masothue = $input['masothue'];
            $model->diachi= $input['diachidn'];
            $model->tel  = $input['teldn'];
            $model->fax = $input['faxdn'];
            $model->email = $input['email'];
            $model->noidknopthue = $input['noidknopthue'];
            $model->giayphepkd = $input['giayphepkd'];
            $model->tailieu = $input['tailieu'];
            $model->username = $input['username'];
            $model->cqcq = $input['cqcq'];
            $model->chucdanh = $input['chucdanh'];
            $model->nguoiky = $input['nguoiky'];
            $model->diadanh = $input['diadanh'];
            $model->save();
            return redirect('users/register?&phanloai='.$model->pl);
        } else {
            return view('errors.notlogin');
        }
    }

    public function registerdvvtupdate($id,Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Register::findOrFail($id);
            $model->tendn = $input['tendn'];
            $model->masothue = $input['masothue'];
            $model->diachi = $input['diachidn'];
            $model->tel  = $input['teldn'];
            $model->fax = $input['faxdn'];
            $model->email = $input['emaildn'];
            $model->noidknopthue = $input['noidknopthue'];
            $model->giayphepkd = $input['giayphepkd'];
            $model->tailieu = $input['tailieu'];
            $model->username = $input['username'];
            $model->pl = 'DVVT';

            $input['roles'] = isset($input['roles']) ? $input['roles'] : null;
            $model->setting = json_encode($input['roles']);
            $x = $input['roles'];
            $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
            $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
            $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
            $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;
            $model->cqcq = $input['cqcq'];
            $model->save();

            return redirect('users/register?&phanloai='.$model->pl);
        } else {
            return view('errors.notlogin');
        }
    }

    public function registerdvgsupdate($id, Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Register::findOrFail($id);
            $model->update($input);
            return redirect('users/register?&phanloai='.$model->pl);
        } else {
            return view('errors.notlogin');
        }
    }

    public function registerdvtacnupdate($id, Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = Register::findOrFail($id);
            $model->update($input);
            return redirect('users/register?&phanloai='.$model->pl);
        } else {
            return view('errors.notlogin');
        }
    }

    public function tralaidktk(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $id = $input['idtralai'];
            $model = Register::findOrFail($id);

            if ($input['lydo'] != '') {
                $model->lydo = $input['lydo'];
                $model->trangthai = 'Bị trả lại';
                if($model->save()){
                    $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                    $data=[];
                    $data['tendn'] = $model->tendn;
                    $data['tg'] = Carbon::now()->toDateTimeString();
                    $data['tencqcq'] = $tencqcq->tendv;
                    $data['masothue'] = $model->masothue;
                    $data['user'] = $model->username;
                    $data['madk'] = $model->ma;
                    $data['lydo'] = $input['lydo'];

                    $phone = $model->teldn;
                    $content ="Thông báo trả lại thông tin đăng ký. ". $data['tendn']." - ".
                        $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['user'];
                    guitinjson($phone,$content);

                    $a = $model->email;
                    $b  =  $model->tendn;
                    Mail::send('mail.replyregister',$data, function ($message) use($a,$b) {
                        $message->to($a,$b )
                            ->subject('Thông báo trả lại thông tin đăng ký ');
                        $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                    });
                }
            }

            return redirect('users/register?&phanloai='.$model->pl);
        } else {
            return view('errors.notlogin');
        }
    }

    public function settinguser(){
        if (Session::has('admin')) {
            return view('system.users.usersetting')
                ->with('pageTitle', 'Thông tin tài khoản');

        } else
            return view('errors.notlogin');

    }

    public function settinguserw(Request $request){
        $update = $request->all();

        $username = session('admin')->username;

        $password = session('admin')->password;

        $currentPassword = $update['current-password'];

        if (md5($currentPassword) == $password) {
            $ttuser = Users::where('username', $username)->first();
            $ttuser->email = $update['emailxt'];
            $ttuser->save();
            Session::flush();
            return redirect('/login');
        } else {
            dd('Mật khẩu cũ không đúng???');
        }
    }
}
