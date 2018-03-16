<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralConfigs extends Model
{
    protected $table = 'general-configs';
    protected $fillable = [
        'id',
        'maqhns',
        'tendonvilt',
        'tendonvivt',
        'diachi',
        'teldv',
        'thutruong',
        'ketoan',
        'nguoilapbieu',
        'namhethong',
        'sodvlt',
        'sodvvt',
        'ttlhlt',
        'ttlhlt',
        'setting',
        'urlwebcb',
        'thoihan_lt',
        'thoihan_vt',
        'thoihan_ct'

    ];
}
