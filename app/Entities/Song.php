<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laravel\Scout\Searchable;
use CyrildeWit\EloquentViewable\Viewable;

/**
 * Class Song.
 *
 * @package namespace App\Entities;
 */
class Song extends Model implements Transformable
{
    use TransformableTrait;
    use Searchable;
    use Viewable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'slug', 'normal_url', 'vip_url', 'image', 'lyrics', 'count_listen', 'count_download', 'count_like'
    ];

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        $array['name'] = $this->name;
        $array['songs'] = $this->songs['name'];

        return $array;
    }

    public function category()
    {
        return $this->belongsTo('App\Entities\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\Entities\User')->withTimestamps();
    }

    public function albums()
    {
        return $this->belongsToMany('App\Entities\Album')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany('App\Entities\Comment');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Entities\Playlist')->withTimestamps();
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
