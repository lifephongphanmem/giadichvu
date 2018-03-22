<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnTaCn;
use App\TtDn;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class DnTaCnController extends Controller
{
    public function index(){
        if (Session::has('admin')) {
            $model = DnTaCn::all();
            return view('system.dntacn.index')
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp thức ăn chăn nuôi');
        } else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            $model = DnTaCn::findOrFail($id);
            $modelql = DmDvQl::where('plql','TC')
                ->get();
            return view('system.dntacn.edit')
                ->with('model',$model)
                ->with('modelql',$modelql)
                ->with('pageTitle','Chỉnh sửa thông tin doanh nghiệp cung cấp thức ăn chăn nuôi');
        } else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = DnTaCn::findOrFail($id);
            $model->update($inputs);
            return redirect('dn_thuc_an_chan_nuoi');
        } else
            return view('errors.notlogin');
    }

    public function ttdn(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVTACN') {
                $model = DnTaCn::where('masothue', session('admin')->mahuyen)
                    ->first();
                $modeltttd = TtDn::where('masothue', session('admin')->mahuyen)
                    ->where('pl','DVTACN')
                    ->first();
                $model_cqcq = DmDvQl::where('maqhns', session('admin')->cqcq)->first();
                if(count($model_cqcq)>0){
                    $model->tencqcq=$model_cqcq->tendv;
                    if(count($modeltttd)>0)
                        $modeltttd->tencqcq = $model_cqcq->tendv;
                }
                return view('manage.dvtacn.ttdn.index')
                    ->with('model', $model)
                    ->with('modeltttd', $modeltttd)
                    ->with('pageTitle', 'Danh sách doanh nghiệp thức ăn chăn nuôi');
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function ttdnedit($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'DVTACN') {
                //Kiểm tra thông tin có thuộc quyền quản lý hay k
                $model = DnTaCn::findOrFail($id);
                if(session('admin')->mahuyen == $model->masothue) {
                $ttcqcq = DmDvQl::where('plql', 'TC')
                    ->get();
                return view('manage.dvtacn.ttdn.edit')
                    ->with('model', $model)
                    ->with('ttcqcq', $ttcqcq)
                    ->with('pageTitle', 'Thông tin doanh nghiệp thức ăn chăn nuôi chỉnh sửa');
                }else
                    return view('errors.noperm');
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
            $model->pl = 'DVTACN';
            $model->trangthai = 'Chờ chuyển';
            $model->cqcq = $update['cqcq'];
            $model->save();

            return redirect('ttdn_thuc_an_chan_nuoi');
        }else
            return view('errors.notlogin');
    }

    public function ttdnchinhsua($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'DVTACN') {
                //Kiểm tra thông tin có thuộc quyền quản lý hay k
                $model = TtDn::findOrFail($id);
                if(session('admin')->mahuyen == $model->masothue) {
                    $ttcqcq = DmDvQl::where('plql', 'CT')
                        ->get();
                    return view('manage.dvtacn.ttdn.editdf')
                        ->with('model', $model)
                        ->with('ttcqcq', $ttcqcq)
                        ->with('pageTitle', 'Thông tin doanh nghiệp thức ăn chăn nuôi chỉnh sửa');
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
            $model->pl = 'DVTACN';
            $model->save();

            return redirect('ttdn_thuc_an_chan_nuoi');
        }else
            return view('errors.notlogin');
    }

    public function ttdnchuyen($id){
        if (Session::has('admin')) {
            $model = TtDn::find($id);
            $model->trangthai = 'Chờ duyệt';
            if($model->save()) {
                $dn = DnTaCn::where('masothue', $model->masothue)->first();
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
            return redirect('ttdn_thuc_an_chan_nuoi');
        }else
            return view('errors.notlogin');
    }

}
