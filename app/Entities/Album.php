<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laravel\Scout\Searchable;

/**
 * Class Album.
 *
 * @package namespace App\Entities;
 */
class Album extends Model implements Transformable
{
    use TransformableTrait;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id' ,'name', 'slug', 'image', 'description', 'count_listen', 'count_like'];

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        $array['name'] = $this->name;
        $array['albums'] = $this->albums['name'];

        return $array;
    }

    public function songs()
    {
        return $this->belongsToMany('App\Entities\Song')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Entities\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Entities\Like');
    }
    
    public function isLike($user_id)
    {
        return (bool)$this->likes()->where('user_id', $user_id)->first(['id']);
    }

}
