<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageCollection extends Model
{
	protected $table = 'images';

	public function imagealbum(){

    return $this->belongsTo('App\ImageAlbum', 'image_album_id');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'image_tags', 'image_id', 'tag_id');
    }
}
