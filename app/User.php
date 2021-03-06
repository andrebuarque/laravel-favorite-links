<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token'
    ];

    /**
     * Get tags for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    /**
     * Get links for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('App\Link');
    }
}
