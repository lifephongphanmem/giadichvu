<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtDn extends Model
{
    protected $table = 'ttdn';
    protected $fillable = [
        'id',
        'masothue',
        'tendn',
        'diachi',
        'tel',
        'fax',
        'email',
        'diadanh',
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
        'giayphepkd',
        'chucdanhky',
        'nguoiky',
        'diadanh',
        'pl',
        'link',
        'cqcq',
        'lydo'

    ];
}
