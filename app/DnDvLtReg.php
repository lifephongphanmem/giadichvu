<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnDvLtReg extends Model
{
    protected $table = 'dndvltreg';
    protected $fillable = [
        'id',
        'tendn',
        'masothue',
        'diachidn',
        'teldn',
        'faxdn',
        'email',
        'giayphepkd',
        'noidknopthue',
        'chucdanhky',
        'nguoiky',
        'diadanh',
        'trangthai',
        'tailieu',
        'username',
        'password'
    ];
}
