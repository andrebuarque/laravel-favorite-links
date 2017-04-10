<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title'
	];
	
	public function links() 
	{
		return $this->belongsToMany('App\Link');
	}
	
	public static function findByUser(User $user)
	{
		return self::where('user_id', '=', $user->id)->get();
	}
}
