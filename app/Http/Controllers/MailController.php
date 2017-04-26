<?php

namespace App\Http\Controllers;

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
}
