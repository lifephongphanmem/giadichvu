<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtPhong extends Model
{
    protected $table = 'ttphong';
    protected $filltable = [
        'id',
        'maloaip',
        'loaip',
        'qccl',
        'sohieu',
        'ghichu',
        'masothue'
    ];
}
