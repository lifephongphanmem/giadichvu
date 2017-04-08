<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KkGiaHLDf extends Model
{
    protected $table = 'kkgiahldf';
    protected $fillable = [
        'id',
        'masothue',
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
