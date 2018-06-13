<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentSingle extends Model
{
	protected $table = 'Tournamentsingles';
    public function tournament(){
    	return $this->hasMany('App\Tournament');
    }

}
