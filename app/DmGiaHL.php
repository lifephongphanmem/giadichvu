<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmGiaHL extends Model
{
    protected $table = 'dmgiahl';
    protected $fillable = [
        'id',
        'masothue',
        'madichvu',
        'loaixe',
        'tendichvu',
        'qccl',
        'dvt',
        'ghichu'
    ];
}
