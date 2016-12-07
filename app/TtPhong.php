<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TtPhong extends Model
{
    protected $table = 'ttphong';
    protected $fillable = [
        'id',
        'maloaip',
        'loaip',
        'qccl',
        'sohieu',
        'ghichu',
        'masothue'
    ];
}
