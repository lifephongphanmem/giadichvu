<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Contracts\Mail;
//use Illuminate\Mail;
//use Mail;

class MailController extends Controller
{
    function test_mail(){
        //dd(config('mail'));
        $data=['tencqcq'=>'Sở tài chính KH', 'tendn' => 'Công ty TNHH phát triển pm cuộc sống','tg'=>'14:24, 24/04/2017', 'nd' =>'Đã nhận thông tin đăng ký tài khoản','tieude'=>'Đăng ký mail'];
        Mail::send('mail.mail',$data, function($message){
            $message->to('minhtranlife@gmail.com','Minh Tran')
                ->subject('Kết quả');
            $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
        });
        echo 'ok';
/*
        $data=['name'=>'Harison matondang'];
        Mail::send(['text'=>'mail'], $data, function($message){
            $message->to('harisonmatondang@gmail.com','Harison Matondang')
                ->subject('test gửi mail');
            $message->from('qlgiakhanhhoa@gmail.com','Phần mềm CSDL giá');
        });
        echo 'Basics Email was sent!';
*/
    }

    public  function testday(){
        return view('manage.test.test')
            ->with('pageTitle','Test');
    }

    public function testdaysm(Request $request){
        $inputs = $request->all();
        $ngaynhap = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['ngaynhap'])));
        $ngayapdung = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['ngayapdung'])));
        $timestamp = strtotime($ngayapdung);
        $day = date("D", $timestamp);

        $ss = strtotime(date("Y-m-d", strtotime($ngayapdung)) . " -3 day");
        $ss = strftime("%Y-%m-%d", $ss);
dd($ss);


        /*$gio = date('H:i',strtotime(Carbon::now()->toDateTimeString()));
        $df = '8:00';
        dd($day = date("D", strtotime(Carbon::now()->toDateTimeString())));
        if($df > $gio){
            dd($gio);
        }else
            dd($df.'<'.$gio. '--triển thôi');*/
    }
}
