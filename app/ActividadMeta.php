<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadMeta extends Model
{
    protected $table = 'actividad_meta';
     protected $fillable = [
        'actividad_id','meta_id',
    ];
}
