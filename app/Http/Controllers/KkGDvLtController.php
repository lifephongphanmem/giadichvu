<?php

namespace App\Http\Controllers;

use App\CbKkGDvLt;
use App\CsKdDvLt;
use App\DmDvQl;
use App\DnDvLt;
use App\DoiTuongApDungDvLt;
use App\KkGDvLt;
use App\KkGDvLtCt;
use App\KkGDvLtCtDf;
use App\KkGDvLtCtH;
use App\KkGDvLtH;
use App\TtCsKdDvLt;
use App\TtNgayNghiLe;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class KkGDvLtController extends Controller
{
    public function cskd(){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                if (session('admin')->level == 'T' || session('admin')->level == 'H') {
                    if (session('admin')->sadmin == 'ssa') {
                        $model = CsKdDvLt::join('dmdvql','cskddvlt.cqcq','=','dmdvql.maqhns')
                            ->select('cskddvlt.*','dmdvql.tendv')
                            ->get();
                    } else {
                        $model = CsKdDvLt::join('dmdvql','cskddvlt.cqcq','=','dmdvql.maqhns')
                            ->select('cskddvlt.*','dmdvql.tendv')
                            ->where('cqcq', session('admin')->cqcq)
                            ->get();
                    }
                } else {
                    $model = CsKdDvLt::join('dmdvql','cskddvlt.cqcq','=','dmdvql.maqhns')
                        ->select('cskddvlt.*','dmdvql.tendv')
                        ->where('masothue', session('admin')->mahuyen)
                        ->get();
                }

                return view('manage.dvlt.kkgia.ttcskd.index')
                    ->with('model', $model)
                    ->with('pageTitle', 'Thông tin cơ sở kinh doanh dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function index($macskd,$nam){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $model = KkGDvLt::where('macskd', $macskd)
                    ->whereYear('ngaynhap', $nam)
                    ->orderBy('id')
                    ->get();
                $modelcskd = CsKdDvLt::where('macskd', $macskd)
                    ->first();

                $tthscp = KkGDvLt::where('macskd', $macskd)
                    ->whereYear('ngaynhap', $nam)
                    ->where('trangthai','Duyệt')
                    ->orderBy('id','desc')
                    ->get();
                $cb = CbKkGDvLt::where('macskd', $macskd)->first();
                if(isset($cb))
                    $cp = 'yes';
                else
                    $cp = 'no';
                return view('manage.dvlt.kkgia.kkgiadv.index')
                    ->with('model', $model)
                    ->with('nam', $nam)
                    ->with('macskd', $macskd)
                    ->with('modelcskd', $modelcskd)
                    ->with('tthscp',$tthscp)
                    ->with('cp',$cp)
                    ->with('pageTitle', 'Thông tin kê khai giá dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function create($macskd){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $check = KkGDvLt::where('macskd',$macskd)
                    ->wherein('trangthai',['Bị trả lại','Chờ nhận'])
                    ->whereYear('ngaynhap', date('Y'))
                    ->count();
                if($check == 0) {
                    $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                    if (session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $modelcskd->cqcq) {
                        $modelkkctdf = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                            ->delete();

                        $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                            ->get();
                        $datenow = date('Y-m-d');
                        $datehl = getNgayHieuLucLT($datenow);
                        $ngaynhap = date('d/m/Y', strtotime($datenow));
                        $ngayhieuluc = date('d/m/Y', strtotime($datehl));

                        $modeldn = DnDvLt::where('masothue', $modelcskd->masothue)->first();

                        $modelph = TtCsKdDvLt::where('macskd', $macskd)
                            ->get();
                        foreach ($modelph as $ttph) {
                            $dsph = new KkGDvLtCtDf();
                            $dsph->macskd = $ttph->macskd;
                            $dsph->maloaip = $ttph->maloaip;
                            $dsph->loaip = $ttph->loaip;
                            $dsph->qccl = $ttph->qccl;
                            $dsph->sohieu = $ttph->sohieu;
                            $dsph->ghichu = $ttph->ghichu;
                            $dsph->mucgialk = $ttph->mucgiakk;
                            $dsph->mucgiakk = $ttph->mucgiakk;
                            $dsph->save();
                        }

                        $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                            ->get();

                        //dd($datehl);
                        return view('manage.dvlt.kkgia.kkgiadv.create')
                            ->with('modelcskd', $modelcskd)
                            ->with('modeldn', $modeldn)
                            ->with('ngaynhap', $ngaynhap)
                            ->with('ngayhieuluc', $ngayhieuluc)
                            ->with('modeldsph', $modeldsph)
                            ->with('ngaynhapdf', $datehl)
                            ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                    } else
                        return view('errors.noperm');
                }else
                    dd('Hiện tại đang tồn tại hồ sơ có trạng thái chờ duyệt, chờ chuyển or bị trả lại! Bạn không thể tạo thêm hồ sơ');

            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    /*public function copy(Request $request){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
            $inputs = $request->all();
            $modelcp = CbKkGDvLt::where('macskd',$inputs['macskdcp'])
                ->first();
            dd($inputs);

            $modelcskd = CsKdDvLt::where('macskd', $inputs['macskdcp'])->first();
                $modelkkctdf = KkGDvLtCtDf::where('macskd', $inputs['macskdcp'])
                    ->delete();
                $modelcb = KkGDvLt::where('mahs',$modelcp->mahs)->first();
                //dd($modelcb);
                $modelph = KkGDvLtCt::where('mahs',$modelcp->mahs)
                    ->get();
                foreach($modelph as $ttph){
                    $dsph = new KkGDvLtCtDf();
                    $dsph->macskd = $ttph->macskd;
                    $dsph->maloaip = $ttph->maloaip;
                    $dsph->loaip = $ttph->loaip;
                    $dsph->qccl = $ttph->qccl;
                    $dsph->sohieu = $ttph->sohieu;
                    $dsph->ghichu = $ttph->ghichu;
                    $dsph->mucgialk = $ttph->mucgiakk;
                    $dsph->mucgiakk = $ttph->mucgiakk;
                    $dsph->save();
                }

                $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                    ->get();
                $datenow = date('Y-m-d');
                $datehl = getNgayHieuLucLT($datenow);
                $ngaynhap = date('d/m/Y',strtotime($datenow));
                $ngayhieuluc =  date('d/m/Y',strtotime($datehl));

                $modeldn = DnDvLt::where('masothue',$modelcskd->masothue)
                    ->first();

                return view('manage.dvlt.kkgia.kkgiadv.create')
                    ->with('modelcskd', $modelcskd)
                    ->with('modeldsph', $modeldsph)
                    ->with('modelcb', $modelcb)
                    ->with('ngaynhap',$ngaynhap)
                    ->with('ngayhieuluc',$ngayhieuluc)
                    ->with('modeldn',$modeldn)
                    ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }*/

    public function saochep($macskd){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'DVLT') {
                $check = KkGDvLt::where('macskd',$macskd)
                    ->wherein('trangthai',['Bị trả lại','Chờ nhận'])
                    ->whereYear('ngaynhap', date('Y'))->get()->toarray();
                if(count((array) $check)==0) {
                    $modelcp = CbKkGDvLt::where('macskd', $macskd)
                        ->first();
                    if ($modelcp->phanloai != 'DT') {
                        $modelcskd = CsKdDvLt::where('macskd', $macskd)->first();
                        $modelkkctdf = KkGDvLtCtDf::where('macskd', $macskd)
                            ->delete();
                        $modelcb = KkGDvLt::where('mahs', $modelcp->mahs)->first();
                        //dd($modelcb);
                        $modelph = KkGDvLtCt::where('mahs', $modelcp->mahs)
                            ->get();
                        foreach ($modelph as $ttph) {
                            $dsph = new KkGDvLtCtDf();
                            $dsph->macskd = $ttph->macskd;
                            $dsph->maloaip = $ttph->maloaip;
                            $dsph->loaip = $ttph->loaip;
                            $dsph->qccl = $ttph->qccl;
                            $dsph->sohieu = $ttph->sohieu;
                            $dsph->ghichu = $ttph->ghichu;
                            $dsph->mucgialk = $ttph->mucgiakk;
                            $dsph->mucgiakk = $ttph->mucgiakk;
                            $dsph->save();
                        }

                        $modeldsph = KkGDvLtCtDf::where('macskd', $modelcskd->macskd)
                            ->get();
                        $datenow = date('Y-m-d');
                        $datehl = getNgayHieuLucLT($datenow);
                        $ngaynhap = date('d/m/Y', strtotime($datenow));
                        $ngayhieuluc = date('d/m/Y', strtotime($datehl));

                        $modeldn = DnDvLt::where('masothue', $modelcskd->masothue)
                            ->first();
                        return view('manage.dvlt.kkgia.kkgiadv.create')
                            ->with('modelcskd', $modelcskd)
                            ->with('modeldsph', $modeldsph)
                            ->with('modelcb', $modelcb)
                            ->with('ngaynhap', $ngaynhap)
                            ->with('ngayhieuluc', $ngayhieuluc)
                            ->with('modeldn', $modeldn)
                            ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');
                    } else {
                        return redirect('ke_khai_dich_vu_luu_tru/khach_san=' . $macskd . '/create');
                    }
                }else
                    dd('Hiện tại đang tồn tại hồ sơ có trạng thái chờ duyệt, chờ chuyển or bị trả lại! Bạn không thể tạo thêm hồ sơ');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    public function store(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['mahs'] = $inputs['macskd'].getdate()[0];
            $inputs['ngaynhap'] = getDateToDb($inputs['ngaynhap']);
            $inputs['ngayhieuluc'] = getDateToDb($inputs['ngayhieuluc']);
            $inputs['giaycnhangcstungay'] = getDateToDb($inputs['giaycnhangcstungay']);
            $inputs['giaycnhangcsdenngay'] = getDateToDb($inputs['giaycnhangcsdenngay']);
            if($inputs['ngaycvlk'] != '')
                $inputs['ngaycvlk']= getDateToDb($inputs['ngaycvlk']);
            else
                unset($inputs['ngaycvlk']);
            if(isset($inputs['giaycnhangcs'])){
                $giaycnhangcs = $request->file('giaycnhangcs');
                $inputs['giaycnhangcs'] = $inputs['macskd'] .getdate()[0].'.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $inputs['giaycnhangcs']);
            }else
                $inputs['giaycnhangcs'] = $inputs['giaycnhangcsplus'];
            if(isset($inputs['filedk1'])){
                $giaycnhangcs = $request->file('filedk1');
                $inputs['filedk1'] = $inputs['macskd'] .getdate()[0].'_1.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $inputs['filedk1']);
            }else
                $inputs['filedk1'] = $inputs['filedk1plus'];
            if(isset($inputs['filedk2'])){
                $giaycnhangcs = $request->file('filedk2');
                $inputs['filedk2'] = $inputs['macskd'] .getdate()[0].'_2.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $inputs['filedk2']);
            }else
                $inputs['filedk2'] = $inputs['filedk2plus'];
            if(isset($inputs['filedk3'])){
                $giaycnhangcs = $request->file('filedk3');
                $inputs['filedk3'] = $inputs['macskd'] .getdate()[0].'_3.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $inputs['filedk3']);
            }else
                $inputs['filedk3'] = $inputs['filedk3plus'];
            $inputs['trangthai'] = 'Chờ chuyển';
            $model = new KkGDvLt();
            if($model->create($inputs)){
                $modelph = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
                    ->get();
                foreach($modelph as $ph){
                    $modelgiaph = new KkGDvLtCt();
                    $modelgiaph->maloaip = $ph->maloaip;
                    $modelgiaph->loaip = $ph->loaip;
                    $modelgiaph->qccl = $ph->qccl;
                    $modelgiaph->sohieu = $ph->sohieu;
                    $modelgiaph->ghichu = $ph->ghichu;
                    $modelgiaph->macskd = $ph->macskd;
                    $modelgiaph->mucgialk = $ph->mucgialk;
                    $modelgiaph->mucgiakk = $ph->mucgiakk;
                    $modelgiaph->mahs = $inputs['mahs'];
                    $modelgiaph->save();
                }
            }
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$inputs['macskd'].'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function edit($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='DVLT') {
                $model = KkGDvLt::findOrFail($id);
                $modelct = KkGDvLtCt::where('mahs', $model->mahs)
                    ->get();
                $modelcskd = CsKdDvLt::where('macskd', $model->macskd)->first();
                $modeldn = DnDvLt::where('masothue',$model->masothue)->first();
                $modelcb = CbKkGDvLt::where('macskd',$model->macskd)
                    ->first();
                return view('manage.dvlt.kkgia.kkgiadv.edit')
                    ->with('model', $model)
                    ->with('modelct', $modelct)
                    ->with('modelcskd',$modelcskd)
                    ->with('modeldn',$modeldn)
                    ->with('modelcb',$modelcb)
                    ->with('pageTitle', 'Chỉnh sửa thông tin kê khai giá dịch vụ lưu trú');
            }else{
                return view('errors.perm');
            }
        }else
            return view('errors.notlogin');
    }

    //Bỏ phần đính kèm
    public function edit_dk($id){
        if (Session::has('admin')) {
            if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level =='DVLT') {
                $model = KkGDvLt::findOrFail($id);
                if(session('admin')->sadmin == 'ssa' || session('admin')->cqcq == $model->cqcq) {

                    return view('manage.dvlt.kkgia.kkgiadv.edit_dk')
                        ->with('model', $model)
                        ->with('pageTitle', 'Chỉnh sửa thông tin kê khai giá dịch vụ lưu trú');
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
            $model = KkGDvLt::findOrFail($id);
            $input['ngayhieuluc'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngayhieuluc'])));
            $input['ngaynhap'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaynhap'])));
            $input['giaycnhangcstungay'] = getDateToDb($input['giaycnhangcstungay']);
            $input['giaycnhangcsdenngay'] = getDateToDb($input['giaycnhangcsdenngay']);
            if($input['ngaycvlk'] != '')
                $input['ngaycvlk']= getDateToDb($input['ngaycvlk']);
            else
                unset($input['ngaycvlk']);
            if(isset($input['checkgiaycncs']))
                $input['giaycnhangcs'] = "";
            if(isset($input['checkfiledk1']))
                $input['filedk1'] = "";
            if(isset($input['checkfiledk2']))
                $input['filedk2'] = "";
            if(isset($input['checkfiledk3']))
                $input['filedk3'] = "";
            if(isset($input['giaycnhangcs']) && $input['giaycnhangcs'] != ''){
                $giaycnhangcs = $request->file('giaycnhangcs');
                $input['giaycnhangcs'] = $input['macskd'] .getdate()[0].'.'.$giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt/', $input['giaycnhangcs']);
            }
            if(isset($input['filedk1']) && $input['filedk1'] != "") {
                $giaycnhangcs = $request->file('filedk1');
                $input['filedk1'] = $input['macskd'] .getdate()[0].'_1.' . $giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $input['filedk1']);
            }
            if(isset($input['filedk2']) && $input['filedk2'] != "") {
                $giaycnhangcs = $request->file('filedk2');
                $input['filedk2'] = $input['macskd'] .getdate()[0]. '_2.' . $giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $input['filedk2']);
            }
            if(isset($input['filedk3']) && $input['filedk3'] != "") {
                $giaycnhangcs = $request->file('filedk3');
                $input['filedk3'] = $input['macskd'] .getdate()[0].'_3.' . $giaycnhangcs->getClientOriginalExtension();
                $giaycnhangcs->move(public_path() . '/images/cskddvlt/hangcslt', $input['filedk3']);
            }

            $model->update($input);
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$model->macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    //Bỏ phần đính kèm
    public function update_dk(Request $request, $id){
        if (Session::has('admin')) {
            $input = $request->all();
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;
            if(isset($request->filedk)){
                if(file_exists(public_path() . '/data/uploads/attack/'.$model->filedk)){
                    File::Delete(public_path() . '/data/uploads/attack/'.$model->filedk);
                }
                $file=$request->file('filedk');

                $filename =$input['mahs'].'_'.$file->getClientOriginalName();
                $file->move(public_path() . '/data/uploads/attack/', $filename);
                $model->filedk=$filename;
            }
            $model->ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaynhap'])));
            $model->socv = $input['socv'];
            $model->ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $input['ngayhieuluc'])));
            $model->socvlk = $input['socvlk'];
            $model->ngaycvlk = $input['ngaycvlk']==''? NULL  :date('Y-m-d', strtotime(str_replace('/', '-', $input['ngaycvlk'])));;
            $model->dvt = $input['dvt'];
            $model->save();
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function destroy(Request $request){
        if (Session::has('admin')) {
            $id = $request->all()['iddelete'];
            $model = KkGDvLt::findOrFail($id);
            $macskd = $model->macskd;
            if($model->delete()){
                $modelct = KkGDvLtCt::where('mahs',$model->mahs)->delete();
                $modelcth = KkGDvLtCtH::where('mahs',$model->mahs)->delete();
                $modelh = KkGDvLtH::where('mahs',$model->mahs)->delete();
            }
            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function chuyen(Request $request){
        if (Session::has('admin')) {
            $tgchuyen = Carbon::now()->toDateTimeString();
            $input = $request->all();
            $id = $input['idchuyen'];
            $model = KkGDvLt::findOrFail($id);
            //dd($model);
            if($input['ttnguoinop'] != ''){
                $model->ttnguoinop = $input['ttnguoinop'];
                $model->trangthai = 'Chờ nhận';
                $model->ngaychuyen = $tgchuyen;
                //$model->save();

                $model->save();

                $this->uphischuyenhs($model);

                $tencqcq = DmDvQl::where('maqhns',$model->cqcq)->first();
                $dn = DnDvLt::where('masothue',$model->masothue)->first();
                $data=[];
                $data['tendn'] = $dn->tendn;
                $data['masothue'] = $model->masothue;
                $data['tg'] = $tgchuyen;
                $data['tencqcq'] = $tencqcq->tendv;
                $data['ttnguoinop'] = $input['ttnguoinop'];

                $phone = $dn->teldn;
                $content ="Thong bao nhan ho so. ". $data['tg'].", DN:". $data['tendn']." - ".
                    $data['masothue']. " - ". $data['tg']." - ". $data['tencqcq']. " - ". $data['ttnguoinop'];
                guitinjson($phone,$content);

                $maildn = $dn->email;
                $tendn = $dn->tendn;
                $mailql = $tencqcq->email;
                $tenql = $tencqcq->tendv;

                Mail::send('mail.kkgia',$data, function ($message) use($maildn,$tendn,$mailql,$tenql) {
                    $message->to($maildn,$tendn)
                        ->to($mailql,$tenql)
                        ->subject('Thông báo nhận hồ sơ kê khai giá dịch vụ');
                    $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
                });
                    //History
                    /*$mahsh = getdate()[0];
                    $his = new KkGDvLtH();
                    $his->mahsh = $mahsh;
                    $his->mahs = $model->mahs;
                    $his->macskd = $model->macskd;
                    $his->masothue = $model->masothue;
                    $his->ngaynhap = $model->ngaynhap;
                    $his->socv = $model->socv;
                    $his->socvlk = $model->socvlk;
                    $his->ngaycvlk = $model->ngaycvlk;
                    $his->ngayhieuluc = $model->ngayhieuluc;
                    $his->ttnguoinop = $input['ttnguoinop'];
                    $his->ghichu = $model->ghichu;
                    $his->ngaychuyen = $tgchuyen;
                    $his->cqcq = $model->cqcq;
                    $his->dvt = $model->dvt;
                    $his->phanloai = $model->phanloai;
                    $his->plhs =$model->plhs;
                    $his->action = 'Chuyển hồ sơ kê khai';
                    if($his->save()){
                        $hsct = KkGDvLtCt::where('mahs',$model->mahs)
                            ->get();
                        foreach($hsct as $ct){
                            $hisct = new KkGDvLtCtH();
                            $hisct->mahsh = $mahsh;
                            $hisct->loaip = $ct->loaip;
                            $hisct->qccl = $ct->qccl;
                            $hisct->sohieu = $ct->sohieu;
                            $hisct->ghichu = $ct->ghichu;
                            $hisct->macskd = $ct->macskd;
                            $hisct->mahs = $ct->mahs;
                            $hisct->mucgialk = $ct->mucgialk;
                            $hisct->mucgiakk = $ct->mucgiakk;
                            $hisct->tendoituong = $ct->tendoituong;
                            $hisct->apdung = $ct->apdung;
                            $hisct->maloaip = $ct->maloaip;
                            $hisct->save();
                        }
                    }*/
            }


            $macskd = $model->macskd;

            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function uphischuyenhs($model){
        //History
        $mahsh = getdate()[0];
        $arrays = $model->toArray();
        unset($arrays['id']);
        $arrays['action'] = 'Chuyển hồ sơ kê khai';
        $arrays['mahsh'] = $mahsh;
        $arrays['username'] = session('admin')->username;
        $arrays['name'] = session('admin')->name;
        $his = new KkGDvLtH();
        if($his->create($arrays)){
            $hsct = KkGDvLtCt::where('mahs',$model->mahs)
                ->get();
            foreach($hsct as $ct){
                $hisct = new KkGDvLtCtH();
                $hisct->mahsh = $mahsh;
                $hisct->loaip = $ct->loaip;
                $hisct->qccl = $ct->qccl;
                $hisct->sohieu = $ct->sohieu;
                $hisct->ghichu = $ct->ghichu;
                $hisct->macskd = $ct->macskd;
                $hisct->mahs = $ct->mahs;
                $hisct->mucgialk = $ct->mucgialk;
                $hisct->mucgiakk = $ct->mucgiakk;
                $hisct->tendoituong = $ct->tendoituong;
                $hisct->apdung = $ct->apdung;
                $hisct->maloaip = $ct->maloaip;
                $hisct->save();
            }
        }
    }

    public function chuyenhscham(Request $request){
        if (Session::has('admin')) {
            $tgchuyen = Carbon::now()->toDateTimeString();
            $input = $request->all();
            $id = $input['idchuyenhscham'];
            $model = KkGDvLt::findOrFail($id);
            $model->ttnguoinop = 'Kỹ thuật viên';
            $model->trangthai = 'Chờ nhận';
            $model->ngaychuyen = $tgchuyen;
            //$model->save();
            if($model->save()){
                //History
                $mahsh = getdate()[0];
                $his = new KkGDvLtH();
                $his->mahsh = $mahsh;
                $his->mahs = $model->mahs;
                $his->macskd = $model->macskd;
                $his->masothue = $model->masothue;
                $his->ngaynhap = $model->ngaynhap;
                $his->socv = $model->socv;
                $his->socvlk = $model->socvlk;
                $his->ngaycvlk = $model->ngaycvlk;
                $his->ngayhieuluc = $model->ngayhieuluc;
                $his->ttnguoinop = 'Kỹ thuật viên';
                $his->ghichu = $model->ghichu;
                $his->ngaychuyen = $tgchuyen;
                $his->cqcq = $model->cqcq;
                $his->dvt = $model->dvt;
                $his->phanloai = $model->phanloai;
                $his->plhs =$model->plhs;
                $his->action = 'Chuyển hồ sơ kê khai(Kỹ thuật viên chuyển do đơn vị nộp kê khai chậm)';
                if($his->save()){
                    $hsct = KkGDvLtCt::where('mahs',$model->mahs)
                        ->get();
                    foreach($hsct as $ct){
                        $hisct = new KkGDvLtCtH();
                        $hisct->mahsh = $mahsh;
                        $hisct->loaip = $ct->loaip;
                        $hisct->qccl = $ct->qccl;
                        $hisct->sohieu = $ct->sohieu;
                        $hisct->ghichu = $ct->ghichu;
                        $hisct->macskd = $ct->macskd;
                        $hisct->mahs = $ct->mahs;
                        $hisct->mucgialk = $ct->mucgialk;
                        $hisct->mucgiakk = $ct->mucgiakk;
                        $hisct->tendoituong = $ct->tendoituong;
                        $hisct->apdung = $ct->apdung;
                        $hisct->maloaip = $ct->maloaip;
                        $hisct->save();
                    }
                }
            };
            $macskd = $model->macskd;

            return redirect('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$macskd.'&nam='.date('Y'));
        }else
            return view('errors.notlogin');
    }

    public function viewlydo(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => 'permission denied',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if(isset($inputs['id'])){
            $model = KkGDvLt::where('id',$inputs['id'])
                ->first();

            //$result['message'] = '<div class="col-md-9 " id="ndlydo">';
            $result['message'] = '<textarea id="lydo" class="form-control required" name="lydo" cols="30" rows="6">'.$model->lydo.'</textarea>';
            //$result['message'] .= '</div>';
            $result['status'] = 'success';

        }
        die(json_encode($result));
    }
    public function checkngay(Request $request){
        $result = array(
            'status' => 'fail',
            'message' => '"Ngày thực hiện mức giá kê khai không thể sử dụng được! Bạn cần chỉnh sửa lại thông tin trước khi chuyển", "Lỗi!!!"',
        );
        if(!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
                'message' => '"Bạn cần đăng nhập tài khoản để chuyển hồ so", "Lỗi!!!"',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();
        $ngaychuyen = Carbon::now()->toDateTimeString();
        if(isset($inputs['id'])){
            $model = KkGDvLt::where('id',$inputs['id'])
                ->first();
            $ngayapdung = $model->ngayhieuluc;

            if($model->plhs == 'GG') {
                if ($ngayapdung > date('Y-m-d',strtotime($ngaychuyen))) {
                    $modelcheckct = KkGDvLtCt::where('mahs',$model->mahs)
                        ->get();
                    //dd($modelcheckct);
                    $val = 0;
                    foreach($modelcheckct as $ct){
                        if($ct->mucgiakk > $ct->mucgialk) {
                            $val = 1;
                        }
                    }
                    if($val == 1){
                        $result['status'] = 'fail';
                        $result['message'] = '"Giá dịch vụ không đúng theo loại hồ sơ giảm giá", "Lỗi!!!"';
                    }else
                        $result['status'] = 'success';
                  //dd($val);
                }else{
                    $result['status'] = 'fail';
                    $result['message'] = '"Ngày áp dụng hồ sơ giảm giá phải sau ngày nộp ít nhất 1 ngày", "Lỗi!!!"';
                }
            }else {
                $date = date_create($ngaychuyen);
                if(date('H',strtotime($ngaychuyen)) >= '17')
                    $datenew = date_modify($date, "+1 days");
                else
                    $datenew = $date;

                $ngaychuyen = date_format($datenew, "Y-m-d");
                /*} else {
                    $ngaychuyen = date("Y-m-d",strtotime($ngaychuyen));
                }*/
                $model = KkGDvLt::where('id',$inputs['id'])
                    ->first();
                $ngayduyet = $model->ngayhieuluc;
                $ngaylv = 0;
                while (strtotime($ngaychuyen) < strtotime($ngayduyet)) {
                    $checkngay = TtNgayNghiLe::where('ngaytu', '<=', $ngaychuyen)
                        ->where('ngayden', '>=', $ngaychuyen)->get();
                    if (count($checkngay) > 0)
                        $ngaylv = $ngaylv;
                    elseif (date('D', strtotime($ngaychuyen)) == 'Sat')
                        $ngaylv = $ngaylv;
                    elseif (date('D', strtotime($ngaychuyen)) == 'Sun')
                        $ngaylv = $ngaylv;
                    else
                        $ngaylv = $ngaylv + 1;
                    //dd($ngaylv);
                    $datestart = date_create($ngaychuyen);
                    $datestartnew = date_modify($datestart, "+1 days");
                    $ngaychuyen = date_format($datestartnew, "Y-m-d");

                }
                //dd($ngaylv.'-'. getGeneralConfigs()['thoihan_lt'] );
                if ($ngaylv >= getGeneralConfigs()['thoihan_lt']) {

                    $result['status'] = 'success';

                }else{
                    $result['status'] = 'fail';
                    $result['message'] = '"Ngày áp dụng hồ sơ không đủ điều kiện xét duyệt", "Lỗi!!!"';
                }
            }
        }
        //dd($result);
        die(json_encode($result));
    }

    public function checkgial1($mahs){
        $model = KkGDvLtCt::where('mahs',$mahs)->get();
        foreach($model as $tt){
            if($tt->mucgiakk > $tt->mucgialk)
                $result['status'] = 'success';
        }

    }

    public function search(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $inputs['nam'] = isset($inputs['nam']) ? $inputs['nam'] : date('Y');
            $inputs['masothue'] = isset($inputs['masothue']) ? $inputs['masothue']: 'all';
            $inputs['macskd'] = isset($inputs['macskd']) ? $inputs['macskd']: 'all';
            $dn = DnDvLt::all();
            if($inputs['masothue'] == 'all') {
                if($inputs['macskd'] == 'all')
                    $model = KkGDvLt::whereYear('ngaynhap', $inputs['nam'])
                        ->where('masothue', 'all');
                else
                    $model = KkGDvLt::whereYear('ngaynhap', $inputs['nam'])
                        ->where('macskd', $inputs['macskd']);

                $cskd = CsKdDvLt::all();
            }else {
                $cskd = CsKdDvLt::where('masothue',$inputs['masothue'])
                    ->get();
                if($inputs['macskd'] == 'all')
                    $model = KkGDvLt::whereYear('ngaynhap', $inputs['nam'])
                        ->where('masothue', $inputs['masothue']);
                else
                    $model = KkGDvLt::whereYear('ngaynhap', $inputs['nam'])
                        ->where('masothue', $inputs['masothue'])
                        ->where('macskd', $inputs['macskd']);

            }
            $model = $model->orderBy('id', 'asc')->get();

            /*$allcskd = CsKdDvLt::all();
            foreach($model as $ttkk){
                $this->getTTCSKD($allcskd,$ttkk);
            }*/

            return view('manage.dvlt.search.index')
                ->with('select_nam',$inputs['nam'])
                ->with('dn',$dn)
                //->with('selectdn',$inputs['masothue'])
                ->with('model',$model)
                ->with('select_masothue',$inputs['masothue'])
                ->with('cskd',$cskd)
                ->with('select_macskd',$inputs['macskd'])
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }

    /*public function viewsearch($masothue,$macskd,$nam){
        if (Session::has('admin')) {
            $allcskd = CsKdDvLt::all();
            $cskd = CsKdDvLt::where('masothue',$masothue)
                ->get();
            $dn = DnDvLt::all();
            if($masothue == 'all'){
                $model = KkGDvLt::whereYear('ngaynhan',$nam)
                    ->where('trangthai','Duyệt')
                    ->get();
            }else{
                if($macskd == 'all')
                    $model = KkGDvLt::where('masothue',$masothue)
                        ->whereYear('ngaynhan',$nam)
                        ->where('trangthai','Duyệt')
                        ->get();
                else
                    $model = KkGDvLt::where('masothue',$masothue)
                        ->where('macskd',$macskd)
                        ->whereYear('ngaynhan',$nam)
                        ->where('trangthai','Duyệt')
                        ->get();

            }
            //dd($model);
            foreach($model as $ttkk){
                $this->getTTCSKD($allcskd,$ttkk);
            }
            return view('manage.dvlt.search.view')
                ->with('model',$model)
                ->with('masothue',$masothue)
                ->with('dn',$dn)
                ->with('nam',$nam)
                ->with('macskd',$macskd)
                ->with('cskd',$cskd)
                ->with('pageTitle','Tìm kiếm thông tin kê khai giá dịch vụ lưu trú');
        }else
            return view('errors.notlogin');
    }*/
    public function getTTCSKD($cskds,$array){
        foreach($cskds as $cskd){
            if($cskd->macskd == $array->macskd){
                $array->tencskd = $cskd->tencskd;
            }
        }
    }
    public function getGialk($array,$phongs){
        foreach($array as $ar){
            if ($phongs->maloaip == $ar->maloaip) {
                $phongs->gialk = $ar->mucgiakk;
                break;
            }
        }
    }

    public function nhandl(Request $request){
        if (Session::has('admin')) {
            $inputs = $request->all();
            $model = CsKdDvLt::where('macskd',$inputs['macskd'])->first();
            return view('manage.dvlt.kkgia.kkgiadv.importexcel')
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Nhận dữ liệu kê khai từ file excel');
        }else
            return view('errors.notlogin');
    }

    public function importexcel(Request $request){
        if(Session::has('admin')){
            $inputs = $request->all();
            $dels = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
                ->delete();
            $filename = $inputs['macskd'] . '_' . getdate()[0];
            $request->file('fexcel')->move(public_path() . '/data/uploads/excels/', $filename . '.xls');
            $path = public_path() . '/data/uploads/excels/' . $filename . '.xls';
            $data = [];

            Excel::load($path, function ($reader) use (&$data, $inputs) {
                $obj = $reader->getExcel();
                $sheet = $obj->getSheet(0);
                $data = $sheet->toArray(null, true, true, true);// giữ lại tiêu đề A=>'val';
            });
            //dd($data);
            for ($i = $inputs['tudong']; $i <= $inputs['dendong']; $i++) {
                //dd($data[$i]);
                if (!isset($data[$i][$inputs['loaip']]) || $data[$i][$inputs['loaip']] == '') {
                    continue;//Tên cán bộ rỗng => thoát
                }
                $modelctnew = new KkGDvLtCtDf();
                $modelctnew->macskd = $inputs['macskd'];
                $modelctnew->loaip = $data[$i][$inputs['loaip']];
                $modelctnew->qccl = $data[$i][$inputs['qccl']];
                $modelctnew->sohieu = $data[$i][$inputs['sohieu']];
                $modelctnew->ghichu = $data[$i][$inputs['ghichu']];
                $modelctnew->mucgialk = getDbl($data[$i][$inputs['mucgialk']]);
                $modelctnew->mucgiakk = getDbl($data[$i][$inputs['mucgiakk']]);
                $modelctnew->save();
            }
            File::Delete($path);
            $modelcskd = CsKdDvLt::where('macskd', $inputs['macskd'])->first();
            $datenow = date('Y-m-d');
            $datehl = getNgayHieuLucLT($datenow);
            $ngaynhap = date('d/m/Y', strtotime($datenow));
            $ngayhieuluc = date('d/m/Y', strtotime($datehl));

            $modeldn = DnDvLt::where('masothue', $modelcskd->masothue)->first();
            $modeldsph = KkGDvLtCtDf::where('macskd',$inputs['macskd'])
                ->get();

            //dd($datehl);
            return view('manage.dvlt.kkgia.kkgiadv.create')
                ->with('modelcskd', $modelcskd)
                ->with('modeldn', $modeldn)
                ->with('ngaynhap', $ngaynhap)
                ->with('ngayhieuluc', $ngayhieuluc)
                ->with('modeldsph', $modeldsph)
                ->with('ngaynhapdf', $datehl)
                ->with('pageTitle', 'Kê khai giá dịch vụ lưu trú thêm mới');

        }else
            return view('errors.notlogin');
    }

}