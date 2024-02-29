<?php

namespace App\Http\Controllers;

use App\CsKdDvLt;
use App\DnDvLt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KkGDvLt;
use App\KkGDvLtCt;
use Illuminate\Http\Response;

class APIController extends Controller
{
    public function DoanhNghiep(Request $request)
    {
        $header = $request->headers->all();
        $body = $request->all();
        //Kiểm tra các tham số truyền vào
        if (!isset($header['sadmin']) || !isset($header['cqcq'])) {
            $a_API = [
                'matrave' => '-1',
                'thongbao' => 'Các tham số truyền vào hợp lệ hoặc đã hết hạn.',
            ];
            return response()->json($a_API, Response::HTTP_OK);
        }
        //Kiểm tra quyền truy cập      
        if (!in_array(strtolower($header['sadmin'][0]), ['ssa', 'satc'])) {
            $a_API = [
                'matrave' => '-1',
                'thongbao' => 'Phân loại tài khoản không có quyền truy cập.',
            ];
            return response()->json($a_API, Response::HTTP_OK);
        }

        //Thiết lập thông điệp
        $a_API['Header'] = [
            'Version' => '1.0',
            'Tran_Code' => '',
            'Export_Date' => date('d-m-Y h:i:sa'),
            'Msg_ID' => '',
            'Path' => $header['host'][0],
        ];
        $a_API['Body'] = [];
        $a_API['Security'] = ['Signature' => ''];
        //Lấy danh sách đơn vị
        if (strtolower($header['sadmin'][0]) == 'ssa') {
            $model = DnDvLt::where('trangthai', 'Kích hoạt')->get();
        } else {
            $model = DnDvLt::where('trangthai', 'Kích hoạt')
                ->where('cqcq', session('admin')->cqcq)
                ->get();
        }
        $model_cskd = CsKdDvLt::wherein('masothue', array_column($model->toarray(), 'masothue'))->get();
        $a_kq = $model->toarray();
        for ($i = 0; $i < count($a_kq); $i++) {
            $cskd = $model_cskd->where('masothue', $a_kq[$i]['masothue']);
            $a_cskd = [];
            foreach ($cskd as $cs) {
                $a_cskd[] = [
                    'macskd' => $cs->macskd,
                    'masothue' => $cs->masothue,
                    'tencskd' => $cs->tencskd,
                    'loaihang' => $cs->loaihang,
                    'diachikd' => $cs->diachikd,
                    'telkd' => $cs->telkd,
                    'toado' => $cs->toado,
                    'link' => $cs->link,
                    'cqcq' => $cs->cqcq,
                    'ghichu' => $cs->ghichu,
                ];
            }

            $a_kq[$i]['ds_cskd'] = $a_cskd;
        }

        $a_API['Body'] = $a_kq;
        return response()->json($a_API, Response::HTTP_OK);
    }

    public function HoSoKeKhai(Request $request)
    {
        $header = $request->headers->all();
        $body = $request->all();
        //Kiểm tra các tham số truyền vào
        if (!isset($header['sadmin']) || !isset($header['cqcq']) || !isset($header['tungay']) || !isset($header['denngay'])) {
            $a_API = [
                'matrave' => '-1',
                'thongbao' => 'Các tham số truyền vào hợp lệ hoặc đã hết hạn.',
            ];
            return response()->json($a_API, Response::HTTP_OK);
        }
        //Kiểm tra quyền truy cập      
        if (!in_array(strtolower($header['sadmin'][0]), ['ssa', 'satc'])) {
            $a_API = [
                'matrave' => '-1',
                'thongbao' => 'Phân loại tài khoản không có quyền truy cập.',
            ];
            return response()->json($a_API, Response::HTTP_OK);
        }

        //Thiết lập thông điệp
        $a_API['Header'] = [
            'Version' => '1.0',
            'Tran_Code' => '',
            'Export_Date' => date('d-m-Y h:i:sa'),
            'Msg_ID' => '',
            'Path' => $header['host'][0],
        ];
        $a_API['Body'] = [];
        $a_API['Security'] = ['Signature' => ''];
        //Lấy danh sách đơn vị
        if (strtolower($header['sadmin'][0]) == 'ssa') {
            $model_dn = DnDvLt::where('trangthai', 'Kích hoạt')->get();
        } else {
            $model_dn = DnDvLt::where('trangthai', 'Kích hoạt')
                ->where('cqcq', session('admin')->cqcq)
                ->get();
        }
        $model_cskd = CsKdDvLt::wherein('masothue', array_column($model_dn->toarray(), 'masothue'))->get();
        $model = KkGDvLt::wherein('macskd', array_column($model_cskd->toarray(), 'macskd'))
            ->wherebetween('ngaynhap', [$header['tungay'][0], $header['denngay'][0]])->get();
        $model_chitiet = KkGDvLtCt::wherein('mahs', array_column($model->toarray(), 'mahs'))->get();
        $a_kq = $model->toarray();


        for ($i = 0; $i < count($a_kq); $i++) {
            $chitiet = $model_chitiet->where('mahs', $a_kq[$i]['mahs']);
            $a_ct = [];
            foreach ($chitiet as $ct) {
                $a_ct[] = [
                    'macskd' => $ct->macskd,
                    'mahs' => $ct->mahs,
                    'maloaip' => $ct->maloaip,
                    'loaip' => $ct->loaip,
                    'qccl' => $ct->qccl,
                    'sohieu' => $ct->sohieu,
                    'ghichu' => $ct->ghichu,
                    'mucgialk' => $ct->mucgialk,
                    'mucgiakk' => $ct->mucgiakk,
                    'tendoituong' => $ct->tendoituong,
                    'apdung'=> $ct->apdung,
                ];
            }

            $a_kq[$i]['ds_cths'] = $a_ct;
        }

        $a_API['Body'] = $a_kq;
        return response()->json($a_API, Response::HTTP_OK);
    }
}
