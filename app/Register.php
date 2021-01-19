<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'register';
    protected $fillable = [
        'id',
        'masothue',
        'tendn',
        'diachi',
        'tel',
        'fax',
        'email',
        'diadanh',
        'chucdanh',
        'nguoiky',
        'noidknopthue',
        'setting',
        'dvxk',
        'dvxb',
        'dvxtx',
        'dvk',
        'toado',
        'ghichu',
        'trangthai',
        'tailieu',
        'filedk',
        'giayphepkd',
        'username',
        'password',
        'pl',
        'lydo',
        'cqcq',
        'ma'
    ];
}
