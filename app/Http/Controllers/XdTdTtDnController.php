<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DnDvGs;
use App\DnDvLt;
use App\DnTaCn;
use App\DonViDvVt;
use App\TtDn;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class XdTdTtDnController extends Controller
{
    public function index(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
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
            if(session('admin')->level == 'T' || session('admin')->level=='H') {
                    if (session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa') {
                        $model = TtDn::where('pl',$inputs['phanloai'] )
                            ->where('trangthai','Chờ duyệt')
                            ->get();
                    } else {
                        $model = TtDn::where('pl', $inputs['phanloai'])
                            ->where('cqcq', session('admin')->cqcq)
                            ->where('trangthai','Chờ duyệt')
                            ->get();
                    }
                return view('system.xdtdttdn.index')
                    ->with('model', $model)
                    ->with('phanloai', $inputs['phanloai'])
                    ->with('pageTitle', 'Xét duyệt thay đổi thông tin doanh nghiệp');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');

    }

    public function show($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H') {
                $modeltttd = TtDn::findOrFail($id);
                    $setting = $modeltttd->setting;
                    if ($modeltttd->pl == 'DVLT') {
                        $model = DnDvLt::where('masothue', $modeltttd->masothue)
                            ->first();
                        return view('system.xdtdttdn.dvlt.show')
                            ->with('model', $model)
                            ->with('modeltttd', $modeltttd)
                            ->with('pageTitle', 'Thông tin thay đổi doanh nghiệp');
                    } elseif($modeltttd->pl == 'DVVT') {
                        $model = DonViDvVt::where('masothue', $modeltttd->masothue)
                            ->first();
                        $settingtttd = $modeltttd->setting;
                        return view('system.xdtdttdn.dvvt.show')
                            ->with('model', $model)
                            ->with('modeltttd', $modeltttd)
                            ->with('setting', json_decode($setting))
                            ->with('settingtttd', json_decode($settingtttd))
                            ->with('pageTitle', 'Thông tin thay đổi doanh nghiệp');
                    }elseif($modeltttd->pl == 'DVGS'){
                        $model = DnDvGs::where('masothue', $modeltttd->masothue)
                            ->first();
                        return view('system.xdtdttdn.dvgs.show')
                            ->with('model', $model)
                            ->with('modeltttd', $modeltttd)
                            ->with('pageTitle', 'Thông tin thay đổi doanh nghiệp');
                    }elseif($modeltttd->pl == 'DVTACN'){
                        $model = DnTaCn::where('masothue', $modeltttd->masothue)
                            ->first();
                        return view('system.xdtdttdn.dvtacn.show')
                            ->with('model', $model)
                            ->with('modeltttd', $modeltttd)
                            ->with('pageTitle', 'Thông tin thay đổi doanh nghiệp');
                    }
            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');


    }

    public function duyet($id){
        if (Session::has('admin')) {
            $modeltttd = TtDn::findOrFail($id);
            if($modeltttd->pl == 'DVLT') {
                $model = DnDvLt::where('masothue', $modeltttd->masothue)
                    ->first();
                $model->tendn = $modeltttd->tendn;
                $model->diachidn = $modeltttd->diachi;
                $model->teldn = $modeltttd->tel;
                $model->faxdn = $modeltttd->fax;
                $model->email = $modeltttd->email;
                $model->noidknopthue = $modeltttd->noidknopthue;
                $model->chucdanhky = $modeltttd->chucdanhky;
                $model->nguoiky = $modeltttd->nguoiky;
                $model->diadanh = $modeltttd->diadanh;
                $model->tailieu = $modeltttd->tailieu;
                $model->giayphepkd = $modeltttd->giayphepkd;
            }elseif($modeltttd->pl == 'DVVT'){
                $model = DonViDvVt::where('masothue', $modeltttd->masothue)
                    ->first();
                $model->tendonvi = $modeltttd->tendn;
                $model->diachi =  $modeltttd->diachi;
                $model->dienthoai = $modeltttd->tel;
                $model->giayphepkd = $modeltttd->giayphepkd;
                $model->fax= $modeltttd->fax;
                $model->email = '';
                $model->diadanh = $modeltttd->diadanh;
                $model->chucdanh = $modeltttd->chucdanhky;
                $model->nguoiky = $modeltttd->nguoiky;
                $model->dknopthue = $modeltttd->noidknopthue;
                $model->setting = $modeltttd->setting;
                $model->dvxk = $modeltttd->dvxk;
                $model->dvxb = $modeltttd->dvxb;
                $model->dvxtx = $modeltttd->dvxtx;
                $model->dvk = $modeltttd->dvk;
                $model->toado = $modeltttd->toado;
                $model->tailieu = $modeltttd->tailieu;
                $model->link = $modeltttd->link;
            }elseif($modeltttd->pl == 'DVGS'){
                $model = DnDvGs::where('masothue', $modeltttd->masothue)
                    ->first();
                $model->tendn = $modeltttd->tendn;
                $model->diachidn = $modeltttd->diachi;
                $model->teldn = $modeltttd->tel;
                $model->faxdn = $modeltttd->fax;
                $model->email = $modeltttd->email;
                $model->noidknopthue = $modeltttd->noidknopthue;
                $model->chucdanhky = $modeltttd->chucdanhky;
                $model->nguoiky = $modeltttd->nguoiky;
                $model->diadanh = $modeltttd->diadanh;
                $model->tailieu = $modeltttd->tailieu;
                $model->giayphepkd = $modeltttd->giayphepkd;
            }elseif($modeltttd->pl == 'DVTACN'){
                $model = DnTaCn::where('masothue', $modeltttd->masothue)
                    ->first();
                $model->tendn = $modeltttd->tendn;
                $model->diachidn = $modeltttd->diachi;
                $model->teldn = $modeltttd->tel;
                $model->faxdn = $modeltttd->fax;
                $model->email = $modeltttd->email;
                $model->noidknopthue = $modeltttd->noidknopthue;
                $model->chucdanhky = $modeltttd->chucdanhky;
                $model->nguoiky = $modeltttd->nguoiky;
                $model->diadanh = $modeltttd->diadanh;
                $model->tailieu = $modeltttd->tailieu;
                $model->giayphepkd = $modeltttd->giayphepkd;
            }
            if($model->save()){
                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $data=[];
                $data['tendn'] = $model->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $a = $model->email;
                $b = $model->tendn;
                Mail::send('mail.successchangettdn',$data, function ($message) use($a,$b) {
                    $message->to($a,$b )
                        ->subject('Thông báo duyệt thay đổi thông tin doanh nghiệp');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
            };
            $pl = $modeltttd->pl;
            $modeltttd->delete();
            return redirect('xetduyet_thaydoi_ttdoanhnghiep?&phanloai='.$pl);

        }else
            return view('errors.notlogin');

    }

    public function tralai(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = TtDn::where('id',$input['idtralai'])->first();
            $model->lydo = $input['lydo'];
            $model->trangthai = 'Bị trả lại';
            if($model->save()){
                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();

                if($model->pl == 'DVLT')
                    $dn = DnDvLt::where('masothue',$model->masothue)->first();
                elseif($model->pl == 'DVVT')
                    $dn = DonViDvVt::where('masothue',$model->masothue)->first();
                elseif($model->pl == 'DVGS')
                    $dn = DnDvGs::where('masothue',$model->masothue)->first();
                elseif($model->pl == 'DVTACN')
                    $dn = DnTaCn::where('masothue',$model->masothue)->first();

                $data=[];
                $data['tendn'] = $dn->tendn;
                $data['tg'] = Carbon::now()->toDateTimeString();
                $data['tencqcq'] = $tencqcq->tendv;
                $data['lydo'] = $input['lydo'];
                $a = $dn->email;
                $b = $dn->tendn;
                Mail::send('mail.replychangettdn',$data, function ($message) use($a,$b) {
                    $message->to($a,$b )
                        ->subject('Thông báo không xét duyệt thay đổi thông tin doanh nghiệp');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
            };
            return redirect('xetduyet_thaydoi_ttdoanhnghiep?&phanloai='.$model->pl);

        }else
            return view('errors.notlogin');
    }

    public function del(Request $request){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = TtDn::where('id',$input['iddelete'])->first();
            $model->delete();
            return redirect('xetduyet_thaydoi_ttdoanhnghiep');
        }else
            return view('errors.notlogin');
    }

}
