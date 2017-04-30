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
		'title', 'url', 'user_id'
	];
	
	protected $hidden = ['pivot', 'user_id'];
	
	public function tags() {
		return $this->belongsToMany('App\Tag');
	}
	
	public static function listAllByUser(User $user)
	{
		return self::with('tags')->whereRaw('user_id = ?', [$user->id])->get();
	}
	
	public static function findOneByUser(User $user, int $id)
	{
		return self::with('tags')->whereRaw('user_id = ? and id = ?', [$user->id, $id])->first();
	}
	
}
