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

            $day = date("D", strtotime($ngaynhap));
            if($day == 'Thu'){
                $ss = strtotime(date("Y-m-d", strtotime($ngayhieuluc)) . " -5 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }elseif($day == 'Fri' || $day = 'Sat') {
                $ss = strtotime(date("Y-m-d", strtotime($ngayhieuluc)) . " -4 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }else{
                $ss = strtotime(date("Y-m-d", strtotime($ngayhieuluc)) . " -3 day");
                $ss = strftime("%Y-%m-%d", $ss);
            }
            if (strtotime($ss) == strtotime($ngaynhap) || strtotime($ss) > strtotime($ngaynhap)) {
                $result['status'] = 'success';
            }

        }
        die(json_encode($result));
    }
}
