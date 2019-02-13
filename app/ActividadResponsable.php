<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadResponsable extends Model
{
    protected $table = 'actividad_responsable';
     protected $fillable = [
        'actividad_id','responsable_id',
    ];
}
