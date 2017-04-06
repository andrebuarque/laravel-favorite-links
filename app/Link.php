<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title', 'url'
	];
	
	public function tags() {
		return $this->belongsToMany('App\Tag');
	}
}
