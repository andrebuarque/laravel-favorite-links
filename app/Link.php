<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use function foo\func;

class Link extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'user_id'
    ];

    protected $hidden = [
        'pivot',
        'user_id'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     *
     * @param User $user            
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function listAllByUser(User $user)
    {
        return self::with('tags')->whereRaw('user_id = ?', [
            $user->id
        ])->get();
    }

    /**
     *
     * @param User $user            
     * @param int $id            
     * @return mixed
     */
    public static function findOneByUser(User $user, int $id)
    {
        return self::with('tags')->whereRaw('user_id = ? and id = ?', [
            $user->id,
            $id
        ])->first();
    }

    public static function store($data)
    {
        $link = self::create($data);
        
        $existingIds = self::getExistingTags($data);
        
        $link->tags()->attach($existingIds->all());
        
        return $link;
    }

    private static function getExistingTags($data)
    {
        $tags = collect($data['tags']);
        
        $existingIds = $tags->filter(function ($item, $key) {
            return Tag::exists(intval($item));
        });
        
        $notIds = $tags->diff($existingIds)->all();
        
        foreach ($notIds as $title) {
            $tag = Tag::create([
                'title' => $title,
                'user_id' => $data['user_id']
            ]);
            
            $existingIds->push($tag->id);
        }
        
        return $existingIds;
    }

    public static function doUpdate(Link $link, $data)
    {
        $link->update($data);
        
        $existingTags = self::getExistingTags($data);
        
        $link->tags()->sync($existingTags->all());
    }
}
