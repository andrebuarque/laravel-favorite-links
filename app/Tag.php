<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pivot',
        'user_id'
    ];

    /**
     *
     * @return BelongsToMany
     */
    public function links()
    {
        return $this->belongsToMany('App\Link');
    }

    /**
     * Find all tags of the user.
     *
     * @param User $user            
     * @return mixed
     */
    public static function listAllByUser(User $user)
    {
        return self::whereRaw('user_id = ?', [
            $user->id
        ])->get();
    }

    /**
     * Find one tag of the user.
     *
     * @param User $user            
     * @param int $id            
     * @return mixed
     */
    public static function findOneByUser(User $user, int $id)
    {
        return self::whereRaw('user_id = ? and id = ?', [
            $user->id,
            $id
        ])->first();
    }

    public static function exists($id)
    {
        $tag = self::whereRaw('id = ?', [
            $id
        ])->first();
        
        return isset($tag);
    }
}
