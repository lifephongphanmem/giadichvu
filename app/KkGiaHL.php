<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KkGiaHL extends Model
{
    protected $table = 'kkgiahl';
    protected $fillable = [
        'id',
        'masokk',
        'madichvu',
        'tendichvu',
        'qccl',
        'dvt',
        'giahllk',
        'giahl',
        'ghichu',
        'thuevat'
    ];
}
