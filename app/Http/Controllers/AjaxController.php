<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function checkngay(Request $request)
    {
        $result = array(
            'message' => 'error',
            'status' => 'fail',
        );
        if (!Session::has('admin')) {
            $result = array(
                'status' => 'fail',
            );
            die(json_encode($result));
        }
        //dd($request);
        $inputs = $request->all();

        if (isset($inputs['ngayhieuluc'])) {

            $ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['ngaynhap'])));
            $ngayhieuluc = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['ngayhieuluc'])));

            $thungaynhap = date('D',strtotime($ngaynhap));

            if($thungaynhap == 'Thu'){
                $ngaysosanh = date('Y-m-d',mktime(0, 0, 0, date('m',strtotime($ngaynhap))  , date('d',strtotime($ngaynhap))+5, date('Y',strtotime($ngaynhap))));
            }elseif($thungaynhap == 'Fri' ) {
                $ngaysosanh = date('Y-m-d',mktime(0, 0, 0, date('m',strtotime($ngaynhap))  , date('d',strtotime($ngaynhap))+4, date('Y',strtotime($ngaynhap))));
            }elseif($thungaynhap = 'Sat'){
                $ngaysosanh = date('Y-m-d',mktime(0, 0, 0, date('m',strtotime($ngaynhap)), date('d',strtotime($ngaynhap))+3, date('Y',strtotime($ngaynhap))));
            }else{
                $ngaysosanh = date('Y-m-d',mktime(0, 0, 0, date('m',strtotime($ngaynhap))  , date('d',strtotime($ngaynhap))+2, date('Y',strtotime($ngaynhap))));
            }

            if($ngayhieuluc>$ngaysosanh || $ngayhieuluc == $ngaysosanh){
                $result['status'] = 'success';
            }




            /*$ngaynhap = date('d/m/Y', strtotime(str_replace('/', '-', $inputs['ngaynhap'])));
            $ngayhieuluc = date('d/m/Y', strtotime(str_replace('/', '-', $inputs['ngayhieuluc'])));

            $day = date("D", strtotime(str_replace('/', '-', $inputs['ngaynhap'])));
            if($day == 'Thu'){
                $ss = strtotime(date("d/m/Y", strtotime($ngayhieuluc)) . " -5 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }elseif($day == 'Fri' ) {
                $ss = strtotime(date("d/m/Y", strtotime($ngayhieuluc)) . " -4 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }elseif($day = 'Sat'){
                $ss = strtotime(date("d/m/Y", strtotime($ngayhieuluc)) . " -3 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }else{
                $ss = strtotime(date("d/m/Y", strtotime($ngayhieuluc)) . " -2 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }
            $ngaynhapcv = strftime("%Y-%m-%d",strtotime($ngaynhap));
            if (strtotime($ss) == strtotime($ngaynhapcv) || strtotime($ss) > strtotime($ngaynhapcv)) {
                $result['status'] = 'success';
            }*/


        }
        die(json_encode($result));
    }
}
