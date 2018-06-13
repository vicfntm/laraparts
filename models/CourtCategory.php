<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourtCategory extends Model
{
    protected $table = 'courtcategory';

    public function court(){
    	return $this->hasMany('App\Court');
    }
}
