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
		'title', 'user_id'
	];
	
	public function links() 
	{
		return $this->belongsToMany('App\Link');
	}
	
	public static function listAllByUser(User $user)
	{
		return self::whereRaw('user_id = ?', [$user->id])->get();
	}
	
	public static function findOneByUser(User $user, int $id)
	{
		return self::whereRaw('user_id = ? and id = ?', [$user->id, $id])->first();
	}
	
}
