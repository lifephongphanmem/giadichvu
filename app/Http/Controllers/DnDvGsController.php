<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnDvGs;
use App\TtDn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DnDvGsController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = DnDvGs::all();
            return view('system.dndvgs.index')
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp sản phẩm sữa');
        } else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = DnDvGs::findOrFail($id);
            $modelpb = DmDvQl::where('plql','CT')
                ->get();
            return view('system.dndvgs.edit')
                ->with('model',$model)
                ->with('modelpb',$modelpb)
                ->with('pageTitle','Doanh nghiệp cung cấp sản phẩm sữa chỉnh sửa');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request,$id){
        if (Session::has('admin')) {
            $model = DnDvGs::findOrFail($id);
            $inputs = $request->all();
            $model->update($inputs);
            return redirect('dn_dichvu_giasua');
        } else
            return view('errors.notlogin');
    }

    public function show(){
        if (Session::has('admin')) {
            $model = DnDvGs::all();
            $dv = 'SẢN PHẨM SỮA';
            $pl = 'DVGS';
            return view('reports.dn.doanhnghiep')
                ->with('dv',$dv)
                ->with('pl',$pl)
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp sản phẩm sữa');
        } else
            return view('errors.notlogin');
    }

    public function ttdn(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVGS') {
                    $model = DnDvGs::where('masothue', session('admin')->mahuyen)
                        ->first();
                    $modeltttd = TtDn::where('masothue', session('admin')->mahuyen)
                        ->where('pl','DVGS')
                        ->first();
                    $model_cqcq = DmDvQl::where('maqhns', session('admin')->cqcq)->first();
                    if(count($model_cqcq)>0){
                        $model->tencqcq=$model_cqcq->tendv;
                        if(count($modeltttd)>0)
                            $modeltttd->tencqcq = $model_cqcq->tendv;
                    }
                    return view('manage.dvgs.ttdn.index')
                        ->with('model', $model)
                        ->with('modeltttd', $modeltttd)
                        ->with('pageTitle', 'Danh sách doanh nghiệp cung cấp mặt hàng sữa');
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function ttdnedit($id){
        if (Session::has('admin')) {
            if( session('admin')->level == 'DVGS') {
                //Kiểm tra thông tin có thuộc quyền quản lý hay k
                $model = DnDvGs::findOrFail($id);
                if(session('admin')->mahuyen == $model->masothue) {
                    $ttcqcq = DmDvQl::where('plql', 'CT')
                        ->get();

                    return view('manage.dvgs.ttdn.edit')
                        ->with('model', $model)
                        ->with('ttcqcq', $ttcqcq)
                        ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp mặt hàng sữa chỉnh sửa');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function ttdnupdate(Request $request,$id){
        if (Session::has('admin')) {
            $check = TtDn::where('masothue',session('admin')->mahuyen)
                ->where('pl','DVGS')
                ->delete();
            $update = $request->all();
            $model = new TtDn();
            $model->masothue = $update['masothue'];
            $model->tendn = $update['tendn'];
            $model->diachi = $update['diachidn'];
            $model->tel = $update['teldn'];
            $model->fax = $update['faxdn'];
            $model->noidknopthue = $update['noidknopthue'];
            $model->chucdanhky = $update['chucdanhky'];
            $model->nguoiky = $update['nguoiky'];
            $model->diadanh = $update['diadanh'];
            $model->giayphepkd = $update['giayphepkd'];
            $model->tailieu = $update['tailieu'];
            $model->email = $update['email'];
            $model->setting = '';
            $model->dvxk = 0;
            $model->dvxb = 0;
            $model->dvxtx = 0;
            $model->dvk = 0;
            $model->pl = 'DVGS';
            $model->trangthai = 'Chờ chuyển';
            $model->cqcq = $update['cqcq'];
            $model->save();

            return redirect('ttdn_dich_vu_gia_sua');
        }else
            return view('errors.notlogin');
    }

    public function ttdnchinhsua($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'DVGS') {
                //Kiểm tra thông tin có thuộc quyền quản lý hay k
                $model = TtDn::findOrFail($id);
                if(session('admin')->mahuyen == $model->masothue) {
                    $ttcqcq = DmDvQl::where('plql', 'CT')
                        ->get();

                    return view('manage.dvgs.ttdn.editdf')
                        ->with('model', $model)
                        ->with('ttcqcq', $ttcqcq)
                        ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp mặt hàng sữa chỉnh sửa');
                }else{
                    return view('errors.noperm');
                }
            }else {
                return view('errors.perm');
            }


        }else
            return view('errors.notlogin');
    }

    public function ttdncapnhat($id,Request $request){
        if (Session::has('admin')) {
            $input =$request->all();
            $model = TtDn::findOrFail($id);
            $model->tendn = $input['tendn'];
            $model->diachi = $input['diachi'];
            $model->tel = $input['tel'];
            $model->fax = $input['fax'];
            $model->email = $input['email'];
            $model->noidknopthue = $input['noidknopthue'];
            $model->chucdanhky = $input['chucdanhky'];
            $model->nguoiky = $input['nguoiky'];
            $model->diadanh = $input['diadanh'];
            $model->giayphepkd = $input['giayphepkd'];
            $model->tailieu = $input['tailieu'];
            $model->setting = '';
            $model->dvxk = 0;
            $model->dvxb = 0;
            $model->dvxtx = 0;
            $model->dvk = 0;
            $model->pl = 'DVGS';
            $model->trangthai = 'Chờ chuyển';
            $model->save();

            return redirect('ttdn_dich_vu_gia_sua');
        }else
            return view('errors.notlogin');
    }

    public function ttdnchuyen($id){
        if (Session::has('admin')) {
            $model = TtDn::find($id);
            $model->trangthai = 'Chờ duyệt';
            if($model->save()) {
                $dn = DnDvGs::where('masothue', $model->masothue)->first();
                $tencqcq = DmDvQl::where('maqhns', $dn->cqcq)->first();
                $data = [];
                $data['tendn'] = $dn->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $maildn = $dn->email;
                $tendn = $dn->tendn;
                $mailql = $tencqcq->emailqt;
                $tenql = $tencqcq->tendv;
                Mail::send('mail.changettdn', $data, function ($message) use ($maildn, $tendn, $mailql, $tenql) {
                    $message->to($maildn, $tendn)
                        ->to($mailql, $tenql)
                        ->subject('Thông báo thông tin thay đổi thông tin doanh nghiệp');
                    $message->from('qlgiakhanhhoa@gmail.com', 'Phần mềm CSDL giá');
                });
            }
            return redirect('ttdn_dich_vu_gia_sua');
        }else
            return view('errors.notlogin');
    }
}
