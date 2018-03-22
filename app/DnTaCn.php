<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnTaCn extends Model
{
    protected $table = 'dntacn';
    protected $fillable = [
        'id',
        'tendn',
        'masothue',
        'diachidn',
        'teldn',
        'faxdn',
        'email',
        'noidknopthue',
        'chucdanhky',
        'nguoiky',
        'diadanh',
        'trangthai',
        'tailieu',
        'giayphepkd',
        'cqcq',
        'toado',
        'link'
    ];
}
