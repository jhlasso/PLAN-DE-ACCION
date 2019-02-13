<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //Relacion con objetivo (Actividad pertenece a objetivo)
	public function objetivo()
	{
		return $this->belongsTo('App\Objetivo');
	}

	//Relacion muchos a muchos con responsable
	public function responsable()
	{
		return $this->belongsToMany('App\Responsable');
	}


	 protected $table = 'actividad';
     protected $fillable = [
        'name','estado','indicador','tipo','metas','presupuesto','fecha_inicio','fecha_final','objetivo_id', 
    ];
}
