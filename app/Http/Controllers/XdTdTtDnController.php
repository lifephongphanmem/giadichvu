<?php

namespace App\Http\Controllers;

use App\DnDvLt;
use App\DonViDvVt;
use App\TtDn;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class XdTdTtDnController extends Controller
{
    public function index($pl){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')=='H') {
                if ($pl == 'dich_vu_luu_tru') {
                    if (session('admin')->sadmin == 'ssa') {
                        $model = TtDn::where('pl', 'DVLT')
                            ->get();
                    } else {
                        $model = TtDn::where('pl', 'DVLT')
                            ->where('cqcq', session('admin')->cqcq)
                            ->get();
                    }

                }else {
                    if(session('admin')->sadmin == 'ssa'){
                        $model = TtDn::where('pl', 'DVVT')
                            ->get();
                    }else{
                        $model = TtDn::where('pl','DVVT')
                            ->where('cqcq',session('admin')->cqcq)
                            ->get();
                    }
                }
                return view('system.xdtdttdn.index')
                    ->with('model', $model)
                    ->with('pl', $pl)
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
                    $setting = $model->setting;
                    if ($modeltttd->pl == 'DVLT') {
                        $model = DnDvLt::where('masothue', $modeltttd->masothue)
                            ->first();
                        return view('system.xdtdttdn.dvlt.show')
                            ->with('model', $model)
                            ->with('modeltttd', $modeltttd)
                            ->with('pageTitle', 'Thông tin thay đổi doanh nghiệp');
                    } else {
                        $model = DonViDvVt::where('masothue', $modeltttd->masothue)
                            ->first();
                    $settingtttd = $modeltttd->setting;
                    return view('system.xdtdttdn.dvvt.show')
                        ->with('model', $model)
                        ->with('modeltttd', $modeltttd)
                        ->with('setting', json_decode($setting))
                        ->with('settingtttd', json_decode($settingtttd))
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
                $model->diachidn = $modeltttd->diachi;
                $model->teldn = $modeltttd->tel;
                $model->faxdn = $modeltttd->fax;
                $model->noidknopthue = $modeltttd->noidknopthue;
                $model->chucdanhky = $modeltttd->chucdanhky;
                $model->nguoiky = $modeltttd->nguoiky;
                $model->diadanh = $modeltttd->diadanh;
                $model->tailieu = $modeltttd->tailieu;
                $model->giayphepkd = $modeltttd->giayphepkd;
                $model->save();
                $modeltttd->delete();
                return redirect('xetduyet_thaydoi_thongtindoanhnghiep/phanloai=dich_vu_luu_tru');
            }else{
                $model = DonViDvVt::where('masothue', $modeltttd->masothue)
                    ->first();
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
                $model->save();
                $modeltttd->delete();
                return redirect('xetduyet_thaydoi_thongtindoanhnghiep/phanloai=dich_vu_van_tai');
            }
        }else
            return view('errors.notlogin');

    }

}
