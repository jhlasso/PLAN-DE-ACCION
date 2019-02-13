<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

	public $timestamps=false;

	public function objetivo()
	{
		return $this->hasMany('App\Objetivo');
	}

    protected $table = 'plan';
     protected $fillable = [
        'name','fecha_inicio','fecha_final'
    ];
}
