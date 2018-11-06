<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'username', 'email', 'password', 'birthday', 'about', 'image', 'country', 'count_followers', 'provider', 'provider_id'
    ];

    public $asYouType = true;

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        $array['name'] = $this->name;
        $array['users'] = $this->users['name'];

        return $array;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Entities\Category')->withTimestamps();
    }

    public function songs()
    {
        return $this->belongsToMany('App\Entities\Song')->withTimestamps();
    }

    public function albums()
    {
        return $this->hasMany('App\Entities\Album');
    }

    public function comments()
    {
        return $this->hasMany('App\Entities\Comment');
    }

    public function follows()
    {
        return $this->hasMany('App\Entities\Follow');
    }

    public function isFollowing($followed_id)
    {
        return (bool)$this->follows()->where('followed_id', $followed_id)->first(['id']);
    }

    public function playlists()
    {
        return $this->hasMany('App\Entities\Playlist');
    }

    public function likes()
    {
        return $this->hasMany('App\Entities\Like');
    }

}
