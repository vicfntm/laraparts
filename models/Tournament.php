<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
	protected $table = 'tournaments';
	public function tournamentsingles() {
		return $this->belongsTo('App\TournamentSingle');
	}
}