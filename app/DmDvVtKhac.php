<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmDvVtKhac extends Model
{
    protected $table = 'dmdvvtkhac';
    protected $fillable = [
        'id',
        'masothue',
        'madichvu',
        'loaixe',
        'diemdau',
        'diemcuoi',
        'tendichvu',
        'qccl',
        'dvt',
        'ghichu'
    ];
}
