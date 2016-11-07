<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagDvVtXk extends Model
{
    protected $table = 'pagdvvtxk';
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
