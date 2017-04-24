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
        $data=['name'=>'STC khanh hoa'];
        Mail::send(['name'=>'CSDL Giá'],$data, function($message){
            $message->to('minhtranlife@gmail.com','Minh Tran')
                ->subject('test gửi mail - 123');
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
