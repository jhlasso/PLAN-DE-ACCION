<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
	protected $table = 'Responsable';
     protected $fillable = [
        'name',
    ];

    public function actividad()
	{
		return $this->belongsToMany('App\Actividad');
	}
}
