<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmDvQl extends Model
{
    protected $table = 'dmdvql';
    protected $fillable = [
        'id',
        'maqhns',
        'tendv',
        'plql',
        'diachi',
        'level',
        'username',
        'password',
        'sohsnhan',
        'ttlh',
        'email',
        'emailqt'
    ];
}
