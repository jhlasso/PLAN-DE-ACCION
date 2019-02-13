<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'Meta';
     protected $fillable = [
        'nombre','meta','cumplido','fecha',
    ];

    public function actividad()
	{
		return $this->belongsToMany('App\Actividad');
	}
}
