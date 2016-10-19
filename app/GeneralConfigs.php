<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralConfigs extends Model
{
    protected $table = 'general-configs';
    protected $filltable = [
        'id',
        'maqhns',
        'tendonvi',
        'diachi',
        'teldv',
        'thutruong',
        'ketoan',
        'nguoilapbieu',
        'namhethong',
        'sodvlt',
        'sodvvt',
        'ttlh',
        'setting'

    ];
}
