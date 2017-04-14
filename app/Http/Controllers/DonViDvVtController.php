<?php

namespace App\Http\Controllers;

use App\DmDvQl;
use App\DonViDvVt;
use App\TtDn;
use App\Users;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class DonViDvVtController extends Controller
{
    // <editor-fold defaultstate="collapsed" desc="--Thông tin doanh nghiệp trong menu hệ thống--">
    public function index(){
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt') {
                if (session('admin')->sadmin == 'ssa') {
                    $model = DonViDvVt::where('trangthai', 'Kích hoạt')
                        ->get();
                } else {
                    $model = DonViDvVt:: where('trangthai', 'Kích hoạt')
                        ->where('cqcq', session('admin')->cqcq)
                        ->get();
                }
            }else{
                return view('errors.perm');
            }
            return view('system.dndvvt.index')
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp dịch vụ vận tải');
        }else
            return view('errors.notlogin');
    }

    public function create(){
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt') {
                $modelpb = DmDvQl::where('plql','VT')
                    ->get();
                return view('system.dndvvt.create')
                    ->with('modelpb',$modelpb)
                    ->with('pageTitle','Thêm mới doanh nghiệp cung cấp dịch vụ vận tải');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $insert = $request->all();
            $model = new DonViDvVt();
            $model->tendonvi = $insert['tendonvi'];
            $model->masothue = $insert['masothue'];
            $model->diachi = $insert['diachi'];
            $model->dienthoai = $insert['dienthoai'];
            $model->fax = $insert['fax'];
            $model->dknopthue= $insert['dknopthue'];
            $model->giayphepkd = $insert['giayphepkd'];
            $model->chucdanh = $insert['chucdanh'];
            $model->nguoiky = $insert['nguoiky'];
            $model->diadanh = $insert['diadanh'];
            $model->tailieu = $insert['tailieu'];

            $insert['roles'] = isset($insert['roles']) ? $insert['roles'] : null;
            $model->setting = json_encode($insert['roles']);
            $x = $insert['roles'];
            $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
            $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
            $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
            $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;

            $model->toado = $insert['diachi']!= '' ? getAddMap($insert['diachi']) : '';
            //$model->tailieu =$insert['tailieu'];
            $model->trangthai = 'Kích hoạt';
            $model->email = '';
            $model->cqcq = $insert['cqcq'];

            if($model->save()){
                $modeluser = new Users();
                $modeluser->name = $insert['tendonvi'];
                $modeluser->phone = $insert['dienthoai'];
                $modeluser->username = $insert['username'];
                $modeluser->password = md5($insert['password']);
                $modeluser->status = 'Kích hoạt';
                $modeluser->level = 'DVVT';
                $modeluser->mahuyen = $insert['masothue'];
                $modeluser->cqcq = $insert['cqcq'];
                $modeluser->save();
            }
            return redirect('dn_dichvu_vantai');
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt') {
                //Kiem tra xem id co thuocj quan ly hay k
                $model = DonViDvVt::findOrFail($id);
                if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq){
                    $setting = $model->setting;
                    $modelpb = DmDvQl::where('plql', 'VT')
                        ->get();
                    //dd($model->cqcq . '-'. $modelpb);
                    return view('system.dndvvt.edit')
                        ->with('model', $model)
                        ->with('setting', json_decode($setting))
                        ->with('modelpb', $modelpb)
                        ->with('pageTitle', 'Danh sách doanh nghiệp cung cấp dịch vụ vận tải');
                }else{
                    return view('errors.noperm');
                }

            }else{
                return view('errors.perm');
            }

        }else
            return view('errors.notlogin');
    }

    public function update(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = DonViDvVt::findOrFail($id);
            if(session('admin')->sadmin == 'ssa' || $model->cqcq == session('admin')->cqcq) {
                $model->tendonvi = $input['tendonvi'];
                $model->masothue = $input['masothue'];
                $model->diachi = $input['diachi'];
                $model->dienthoai = $input['dienthoai'];
                $model->fax = $input['fax'];
                $model->dknopthue = $input['dknopthue'];
                $model->giayphepkd = $input['giayphepkd'];
                $model->chucdanh = $input['chucdanh'];
                $model->nguoiky = $input['nguoiky'];
                $model->diadanh = $input['diadanh'];
                $model->tailieu = $input['tailieu'];

                $input['roles'] = isset($input['roles']) ? $input['roles'] : null;
                $model->setting = json_encode($input['roles']);

                $model->toado = getAddMap($input['diachi']);
                //$model->tailieu =$insert['tailieu'];
                $model->email = '';
                $model->cqcq = $input['cqcq'];
                $model->save();
                return redirect('dn_dichvu_vantai');
            }else{
                return view('errors.noperm');
            }

        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = DonViDvVt::findOrFail($id);
            $model->delete();

            return redirect('dn_dichvu_vantai');

        }else
            return view('errors.notlogin');
    }
    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="--Thông tin doanh nghiệp trong menu nhập liệu--">
    public function TtDnIndex(){
        if (Session::has('admin')) {
            if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                if (session('admin')->sadmin == 'ssa') {
                    $model = DonViDvVt::all();

                } else {
                    $model = DonViDvVt::where('cqcq', session('admin')->cqcq)
                        ->get();

                }

                return view('manage.dvvt.ttdn.ql.index')
                    ->with('model', $model)
                    ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp dịch vụ vận tải');

            } else {

                $model = DonViDvVt::where('masothue', session('admin')->mahuyen)
                    ->first();
                $setting = $model->setting;

                $modeltttd = TtDn::where('masothue', session('admin')->mahuyen)
                    ->first();

                if (isset($modeltttd))
                    $settingtttd = $modeltttd->setting;
                else
                    $settingtttd = '';
                return view('manage.dvvt.ttdn.index')
                    ->with('model', $model)
                    ->with('setting', json_decode($setting))
                    ->with('modeltttd', $modeltttd)
                    ->with('settingtttd', json_decode($settingtttd))
                    ->with('pageTitle', 'Thông tin doanh nghiệp cung cấp dịch vụ vận tải');
            }

        }else
            return view('errors.notlogin');
    }

    public function TtDnedit($id)
    {
        if (Session::has('admin')) {
            $model = DonViDvVt::findOrFail($id);
            $setting = $model->setting;
            $ttcqcq = DmDvQl::where('plql','VT')
                ->get();
            return view('manage.dvvt.ttdn.edit')
                ->with('model',$model)
                ->with('setting',json_decode($setting))
                ->with('ttcqcq',$ttcqcq)
                ->with('pageTitle','Chỉnh sửa thông tin doanh nghiệp cung cấp dịch vụ vận tải');
        }else
            return view('errors.notlogin');
    }

    public function ttdnchinhsua($id)
    {
        if (Session::has('admin')) {
            $model = TtDn::findOrFail($id);
            $setting = $model->setting;
            $ttcqcq = DmDvQl::where('plql','VT')
                ->get();
            return view('manage.dvvt.ttdn.editdf')
                ->with('model',$model)
                ->with('setting',json_decode($setting))
                ->with('ttcqcq',$ttcqcq)
                ->with('pageTitle','Chỉnh sửa thông tin doanh nghiệp cung cấp dịch vụ vận tải');
        }else
            return view('errors.notlogin');
    }

    public function TtDnupdate(Request $request, $id)
    {
        if (Session::has('admin')) {
            $upd = $request->all();
            $check = TtDn::where('masothue',session('admin')->mahuyen)
                ->delete();
            //$model = DonViDvVt::findOrFail($id);
            if(session('admin')->level == 'T' || session('admin')->level == 'H'){
                $model = DonViDvVt::findOrFail($id);
                $model->tendonvi = $upd['tendonvi'];
                $model->masothue = $upd['masothue'];
                $model->diachi = $upd['diachi'];
                $model->dienthoai = $upd['dienthoai'];
                $model->fax = $upd['fax'];
                $model->dknopthue= $upd['dknopthue'];
                $model->giayphepkd = $upd['giayphepkd'];
                $model->chucdanh = $upd['chucdanh'];
                $model->nguoiky = $upd['nguoiky'];
                $model->diadanh = $upd['diadanh'];
                $model->tailieu = $upd['tailieu'];

                $insert['roles'] = isset($upd['roles']) ? $upd['roles'] : null;
                $model->setting = json_encode($upd['roles']);
                $x = $insert['roles'];
                $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
                $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
                $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
                $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;

                $model->toado = $upd['diachi']!= '' ? getAddMap($upd['diachi']) : '';
                //$model->tailieu =$insert['tailieu'];
                $model->trangthai = 'Kích hoạt';
                $model->email = '';
                $model->cqcq = $upd['cqcq'];

                $model->save();
            }else {
                $model = new TtDn();
                $model->tendn = $upd['tendonvi'];
                $model->masothue = $upd['masothue'];
                $model->diachi = $upd['diachi'];
                $model->tel = $upd['dienthoai'];
                $model->fax = $upd['fax'];
                $model->noidknopthue = $upd['dknopthue'];
                $model->giayphepkd = $upd['giayphepkd'];
                $model->chucdanhky = $upd['chucdanh'];
                $model->nguoiky = $upd['nguoiky'];
                $model->diadanh = $upd['diadanh'];
                $model->tailieu = $upd['tailieu'];
                $input['roles'] = isset($upd['roles']) ? $upd['roles'] : null;
                $model->setting = json_encode($upd['roles']);
                $model->toado = getAddMap($upd['diachi']);
                $model->link = $upd['link'];
                $model->pl = 'DVVT';
                $model->email = '';
                $x = $input['roles'];
                $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
                $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
                $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
                $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;
                $model->cqcq = $upd['cqcq'];
                $model->trangthai = 'Chờ duyệt';
                $model->save();
            }
            return redirect('dich_vu_van_tai/thong_tin_don_vi');
        } else
            return view('errors.notlogin');
    }
    // </editor-fold>

    public function ttdncapnhat($id,Request $request){
        if (Session::has('admin')) {
                $upd = $request->all();
                $model = TtDn::findOrFail($id);
                $model->tendn = $upd['tendn'];
                $model->masothue = $upd['masothue'];
                $model->diachi = $upd['diachi'];
                $model->tel = $upd['tel'];
                $model->fax = $upd['fax'];
                $model->noidknopthue = $upd['noidknopthue'];
                $model->giayphepkd = $upd['giayphepkd'];
                $model->chucdanhky = $upd['chucdanhky'];
                $model->nguoiky = $upd['nguoiky'];
                $model->diadanh = $upd['diadanh'];
                $model->tailieu = $upd['tailieu'];
                $input['roles'] = isset($upd['roles']) ? $upd['roles'] : null;
                $model->setting = json_encode($upd['roles']);
                $model->toado = getAddMap($upd['diachi']);
                $model->link = $upd['link'];
                $model->pl = 'DVVT';
                $model->email = '';
                $x = $input['roles'];
                $model->dvxk = isset($x['dvvt']['vtxk']) ? 1 : 0;
                $model->dvxb = isset($x['dvvt']['vtxb']) ? 1 : 0;
                $model->dvxtx = isset($x['dvvt']['vtxtx']) ? 1 : 0;
                $model->dvk = isset($x['dvvt']['vtch']) ? 1 : 0;
                $model->cqcq = $upd['cqcq'];
                $model->trangthai = 'Chờ duyệt';
                $model->save();

            return redirect('dich_vu_van_tai/thong_tin_don_vi');
        } else
            return view('errors.notlogin');
    }

    public function prints(){
        if (Session::has('admin')) {
            $model = DonViDvVt::all();
            $dv = 'VẬN TẢI';
            $pl = 'DVVT';
            return view('reports.dn.doanhnghiep')
                ->with('dv',$dv)
                ->with('pl',$pl)
                ->with('model',$model)
                ->with('pageTitle','Danh sách doanh nghiệp cung cấp dịch vụ vận tải');
        }else
            return view('errors.notlogin');
    }
}
