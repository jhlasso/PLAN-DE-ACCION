<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{

	//Relacion con plan (Objetivo pertenece a plan)
	public function plan()
	{
		return $this->belongsTo('App\Plan');
	}

	//Relacion con actividad de uno a mucho
	public function actividad()
	{
		return $this->hasMany('App\Actividad');
	}

	protected $table = 'objetivo';
     protected $fillable = [
        'name','id_plan',
    ];
}
