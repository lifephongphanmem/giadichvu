<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnDvGs extends Model
{
    protected $table = 'dndvgs';
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
