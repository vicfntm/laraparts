<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wtaranking extends Model
{
    protected $table = 'Wtaranking';

        public function player()
    {
    	return $this->belongsTo('App\Player');
    }
}
