<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $table = 'courts';
    public function courtcategory(){
    	return $this->belongsTo('App\CourtCategory', 'courtcategory_id');
    }
    
}
