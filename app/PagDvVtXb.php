<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagDvVtXb extends Model
{
    protected $table = 'pagdvvtxb';
    protected $fillable = [
        'id',
        'masothue',
        'masokk',
        'madichvu',
        'sanluong',
        'cpnguyenlieutt',
        'cpcongnhantt',
        'cpkhauhaott',
        'cpsanxuatdt',
        'cpsanxuatc',
        'cptaichinh',
        'cpbanhang',
        'cpquanly'
    ];
}
