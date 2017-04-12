<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoiTuongApDungDvLt extends Model
{
    protected $table = 'doituongapdungdvlt';
    protected $fillable = [
        'id',
        'tendoituong',
        'macskd',
        'masothue',

    ];
}
